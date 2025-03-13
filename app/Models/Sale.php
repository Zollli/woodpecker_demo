<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	protected $table = 'salesOfLastWeek';
	protected $casts = [];
	protected $dates = ['created_at', 'updated_at'];
	public $timestamps = true;

	public static function getAll()
	{
		$records = Sale::all();
		return $records;
	}

	static function getRecord($column,$value)
	{
		return Sale::where($column,$value)->get();
	}
}
