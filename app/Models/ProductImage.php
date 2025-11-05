<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
        use HasFactory;

    protected $fillable = ['product_id', 'image_path', 'photo_alt_text', 'order', 'is_featured'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
protected static function booted()
{
    static::saving(function ($image) {
        if ($image->is_featured) {
            // bỏ cờ featured ở các ảnh khác cùng product
            static::where('product_id', $image->product_id)
                ->where('id', '!=', $image->id)
                ->update(['is_featured' => false]);
        }
    });
}

}
