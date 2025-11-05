<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;


class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];
   protected $casts = [
        'id' => 'integer',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_category');
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->label('Tên danh mục')
                ->live(true)
                ->afterStateUpdated(function (Get $get, Set $set, ?string $operation, ?string $old, ?string $state) {

                    $set('slug', Str::slug($state));
                })
                ->required()
                ->maxLength(155),

            TextInput::make('slug')
                ->label('Đường dẫn')
                ->maxLength(255)
                ->hidden(),
        ];
    }


    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}
