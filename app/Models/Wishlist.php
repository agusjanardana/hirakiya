<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_id', 'users_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'products_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'users_id');
    }
}
