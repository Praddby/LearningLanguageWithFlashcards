<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardGroup extends Model
{
	protected $fillable = [
	   	'name_category'
	];

	public function cards()
	{
		return $this->hasMany(Card::class);
	}

}
