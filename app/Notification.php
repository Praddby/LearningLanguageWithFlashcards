<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'level', 'last_repeat', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
