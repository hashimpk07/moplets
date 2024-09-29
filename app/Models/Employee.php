<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class Employee extends Model {

	//
    public static function filter($query)
    {
        $keyword = Input::get("search") ;
        $query->where('e.name', 'LIKE', "%$keyword%") ;
        $query->orWhere('e.ref_employee_id', 'LIKE', "%$keyword%") ;
    }
    public static function listquery()
    {
        return DB::table(DB::raw('employees AS e'))
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
