<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
class Branch extends Model {

    public static function filter( $query ) {
        $keyword = Input::get( "search" );
        $query->where( 'b.name', 'LIKE', "%$keyword%" );
        $query->orWhere( 'b.ref_branch_id', 'LIKE', "%$keyword%" );

    }


    public static function listquery() {
        $id = Auth::user()->id;
        if ( $id == ADMIN_ID ) {
            return DB::table( DB::raw( 'branches AS b' ) )
                     ->select( DB::raw( "*" ) )
                     ->where( function ( $query ) {
                         self::filter( $query );

                     }
                     )
                     ->groupBy( 'id' )
                     ->orderBy( 'id', 'DESC' );
        } else {
            return DB::table( DB::raw( 'branches AS b' ) )
                     ->select( DB::raw( "*" ) )
                     ->where( function ( $query ) {
                         self::filter( $query );

                     }
                     )
                   ->join('executive_branches','b.id','=','executive_branches.branch_id')
                   ->where('executive_id',$id)
                     ->groupBy( 'b.id' )
                     ->orderBy( 'b.id', 'DESC' );
        }
    }
}