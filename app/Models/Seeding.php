<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seeding extends Model
{
    protected $fillable = [
       'id',
       'description',
       'user_id',
       'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
