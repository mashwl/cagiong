<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SanphamphuResource\Pages;
use App\Filament\Resources\SanphamphuResource\RelationManagers;
use App\Models\Sanphamphu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Expr\AssignOp\Mod;
use Illuminate\Support\Str;

class SanphamphuResource extends Resource
{
    protected static ?string $model = Sanphamphu::class;
    protected static ?string $navigationGroup = 'Sản Phẩm';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
        public static function getSlug(): string
    {
        return 'san-pham-phu';
    }
    public static function getBreadcrumb(): string
    {
        return ' Sản phẩm phụ ';
    }
    public static function getNavigationBadge(): ?string
    {
        return strval(Sanphamphu::count());
    }

    protected static ?string $modelLabel = 'Sản phẩm phụ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Sanphamphu::getForm()
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->description(function (Sanphamphu $record) {
                        return Str::limit($record->sub_title, 40);
                    })
                    ->searchable()->limit(20),
                Tables\Columns\TextColumn::make('code')
                    ->label('Mã SP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Giá bán')
                    ->money('VND', true)
                    ->sortable(),
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
            'index' => Pages\ListSanphamphus::route('/'),
            'create' => Pages\CreateSanphamphu::route('/create'),
            'edit' => Pages\EditSanphamphu::route('/{record}/edit'),
        ];
    }
}
