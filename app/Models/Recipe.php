<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
	protected $table = 'recipes';
	protected $casts = [
		'ingredients' => 'array'
	];
	protected $dates = ['created_at', 'updated_at'];
	public $timestamps = true;

	public static function getAll()
	{
		$records = Recipe::all();
		return $records;
	}

	static function getRecord($column,$value)
	{
		return Recipe::where($column,$value)->get();
	}
}
