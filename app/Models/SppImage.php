<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SppImage extends Model
{

    protected $fillable = [
        'sanphamphu_id',
        'image_path',
        'photo_alt_text',
        'order',
        'is_featured',
    ];

    public function sanphamphu()
    {
        return $this->belongsTo(Sanphamphu::class, 'sanphamphu_id');
    }
    protected static function booted()
{
    static::saving(function ($image) {
        if ($image->is_featured) {
            // bỏ cờ featured ở các ảnh khác cùng sản phẩm phụ
            static::where('sanphamphu_id', $image->sanphamphu_id)
                ->where('id', '!=', $image->id)
                ->update(['is_featured' => false]);
        }
    });
}
}
