<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'name_original', 'name_translation' 
    ];

    public function CardGroup()
    {
        return $this->belongsTo(CardGroup::class);
    }

}
