<?php

namespace App\Models;

use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Firefly\FilamentBlog\Models\NewsLetter;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([OrderObserver::class])]
class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'product_id',
        'product_name',
        'quantity',
        'total',
        'status',
        'subscribe',
        'sanphamphu_id',
        'type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'subscribe' => 'boolean',
    ];

    /**
     * Booted model events.
     */
    protected static function booted()
    {
        static::created(function (Order $order) {
            // Nếu người dùng có email => cập nhật hoặc tạo bản ghi newsletter
            if (!empty($order->email)) {
                NewsLetter::updateOrCreate(
                    ['email' => $order->email],
                    ['subscribed' => $order->subscribe ?? true]
                );
            }
        });
    }

    /**
     * Quan hệ tới sản phẩm.
     */
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
    public function sanphamphu()
    {
        return $this->belongsTo(\App\Models\Sanphamphu::class);
    }
}
