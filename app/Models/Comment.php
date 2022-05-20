<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'products_id', 'users_id', 'description'
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
