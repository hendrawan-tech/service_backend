<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orderitems extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['quantity', 'orders_id', 'product_id'];

    protected $searchableFields = ['*'];

    public function orders()
    {
        return $this->belongsTo(Orders::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
