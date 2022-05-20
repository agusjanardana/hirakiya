<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'users_id', 'categories_id', 'price', 'description', 'slug'
    ];

    protected $hidden = [];

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'products_id', 'id'); // product id di product gallery relasi ke product (id)
        // select productGallery.products id = product.id
        //
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
        // ->withTrashed ( munculin data jika sudah dihapus)

    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
        // select User.id == products.users_id

    }

    // relation to transaction detail
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'products_id', 'id');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'products_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'products_id', 'id');
    }
}
