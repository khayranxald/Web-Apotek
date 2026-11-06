<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrescriptionResource\Pages;
use App\Models\Prescription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrescriptionResource extends Resource
{
    protected static ?string $model = Prescription::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Layanan';

    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        return Auth::user()->hasAnyRole(['super_admin', 'admin', 'pharmacist']);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Resep')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('user.name')
                        ->label('Customer')
                        ->disabled(),

                    Forms\Components\TextInput::make('original_filename')
                        ->label('Nama File')
                        ->disabled(),

                    Forms\Components\Placeholder::make('file_preview')
                        ->label('File Resep')
                        ->content(fn (?Prescription $record): string =>
                            $record ? 'Klik tombol "Lihat File" di tabel untuk membuka resep.' : '-'
                        )
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Review Apoteker')
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'reviewing' => 'Reviewing',
                            'approved' => 'Approved',
                            'rejected' => 'Rejected',
                            'expired' => 'Expired',
                        ])
                        ->required()
                        ->live(),

                    Forms\Components\DateTimePicker::make('reviewed_at')
                        ->label('Waktu Review')
                        ->disabled(),

                    Forms\Components\Textarea::make('pharmacist_note')
                        ->label('Catatan Apoteker')
                        ->rows(4)
                        ->columnSpanFull()
                        ->required(fn (Forms\Get $get) => $get('status') === 'rejected')
                        ->helperText('Wajib diisi jika resep ditolak.'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('original_filename')
                    ->label('File')
                    ->limit(30),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'pending' => 'warning',
                        'reviewing' => 'info',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'expired' => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diunggah')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('reviewer.name')
                    ->label('Direview Oleh')
                    ->placeholder('—'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'reviewing' => 'Reviewing',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'expired' => 'Expired',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('view_file')
                    ->label('Lihat File')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Prescription $record) => route('prescriptions.download', $record))
                    ->openUrlInNewTab(),

                Tables\Actions\EditAction::make()
                ->using(function (Prescription $record, array $data): Prescription {
                    $isNewlyReviewed = in_array($data['status'], ['approved', 'rejected']) && $record->status !== $data['status'];

                    if ($isNewlyReviewed) {
                        $data['reviewed_by'] = Auth::id();
                        $data['reviewed_at'] = now();
                    }
                    $record->update($data);
                    if ($isNewlyReviewed) {
                        $record->user->notify(new \App\Notifications\PrescriptionReviewedNotification($record));
                    }
                    return $record;
                }),
            ])
            ->bulkActions([]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->with(['user', 'reviewer']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrescriptions::route('/'),
            'edit' => Pages\EditPrescription::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return Auth::user()->hasRole('pharmacist');
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }
}