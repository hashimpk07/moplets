<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
class History extends Model {

	public static function filter($query)
	{
		$keyword = Input::get("search") ;
		$query->where('h.data', 'LIKE', "%$keyword%") ;
		$query->orwhere('h.data_time', 'LIKE', "%$keyword%") ;
		$query->orWhere('h.type', 'LIKE', "%$keyword%") ;
	}

	public static function listquery()
	{
		return DB::table(DB::raw('histories AS h'))
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