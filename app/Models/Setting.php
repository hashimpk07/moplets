<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    public static function listquery()
    {
        return DB::table(DB::raw('branches AS b'))
            ->select(DB::raw("*"))
            ->groupBy('id')
            ->orderBy('id', 'DESC') ;
    }
}
