<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $modelLabel = 'tài khoản';
 
    protected static ?string $navigationGroup = 'Cài Đặt';
    protected static ?string $pluralModelLabel = 'Danh sách tài khoản';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Tên hiển thị'),
                TextInput::make('email'),
                TextInput::make('password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state)) // chỉ gửi khi có nhập
                    ->required(fn (string $context): bool => $context === 'create') // chỉ bắt buộc khi tạo mới
                    ->label('Mật khẩu')
                    ->helperText(fn (string $context): string => $context === 'edit'
                    ? 'Để trống nếu không muốn đổi mật khẩu'
                    : 'Nhập mật khẩu cho tài khoản'),
                FileUpload::make('profile_photo_path')->label('Avatar')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Tên'),
                TextColumn::make('email'),
                ImageColumn::make('profile_photo_path')
                ->label('Avatar')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
