<?php

namespace App\Models;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FeaturedProduct extends Model
{

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'featured_product_product', 'featured_product_id', 'product_id');
    }

    public function sanphamphu(): BelongsToMany
    {
        return $this->belongsToMany(Sanphamphu::class, 'featured_product_sanphamphu', 'featured_product_id', 'sanphamphu_id');
    }
    public static function getForm()
    {
        return [
            Section::make('Sản phẩm nổi bật')
                ->schema([
                    Fieldset::make('Titles')->label('Thêm sản phẩm nổi bật')
                        ->schema([
                            Select::make('products')->label('Cá Giống')
                                ->multiple()
                                ->preload()
                                ->searchable()
                                ->relationship('products', 'title'),

                            Select::make('sanphamphu')
                                ->label('Sản phẩm phụ')
                                ->multiple()
                                ->preload()
                                ->searchable()
                                ->relationship('sanphamphu', 'title'),

                        ]),
                ]),
        ];
    }

}       
