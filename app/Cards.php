<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    protected $fillable = [
        'name_original', 'name_translation', 'level'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
