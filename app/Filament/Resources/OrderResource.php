<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    public static function canCreate(): bool
{
    return false;
}

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Sản Phẩm';
    public static function getSlug(): string
    {
        return 'don-hang';
    }
    public static function getNavigationBadge(): ?string
    {
        return strval(Order::count());
    }
        public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }
    protected static ?string $modelLabel = 'đơn hàng';
    protected static ?string $pluralModelLabel = ' đơn hàng';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Tên khách hàng')->required()->maxLength(255),
                TextInput::make('email')->label('Email')->required()->email()->maxLength(255),
                TextInput::make('phone')->label('Số điện thoại')->required()->maxLength(20),
                TextInput::make('address')->label('Địa chỉ')->required()->maxLength(500),
                TextInput::make('product_name')->label('Tên sản phẩm')->required()->maxLength(255),
                TextInput::make('quantity')->label('Số lượng')->required()->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Mã đơn hàng')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Tên khách hàng')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('product_display')
    ->label('Sản phẩm')
    ->getStateUsing(fn($record) => 
$record->product?->title 
    ? ($record->product->title !== $record->product_name 
        ? $record->product->title . ($record->product_name ? " ({$record->product_name})" : '') 
        : $record->product->title
      )
    : ($record->product_name ?? '—')
    )
    ->limit(50)
    ->sortable()
    ->searchable(),

                Tables\Columns\TextColumn::make('quantity')->label('Số lượng')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            // 'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
