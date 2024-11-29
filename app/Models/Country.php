<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected  $guarded = [''];

    public $timestamps = false;

    public function getCountrylabelAttribute()
    {
        return Str::slug($this->name);
    }

}
