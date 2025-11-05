<?php

namespace App\Filament\Resources;
use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category as ModelsCategory;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = ModelsCategory::class;
    protected static ?string $navigationGroup = 'Sản Phẩm';
    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';
    public static function getSlug(): string
    {
        return 'danh-muc-san-pham';
    }

    protected static ?string $modelLabel = 'danh mục sản phẩm';
    public static function getNavigationBadge(): ?string
    {
        return strval(ModelsCategory::count());
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema(ModelsCategory::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->searchable(),
                Tables\Columns\TextColumn::make('products_count')
                    ->label('Số sản phẩm')
                    ->badge()
                    ->counts('products'),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Category')
                ->schema([
                    TextEntry::make('name'),
                    TextEntry::make('slug'),
                ])->columns(2)
                ->icon('heroicon-o-square-3-stack-3d'),
        ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
