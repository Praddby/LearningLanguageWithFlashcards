<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StandardCards extends Model
{
    protected $fillable = [
        'name_original', 'name_translation'
    ];

    public function cardGroup()
    {
        return $this->belongsTo(CardGroup::class);
    }

}
