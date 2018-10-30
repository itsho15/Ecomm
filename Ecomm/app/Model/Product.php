<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $table    = 'products';
	protected $fillable = [
		'title',
		'photo',
		'content',
		'other_data',
		'weight',
		'price',
		'stock',
		'start_at',
		'end_at',
		'start_offer_at',
		'end_offer_at',
		'price_offer',
		'status',
		'reason',
		'department_id',
		'currency_id',
		'trade_id',
		'manu_id',
		'color_id',
		'size_id',
		'weight_id',
	];
	public function files(){
		return $this->hasMany('App\File','relation_id','id')->where('file_type','product');
	}
}
