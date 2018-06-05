<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'name_original', 'name_translation', 'card_group_id'
    ];

    public function CardGroup()
    {
        return $this->belongsTo(CardGroup::class);
    }

}
