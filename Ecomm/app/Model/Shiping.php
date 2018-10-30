<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shiping extends Model {
	protected $table    = 'shiping';
	protected $fillable = [
		'name_ar',
		'name_en',
		'user_id',
		'lat',
		'lng',
		'icon',
	];

   public function user_id($value='')
   {
   	return $this->hasOne('App\User','id','user_id');
   }
}