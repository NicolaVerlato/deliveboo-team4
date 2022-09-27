<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'address',
        'slug',
        'cover'
    ];
    public function types() {
        return $this->belongsToMany('App\Type');
    }
}
