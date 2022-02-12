<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['product_id', 'user_id'];

    protected $searchableFields = ['*'];

    public function timeline()
    {
        return $this->belongsTo(ProductService::class, 'product_id');
    }

    public function timelines()
    {
        return $this->hasMany(Timeline::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
