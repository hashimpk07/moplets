<?php
/**
 * Created by PhpStorm.
 * User: nithin
 * Date: 12/9/2015
 * Time: 1:40 PM
 */

namespace Qudratom\Utilities;

class DateTime {

    public static function clientDate($dt = null, $format = 'd-m-Y')
    {
        return self::clientDateTime($dt, $format);
    }
    public static function clientTime($dt = null, $format = 'h:i a')
    {
        return self::clientDateTime($dt, $format);
    }
    public static function clientDateTime($dt = null, $format = 'd-m-Y h:i a')
    {
        if( $dt === null)
        {
            return '' ;
        }
        if ($dt)
        {
            $t = strtotime($dt);
            if ($t && $t != -19800 && $dt != '0000-00-00' && $dt != '0000-00-00 00:00:00')
            {
                return Date($format, $t);
            }
        }
        return '';
    }
    public static function mysqlDate($dt = null)
    {
        return self::mysqlDateTime($dt, 'Y-m-d') ;
    }
    public static function mysqlDateTime($dt = null, $format = 'Y-m-d H:i:s')
    {
        if( $dt === null)
        {
            return '' ;
        }

        if ($dt)
        {
            return Date($format, strtotime($dt));
        }
        return '';
    }
    public static function mysqlWithTime($dt = null, $start_time = '00:00:00')
    {
        $dt = self::mysqlDate($dt) ;
        return self::mysqlDateTime( $dt . ' ' . trim($start_time) ) ;
    }


}