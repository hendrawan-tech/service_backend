<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductService extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'code',
        'name',
        'brand',
        'condition',
        'attribute',
        'problem',
        'specification',
        'image',
        'status',
        'product_category_id',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'product_services';

    public function productCategory()
    {
        return $this->belongsTo(
            ProductServiceCategory::class,
            'product_category_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'product_id');
    }
}
