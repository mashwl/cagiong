<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class SppCategory extends Model

{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
    ];
    
       protected $casts = [
        'id' => 'integer',
    ];

    
    public function sanphamphus(): BelongsToMany
    {
        return $this->belongsToMany(Sanphamphu::class, 'spp_sppcategory');
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


