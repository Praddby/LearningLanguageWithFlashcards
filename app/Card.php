<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
  protected $fillable = [
    'name_original', 'name_translation', 'cardgroup_id'
  ];

  public function CardGroup()
  {
    return $this->belongsTo(CardGroup::class);
  }

  public static function destroy($id)
  {
  	self::find($id)->delete();
  }

  

}
