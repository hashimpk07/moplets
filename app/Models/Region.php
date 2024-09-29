<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class Region extends Model {

	public static function filter($query)
	{
		$keyword = Input::get("search") ;
		$query->where('r.name', 'LIKE', "%$keyword%") ;
		$query->orWhere('r.ref_region_id', 'LIKE', "%$keyword%") ;
	}

	public static function listquery() {
		$id = Auth::user()->id;
		if ( $id == ADMIN_ID ) {
			return DB::table( DB::raw( 'regions AS r' ) )
			         ->select( DB::raw( "*" ) )
			         ->where( function ( $query ) {
				         self::filter( $query );
			         }
			         )

			   ->groupBy( 'r.id' )
				->orderBy( 'r.id', 'DESC' );
		}
		if ( $id != ADMIN_ID ) {
			return DB::table( DB::raw( 'regions AS r' ) )
			         ->select( DB::raw( "*" ) )
			         ->where( function ( $query ) {
				         self::filter( $query );
			         }
			         )
			         ->join( 'executive_regions', 'executive_regions.region_id', '=', 'r.id' )
			         ->where( 'executive_id', $id )
			         ->groupBy( 'r.id' )
			         ->orderBy( 'r.id', 'DESC' );
		}
	}
}
