<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_id',
        'place_id'
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
