<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_product_id',
    ];

    protected $searchableFields = ['*'];

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function allOrderitems()
    {
        return $this->hasMany(Orderitems::class);
    }
}
