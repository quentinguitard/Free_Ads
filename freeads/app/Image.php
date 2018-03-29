<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $guarded = [];

    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}
