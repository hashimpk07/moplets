<?php

namespace App\Models\Virtual;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class Dashboard extends Model {




    /**
     * @return mixed
     */
    public static function todayDetails()
    {
        return DB::table('requests')
            ->select(DB::raw("count('customer') as count_customer"))
            ->where( DB::raw( 'DATE(dt)') ,DB::raw( 'CURDATE()' ))
            ->pluck('count_customer') ;

    }
    public static function summaryDetails()
    {

    }

    /**
     * @return mixed
     */
    public static function callsSatisfied()
    {
    return DB::table('requests')
        ->select(DB::raw("count('customer') as count_customer"))
        ->where( 'call_response','S' )
        ->where( DB::raw( 'DATE(dt)') ,DB::raw( 'CURDATE()' ))
        ->pluck('count_customer') ;

    }
    public static function callsUnsatisfied()
    {
        return DB::table('requests')
            ->select(DB::raw("count('customer') as count_customer"))
            ->where( 'call_response','F' )
            ->where( DB::raw( 'DATE(dt)') ,DB::raw( 'CURDATE()' ))
            ->pluck('count_customer') ;

    }

    public static function totalCallsSatisfied()
    {
        return DB::table('requests')
            ->select(DB::raw("count('customer') as count_customer"))
            ->where( 'call_response','S' )
            ->pluck('count_customer') ;

    }
    public static function totalCallsUnsatisfied()
    {
        return DB::table('requests')
            ->select(DB::raw("count('customer') as count_customer"))
            ->where( 'call_response','F' )
            ->pluck('count_customer') ;

    }

    public static function countEmployee()
    {
        return DB::table('employees')
            ->select(DB::raw("count('name') as count_employee"))
            ->pluck('count_employee') ;


    }
    public static function blockedEmployee()
    {
        return DB::table('employees')
            ->select(DB::raw("count('name') as count_employee"))
            ->where( 'is_blocked',1 )
            ->pluck('count_employee') ;


    }
    public static function countRegion()
    {
        return DB::table('regions')
            ->select(DB::raw("count('name') as count_employee"))
            ->pluck('count_regions') ;


    }
    public static function blockedRegion()
    {
        return DB::table('regions')
            ->select(DB::raw("count('name') as count_employee"))
            ->where( 'is_blocked',1 )
            ->pluck('count_regions') ;


    }
    public static function countBranch()
{
    return DB::table('branches')
        ->select(DB::raw("count('name') as count_branch"))
        ->pluck('count_branch') ;


}
    public static function blockedBranch()
    {
        return DB::table('branches')
            ->select(DB::raw("count('name') as count_branch"))
            ->where( 'is_blocked',1 )
            ->pluck('count_branch') ;


    }
    public static function countLocation()
    {
        return DB::table('locations')
            ->select(DB::raw("count('name') as count_location"))
            ->pluck('count_location') ;


    }
    public static function blockedLocation()
    {
        return DB::table('locations')
            ->select(DB::raw("count('name') as count_location"))
            ->where( 'is_blocked',1 )
            ->pluck('count_location') ;
    }
    public static function tilldateDetails()
    {
        return DB::table('requests')
            ->select(DB::raw("count(*) as count_customer"))->pluck('count_customer');

    }

    public static function topBranches()
    {
        return DB::table( DB::raw( 'requests AS r' ) )
            ->select( DB::raw("COUNT(*) as cnt, b.name AS branch"))
            ->leftJoin( 'branches AS b', 'b.id', '=', 'r.branch_id' )
            ->whereRaw( 'DATE(dt)=CURDATE()' )
            ->groupBy( 'r.branch_id' )->orderBy('cnt', 'desc')->limit(10)->get() ;
    }
    public static function comparisonAllTime()
    {
        return DB::table( DB::raw( 'requests AS r' ) )
            ->select( DB::raw("SUM(if(call_response='S',1,0)) as satisfied,  SUM(if(call_response='F',1,0)) as unsatisfied"))
            ->first() ;

    }
    public static function comparisonToday()
    {
        return DB::table( DB::raw( 'requests AS r' ) )
            ->select( DB::raw("SUM(if(call_response='S',1,0)) as satisfied,  SUM(if(call_response='F',1,0)) as unsatisfied"))
            ->whereRaw( 'DATE(dt) = CURDATE()' )->first() ;

    }
    public static function comparisonThisWeek()
    {
        $monday = date('Y-m-d',strtotime('-1 Monday') ) ;

        return DB::table( DB::raw( 'requests AS r' ) )
            ->select( DB::raw("SUM(if(call_response='S',1,0)) as satisfied,  SUM(if(call_response='F',1,0)) as unsatisfied"))
            ->whereRaw( " (DATE(dt) <= CURDATE() AND DATE(dt) >= '$monday') " )->first() ;
    }
    public static function comparisonPreviousMonth()
    {
        $first = date("Y-m-01", strtotime("last month"));
        $last = date("Y-m-t", strtotime("last month"));

        return DB::table( DB::raw( 'requests AS r' ) )
            ->select( DB::raw("SUM(if(call_response='S',1,0)) as satisfied,  SUM(if(call_response='F',1,0)) as unsatisfied"))
            ->whereRaw( " (DATE(dt) >= '$first' AND DATE(dt) <= '$last') " )->first() ;
    }
    public static function comparisonThisMonth() {

        $first = Date('Y-m-01') ;

        return DB::table( DB::raw( 'requests AS r' ) )
            ->select( DB::raw("SUM(if(call_response='S',1,0)) as satisfied,  SUM(if(call_response='F',1,0)) as unsatisfied"))
            ->whereRaw( " (DATE(dt) <= CURDATE() AND DATE(dt) >= '$first') " )->first() ;
    }
}