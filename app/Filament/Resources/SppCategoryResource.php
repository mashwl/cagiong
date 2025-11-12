<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SppCategoryResource\Pages;
use App\Filament\Resources\SppCategoryResource\RelationManagers;
use App\Models\SppCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SppCategoryResource extends Resource
{
    protected static ?string $model = SppCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';
    protected static ?string $navigationGroup = 'Sản Phẩm';
        public static function getSlug(): string
    {
        return 'danh-muc-san-pham-phu';
    }
    protected static ?string $modelLabel = 'danh mục sản phẩm phụ';
    public static function getNavigationBadge(): ?string
    {
        return strval(SppCategory::count());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                SppCategory::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sanphamphus_count')
                    ->label('Số sản phẩm')
                    ->badge()
                    ->counts('sanphamphus'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSppCategories::route('/'),
            'create' => Pages\CreateSppCategory::route('/create'),
            'edit' => Pages\EditSppCategory::route('/{record}/edit'),
        ];
    }
}
