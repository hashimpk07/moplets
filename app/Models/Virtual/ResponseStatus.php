<?php

namespace App\Models\Virtual;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */

class ResponseStatus extends Model
{
    public static $SATISFIED = 'S' ;
    public static $UNSATISFIED = 'F' ;
    public static $PENDING = 'P' ;

    public static function explain($type)
    {
        switch ($type) {
            case 'S' :
                return 'Satisfied' ;
                break;
            case 'F' :
                return 'Unsatisfied' ;
                break;
            case 'P' :
            default :
                return 'Pending' ;
                break ;
        }
        return '' ;
    }
    public static function collections()
    {
        return array (
            'S' => 'Satisfied',
            'F'=> 'Unsatisfied' ) ;
    }
}