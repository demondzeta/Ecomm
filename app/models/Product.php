<?php

Class Product extends Eloquent {
	protected $fillable = array(
		'category_id', 
		'title', 
		'description', 
		'availability', 
		'image');

	public static $rules = array(
			'category_id'=>'required|integer',
			'title'=>'required|min:2',
			'description'=>'required|min:20',
			'price'=>'required|numeric',
			'availability'
		);

	public function category(){
		return $this->belongsTo('Category');
	}
}
