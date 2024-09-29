<?php
/**
 * Created by PhpStorm.
 * User: HASHIM PK
 * Date: 3/24/2018
 * Time: 4:40 PM
 */
namespace Qudratom\Traits;
use Illuminate\Support\Facades\Input;
use Qudratom\Utilities\RecordNo;


Trait ModelTrait
{

    public static $pageNo = 1 ;
    public static  $fetch = PAGER_IPP ;
    public static $offset = 0 ;

    /**
     * Cgm Function..
     *
     * @param $key
     * @param $value
     * @param $sortColumn
     */
    public static function pairList($key, $value, $whereRaw, $sortColumn= null, $sortOrder = 'asc')
    {
        if( ! $whereRaw ) {
            $whereRaw = ' 1 ' ;
        }
        if( ! $sortColumn ) {
            $sortColumn = $value ;
        }
        return self::whereRaw($whereRaw)->orderBy($sortColumn, $sortOrder)->lists($value,$key);
    }
    /**
     * @param $object
     * @return mixed
     */
    public static function withRecordNo($object)
    {
        $object->recordno = new RecordNo() ;
        $object->recordno->setStartingNo(self::$offset) ;
        return $object ;
    }

    private static function sortBy($defaultColumn)
    {
        if( Input::get('sort-by') ) {
            return urldecode( Crypt::decrypt( Input::get('sort-by') ) ) ;
        }
        return $defaultColumn ;
    }

    private static function sortOrder($defaultOrder)
    {
        if( Input::get('sort-order') ) {
            if( Input::get('sort-order') == 'desc' ) {
                return 'asc' ;
            }
            else {
                return 'desc' ;
            }
        }
        return $defaultOrder ;
    }
    public static function paginate()
    {
        self::$pageNo = Input::get(PAGER_QUERY_VAR) ;
        self::$fetch = PAGER_IPP ;
        self::$offset = (self::$pageNo * self::$fetch) - self::$fetch ;
        self::$offset = (( self::$offset < 0 ) ? 0 : self::$offset) ;

        $ret = self::listquery()->offset(self::$offset)->paginate(self::$fetch);

        return self::withRecordNo($ret) ;
    }
    public static function whole()
    {
        $ret = new Objectize( self::query()->get() ) ;
        return self::withRecordNo($ret) ;
    }
    //}
}
