<?php

namespace App\Models\Virtual;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DummyClass
 */
class CallStatus extends Model
{
    public static $SUCCESS = 'S' ;
    public static $CALLED = 'C' ;
    public static $FAILED = 'F' ;
    public static $PENDING = 'P' ;

    public static function explain($type)
    {
        switch ($type) {
            case 'P' :
                return 'Pending' ;
                break;
            case 'S' :
                return 'Success' ;
                break;
            case 'C' :
                return 'Attempted' ;
                break;
            case 'F' :
                return 'Failed' ;
                break;
        }
        return '' ;
    }
    public static function collections()
    {
        return array (
            'P' => 'Pending',
            'C' => 'Attempted',
            'F'=> 'Failure',
            'S'=> 'Success');
    }
}
