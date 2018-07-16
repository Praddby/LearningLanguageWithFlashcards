<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardGroup extends Model
{
    protected $fillable = [
        'name_category'
    ];

    public function standardCards()
    {
        return $this->hasMany(StandardCards::class);
    }

}
