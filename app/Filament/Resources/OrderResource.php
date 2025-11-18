<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    public static function canCreate(): bool
{
    return false;
}

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
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
            // Hiển thị type ở đầu như một "title"
            Section::make(fn($record) => $record->type === 'order' ? 'Đơn Đặt Hàng' : 'Yêu Cầu Báo Giá')
                ->extraAttributes(['class' => 'text-center  text-lg'])
                ->schema([
                    TextInput::make('name')->label('Tên khách hàng')->required()->maxLength(255),
                    TextInput::make('email')->label('Email')->required()->email()->maxLength(255),
                    TextInput::make('phone')->label('Số điện thoại')->required()->maxLength(20),
                    TextInput::make('address')->label('Địa chỉ')->required()->maxLength(500),
                    TextInput::make('product_name')->label('Tên sản phẩm')->required()->maxLength(255),
                    TextInput::make('quantity')->label('Số lượng')->required()->numeric(),
                ])->columns(2),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Mã đơn hàng')->sortable(),
                Tables\Columns\TextColumn::make('type')->label('Loại đơn hàng')->getStateUsing(fn ($record) => match ($record->type) {
                    'order' => 'Đơn Đặt Hàng',
                    'quote' => 'Yêu Cầu Báo Giá',
                })
                ->sortable()
                ->searchable(),
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
                // Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('reset_all')
                ->label('Xóa')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function () {
                    \App\Models\Order::truncate();  // Xóa toàn bộ và reset Auto Increment về 1
                })
                ->visible(fn () => \App\Models\Order::count() > 0),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('delete_and_reset')
    ->label('Xóa những mục đã chọn')
    ->icon('heroicon-o-trash')
    ->color('danger')
    ->requiresConfirmation()
    ->action(function (Collection $records) {
        foreach ($records as $record) {
            $record->delete();
        }

        if (\App\Models\Order::count() === 0) {
            DB::statement('ALTER TABLE orders AUTO_INCREMENT = 1');
        }
    })
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
            // 'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),

        ];
    }
}
