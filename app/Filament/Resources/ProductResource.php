<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Katalog';

    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        return \Illuminate\Support\Facades\Auth::user()->hasAnyRole(['super_admin', 'admin']);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Produk')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $context, $state, callable $set) =>
                            $context === 'create'
                                ? $set('slug', Str::slug($state) . '-' . Str::random(5))
                                : null
                        )
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('sku')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    Forms\Components\Select::make('category_id')
                        ->label('Kategori')
                        ->options(Category::pluck('name', 'id'))
                        ->searchable()
                        ->required(),

                    Forms\Components\TextInput::make('manufacturer')
                        ->maxLength(255),

                    Forms\Components\Textarea::make('description')
                        ->maxLength(2000)
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Harga & Stok')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('price')
                        ->label('Harga')
                        ->required()
                        ->numeric()
                        ->prefix('Rp'),

                    Forms\Components\TextInput::make('discount_price')
                        ->label('Harga Diskon')
                        ->numeric()
                        ->prefix('Rp')
                        ->helperText('Kosongkan jika tidak ada diskon'),

                    Forms\Components\TextInput::make('stock')
                        ->label('Stok')
                        ->required()
                        ->numeric()
                        ->default(0),
                ]),

            Forms\Components\Section::make('Media & Status')
                ->columns(2)
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->directory('products')
                        ->imageEditor()
                        ->columnSpanFull(),

                    Forms\Components\Select::make('status')
                        ->options([
                            'active' => 'Aktif',
                            'inactive' => 'Tidak Aktif',
                            'out_of_stock' => 'Stok Habis',
                        ])
                        ->default('active')
                        ->required(),

                    Forms\Components\Toggle::make('requires_prescription')
                        ->label('Memerlukan Resep')
                        ->helperText('Aktifkan jika produk ini hanya bisa dibeli dengan resep dokter'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->square(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('discount_price')
                    ->label('Diskon')
                    ->money('IDR')
                    ->placeholder('—')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->sortable()
                    ->color(fn (int $state) => $state <= 5 ? 'danger' : 'success'),

                Tables\Columns\IconColumn::make('requires_prescription')
                    ->label('Resep')
                    ->boolean(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'active' => 'success',
                        'inactive' => 'gray',
                        'out_of_stock' => 'danger',
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                        'out_of_stock' => 'Stok Habis',
                    ]),

                Tables\Filters\TernaryFilter::make('requires_prescription')
                    ->label('Memerlukan Resep'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->with('category');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}