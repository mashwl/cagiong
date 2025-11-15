<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;



class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Sản Phẩm';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function getSlug(): string
    {
        return 'ca-giong';
    }
    public static function getBreadcrumb(): string
    {
        return ' Cá giống ';
    }
    public static function getNavigationBadge(): ?string
    {
        return strval(Product::count());
    }

    protected static ?string $modelLabel = 'Cá giống';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ...Product::getForm(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->description(function (Product $record) {
                        return Str::limit($record->sub_title, 40);
                    })
                    ->searchable()->limit(20),
                TextColumn::make('code')
                    ->label('Mã Sản Phẩm')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(function ($state) {
                        return $state->getColor();
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
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
            Section::make('Thông tin sản phẩm')
                ->schema([
                    Fieldset::make('Thông tin chung')
                        ->schema([
                            TextEntry::make('title')->label('Tiêu đề'),
                            TextEntry::make('slug')->label('Đường dẫn'),
                            // TextEntry::make('sub_title')->label('Tiêu đề phụ'),
                        ]),
                    Fieldset::make('Thông tin xuất bản')
                        ->schema([
                            TextEntry::make('status')->label('Trạng thái')
                                ->badge()->color(function ($state) {
                                    return $state->getColor();
                                }),
                            TextEntry::make('published_at')->label('Đã xuất bản lúc')->visible(function (Product $record) {
                                return $record->status === ProductStatus::PUBLISHED;
                            }),

                            TextEntry::make('scheduled_for')->label('Lên lịch cho')->visible(function (Product $record) {
                                return $record->status === ProductStatus::SCHEDULED;
                            }),
                        ]),
                    Fieldset::make('Mô tả')
                        ->schema([
                            TextEntry::make('body')
                                ->label('Nội dung bài viết')
                                ->html()
                                ->columnSpanFull(),
                        ]),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
