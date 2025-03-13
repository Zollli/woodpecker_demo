<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
	protected $table = 'inventory';
	protected $casts = [];
	protected $dates = ['created_at', 'updated_at'];
	public $timestamps = true;

	public static function getAll()
	{
		$records = Inventory::all();
		return $records;
	}

	static function getRecord($column,$value)
	{
		return Inventory::where($column,$value)->get();
	}
}
