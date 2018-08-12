<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_category'
    ];

    public function cards()
    {
        return $this->hasMany(Cards::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setStandard()
    {
        $this->is_standard = true;

        return $this;
    }

    public function scopeStandardCards($query)
    {
        return $query->where('is_standard', true);
    }

}
