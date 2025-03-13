<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Wholesale extends Model
{
	protected $table = 'wholesalePrices';
	protected $casts = [];
	protected $dates = ['created_at', 'updated_at'];
	public $timestamps = true;

	public static function getAll()
	{
		$records = Wholesale::all();
		return $records;
	}

	static function getRecord($column,$value)
	{
		return Wholesale::where($column,$value)->get();
	}
}
