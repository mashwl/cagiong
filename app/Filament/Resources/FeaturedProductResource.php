<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeaturedProductResource\Pages;
use App\Filament\Resources\FeaturedProductResource\RelationManagers;
use App\Models\FeaturedProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeaturedProductResource extends Resource
{
    protected static ?string $model = FeaturedProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Sản Phẩm';
    public static function getSlug(): string
    {
        return 'san-pham-noi-bat';
    }
    public static function getBreadcrumb(): string
    {
        return ' Sản phẩm nổi bật';
    }

    protected static ?string $modelLabel = 'Sản phẩm nổi bật';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(FeaturedProduct::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('products.title')->label('Cá Giống'),
                Tables\Columns\TextColumn::make('sanphamphu.title')->label('Sản phẩm phụ'),
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
            'index' => Pages\ListFeaturedProducts::route('/'),
            'create' => Pages\CreateFeaturedProduct::route('/create'),
            'edit' => Pages\EditFeaturedProduct::route('/{record}/edit'),
        ];
    }
}
