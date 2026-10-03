<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Produk Dipesan';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product_name')
            ->columns([
                Tables\Columns\TextColumn::make('product_name')
                    ->label('Produk'),

                Tables\Columns\TextColumn::make('product_sku')
                    ->label('SKU'),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Jumlah'),

                Tables\Columns\TextColumn::make('subtotal')
                    ->money('IDR'),
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}