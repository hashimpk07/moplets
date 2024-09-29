<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Input;


class Executive extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    public static function filter($query)
    {
        $keyword = Input::get("search") ;
        $query->where('ex.name', 'LIKE', "%$keyword%") ;
    }
    public static function listquery()
    {
        return DB::table(DB::raw('executives AS ex'))
                 ->select(DB::raw("*"))
                 ->where(function($query)
                 {
                     self::filter($query) ;
                 }
                 )
                ->where('id', '!=', ADMIN_ID)
                 ->groupBy('id')
                 ->orderBy('id', 'DESC') ;
    }
    public static function detail($id)
    {
        return DB::table(DB::raw('executives AS ex'))
                 ->select(DB::raw('ex.id, ex.name As name, ex.username As username, ex.password As password ' ))
                 ->where('ex.id', '=', $id)
                 ->first() ;
    }
}
