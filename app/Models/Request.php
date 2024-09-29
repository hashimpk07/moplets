<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PDO;
use Qudratom\Utilities\DateTime;

class Request extends Model
{

    public static function filter($query)
    {
        $keyword = Input::get("search");

        if ($keyword)
        {
            $query->where('employees.name', 'LIKE', "%$keyword%");
            $query->orWhere('requests.customer', 'LIKE', "%$keyword%");
            $query->orWhere('requests.phone', 'LIKE', "%$keyword%");
            $query->orWhere('branches.name', 'LIKE', "%$keyword%");
            $query->orWhere('regions.name', 'LIKE', "%$keyword%");
        }
        else
        {
            $customer = Input::get("name");
            $phone = Input::get("phone");
            $sel_employes = Input::get("employees");
            $sel_locations = Input::get("locations");
            $sel_branches = Input::get("branches");
            $sel_regions = Input::get("regions");
            $fromdate = DateTime::mysqlDateTime( Input::get("fromdate") );
            $todate = DateTime::mysqlDateTime( Input::get("todate") ) ;

            $sel_responsestatus = Input::get("responsestatus");
            $sel_callstatus = Input::get("callstatus");

            if ($customer) {
                $query->orWhere('requests.customer', 'LIKE', "%$customer%");
            }
            if ($phone) {
                $query->where('requests.phone', 'LIKE', "%$phone%");
            }
            if (count(@array_filter($sel_employes))) {
                $query->whereIn('employees.id', $sel_employes);
            }
            if (count(@array_filter($sel_branches))) {
                $query->whereIn('branches.id', $sel_branches);
            }
            if (count(@array_filter($sel_locations))) {
                $query->whereIn('locations.id', $sel_locations);
            }
            if (count(@array_filter($sel_regions))) {
                $query->whereIn('regions.id', $sel_regions);
            }
            if (count(@array_filter($sel_callstatus))) {
                $query->whereIn('requests.call_status', $sel_callstatus);
            }
            if (count(@array_filter($sel_responsestatus))) {
                $query->whereIn('requests.call_response', $sel_responsestatus);
            }
            if ($todate) {
                $query->Where('requests.dt', '<=', $todate);
            }
            if (($fromdate)) {
                $query->where('requests.dt', '>=', $fromdate);
            }
        }
    }

    public static function listquery()
    {
        return DB::table('requests')
            ->join('employees', 'requests.employee_id', '=', 'employees.id')
            ->join('branches', 'requests.branch_id', '=', 'branches.id')
            ->join('locations', 'requests.location_id', '=', 'locations.id')
            ->join('regions', 'requests.region_id', '=', 'regions.id')
            ->select('requests.id as requestid', 'requests.customer as rcustomer',  'requests.phone as rphone', 'requests.dt as requestdate', 'employees.name as empname','branches.name as branchname', 'locations.name as llocations', 'regions.name as regname','requests.dt as createdat',  'requests.call_status as callstatus', 'requests.call_response as responsestatus')
            ->where(function ($query) {
                self::filter($query);
            }
            )->orderBy('requests.id', 'DESC');
    }
    public static function listquery1()
    {
        $export = DB::table('requests')
                 ->join('employees', 'requests.employee_id', '=', 'employees.id')
                 ->join('branches', 'requests.branch_id', '=', 'branches.id')
                 ->join('locations', 'requests.location_id', '=', 'locations.id')
                 ->join('regions', 'requests.region_id', '=', 'regions.id')
                 ->select( 'requests.dt as createdat', 'requests.customer as rcustomer','requests.phone as rphone', 'employees.name as empname', 'branches.name as branchname', 'locations.name as llocations','regions.name as regname', 'requests.call_status as callstatus', 'requests.call_response as responsestatus' )
                 ->orderBy('requests.id', 'DESC')
        ->get();

        return $export;

    }

    public static function listChartSatisfied()
    {
        return DB::table('requests')
            ->join('employees', 'requests.employee_id', '=', 'employees.id')
            ->join('branches', 'requests.branch_id', '=', 'branches.id')
            ->join('locations', 'requests.location_id', '=', 'locations.id')
            ->join('regions', 'requests.region_id', '=', 'regions.id')
            ->select(DB::raw("count(*) as call_response"))
            ->where('requests.call_response', 'S')
            ->where(function ($query) {
                self::filter($query);
            }
            )->orderBy('requests.id', 'DESC')
            ->pluck('call_response');
    }

    public static function listChartUnsatisfied()
    {
        return DB::table('requests')
            ->join('employees', 'requests.employee_id', '=', 'employees.id')
            ->join('branches', 'requests.branch_id', '=', 'branches.id')
            ->join('locations', 'requests.location_id', '=', 'locations.id')
            ->join('regions', 'requests.region_id', '=', 'regions.id')
            ->select(DB::raw("count(*) as call_response"))
            ->where('requests.call_response', 'F')
            ->where(function ($query) {
                self::filter($query);
            }
            )->orderBy('requests.id', 'DESC')
            ->pluck('call_response');
    }
}
