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

    
    public function scopeStandardCards($query)
    {
        return $query->where('is_standard', true);
    }

    public function scopeSetStandard($query)
    {
    	$query->is_standard = true;
    }

}
