<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'content',
        'user_id'
    ];

    protected $guarded = [];

    public static function boot() {
        parent::boot();

        static::deleting(function($place) { // before delete() method call this
            $place->placeImages()->delete();
        });
    }

    public function placeImages()
    {
        return $this->hasMany(PlaceImage::class);
    }

    public function userPlaceFavourites()
    {
        return $this->hasMany(UserPlaceFavourite::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function countLikes()
    {
        return $this->userPlaceFavourites()->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userPlaceVotes()
    {
        return $this->hasMany(UserPlaceVote::class);
    }

    public function getRating()
    {
        return $this->userPlaceVotes->avg('vote');
    }
}
