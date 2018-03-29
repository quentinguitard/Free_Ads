<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function image()
    {
        return $this->hasMany(Image::class);
    }

    public function publishImages(Image $image)
    {
        return $this->image()->save($image);
    }

}
