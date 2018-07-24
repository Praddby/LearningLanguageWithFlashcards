<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCards extends Model
{
    protected $fillable = [
        'name_original', 'name_translation'
    ];

    public function cardGroup()
    {
        return $this->belongsTo(CardGroup::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
