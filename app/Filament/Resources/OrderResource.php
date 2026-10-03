<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Penjualan';

    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        return \Illuminate\Support\Facades\Auth::user()->hasAnyRole(['super_admin', 'admin']);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Pesanan')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('order_number')
                        ->label('Nomor Pesanan')
                        ->disabled(),

                    Forms\Components\TextInput::make('user.name')
                        ->label('Customer')
                        ->disabled(),

                    Forms\Components\Select::make('status')
                        ->label('Status Pesanan')
                        ->options([
                            'pending' => 'Pending',
                            'confirmed' => 'Confirmed',
                            'processing' => 'Processing',
                            'shipped' => 'Shipped',
                            'completed' => 'Completed',
                            'cancelled' => 'Cancelled',
                        ])
                        ->required(),

                    Forms\Components\Select::make('payment_status')
                        ->label('Status Pembayaran')
                        ->options([
                            'unpaid' => 'Unpaid',
                            'pending' => 'Pending',
                            'paid' => 'Paid',
                            'failed' => 'Failed',
                            'refunded' => 'Refunded',
                        ])
                        ->required(),
                ]),

            Forms\Components\Section::make('Alamat Pengiriman')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('recipient_name')
                        ->label('Nama Penerima')
                        ->disabled(),

                    Forms\Components\TextInput::make('phone')
                        ->label('No. Telepon')
                        ->disabled(),

                    Forms\Components\Textarea::make('address')
                        ->label('Alamat')
                        ->disabled()
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('city')
                        ->label('Kota')
                        ->disabled(),

                    Forms\Components\TextInput::make('postal_code')
                        ->label('Kode Pos')
                        ->disabled(),
                ]),

            Forms\Components\Section::make('Ringkasan Biaya')
                ->columns(4)
                ->schema([
                    Forms\Components\TextInput::make('subtotal')
                        ->prefix('Rp')
                        ->disabled(),

                    Forms\Components\TextInput::make('discount')
                        ->prefix('Rp')
                        ->disabled(),

                    Forms\Components\TextInput::make('shipping_cost')
                        ->label('Ongkir')
                        ->prefix('Rp')
                        ->disabled(),

                    Forms\Components\TextInput::make('total')
                        ->prefix('Rp')
                        ->disabled(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Nomor Pesanan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'processing' => 'primary',
                        'shipped' => 'purple',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Pembayaran')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'unpaid', 'pending' => 'warning',
                        'paid' => 'success',
                        'failed', 'refunded' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),

                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->with('user');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}