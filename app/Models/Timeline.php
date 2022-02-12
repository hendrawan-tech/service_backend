<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timeline extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['message', 'service_id'];

    protected $searchableFields = ['*'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
