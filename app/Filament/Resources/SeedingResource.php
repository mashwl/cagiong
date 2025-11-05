<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeedingResource\Pages;
use App\Filament\Resources\SeedingResource\RelationManagers;
use App\Models\Seeding;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SeedingResource extends Resource
{
    protected static ?string $model = Seeding::class;
    protected static ?string $navigationGroup = 'Cài Đặt';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('description')
                    ->label('Nhận xét')
                    ->required()
                    ->columnSpanFull(),
                Select::make('user_id')
                    ->label('Chọn người đánh giá trong list user')
                    ->relationship('user', 'name') 
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->label('Nuôi Gì? Ở Đâu?')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')->label('Nhận xét')->limit(50)->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tạo lúc')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Cập nhật lúc')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
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
            'index' => Pages\ListSeedings::route('/'),
            'create' => Pages\CreateSeeding::route('/create'),
            'edit' => Pages\EditSeeding::route('/{record}/edit'),
        ];
    }
}
