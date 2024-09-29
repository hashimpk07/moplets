<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class Location extends Model {

	public static function filter($query)
	{
		$keyword = Input::get("search") ;
		$query->where('l.name', 'LIKE', "%$keyword%") ;
		$query->orwhere('l.ivr', 'LIKE', "%$keyword%") ;
		$query->orWhere('l.ref_location_id', 'LIKE', "%$keyword%") ;
	}

	public static function listquery()
	{
		return DB::table(DB::raw('locations AS l'))
		         ->select(DB::raw("*"))
		         ->where(function($query)
		         {
			         self::filter($query) ;
		         }
		         )
		         ->groupBy('id')
		         ->orderBy('id', 'DESC') ;
	}
}
