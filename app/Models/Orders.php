<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['price', 'status', 'user_id'];

    protected $searchableFields = ['*'];

    public function allOrderitems()
    {
        return $this->hasMany(Orderitems::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
