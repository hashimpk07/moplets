<?php
namespace Qudratom\Utilities;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class Validations
{
    public static function boot()
    {
        self::empty_array() ;
        self::duplicate_array() ;
        self::greater() ;
        self::greatereq() ;
        self::lesser() ; //uncomment when in use
        self::lessereq() ; //uncomment when in use
        self::ismissing() ;
        self::ismissing_array() ;
        self::password_check() ;
        self::isexists() ;
    }

    /**
     * Check old password match given
     *
     * password column must be "password"
     * where raw can include additional conditions, do not include password check.
     * Hash::make will be used for password check
     */
    public static function isexists()
    {
        Validator::extendImplicit(
            'isexists', function($attribute, $value, $parameters, $validator) {
            $table = $parameters[0] ;
            $column = $parameters[1] ;
            if( isset($parameters[2]) ) {
                $whereRraw = $parameters[2];
            }
            else {
                $whereRraw = " 1 " ;
            }

            $whereRraw .= " AND $column='$value' " ;

            $count = DB::table(DB::raw($table))
                ->select(DB::raw("COUNT($column) as count"))
                ->whereRaw($whereRraw)->pluck('count') ;

            if( $count < 1 ) {
                return true ;
            }
            return false ;

        }, ':attribute already exists') ;
    }

    /**
     * Check old password match given
     *
     * password column must be "password"
     * where raw can include additional conditions, do not include password check.
     * Hash::make will be used for password check
     */
    public static function password_check()
    {
        Validator::extendImplicit(
            'password_check', function($attribute, $value, $parameters, $validator) {
            $table = $parameters[0] ;
            $column = $parameters[1] ;
            $whereRraw = $parameters[2] ;

            $pass = DB::table(DB::raw($table))
                ->select(DB::raw($column))
                ->whereRaw($whereRraw)->pluck($column) ;

            if( Hash::check($value, $pass) ) {
                return true ;
            }
            return false ;

        }, 'Password not matching') ;
    }

    /**
     * Check array of inputs have atleast one field
     *
     */
    public static function empty_array()
    {
        Validator::extendImplicit('empty_array', function($attribute, $value, $parameters, $validator) {
            if( count( $value ) < 1 )
            {
                return false ;
            }
            return true ;
        }, 'Have no :attribute present') ;
    }

    /**
     * Check input value is greater than specified.
     */
    public static function greater()
    {
        Validator::extendImplicit('greater', function($attribute, $value, $parameters, $validator) {
            if( $value > $parameters[0] )
            {
                return true ;
            }
            return false ;
        }, 'The :attribute must be greater than :value') ;
        
        Validator::replacer('greater', function($message, $attribute, $rule, $parameters) {
            return str_replace( ":value", @$parameters[0], $message );
        });
    }
    /**
     * Check input value is greater than specified.
     */
    public static function greatereq()
    {
        Validator::extendImplicit('greatereq', function($attribute, $value, $parameters, $validator) {
            if( $value >= $parameters[0] )
            {
                return true ;
            }
            return false ;
        }, 'The :attribute must be greater than :value') ;

        Validator::replacer('greatereq', function($message, $attribute, $rule, $parameters) {
            return str_replace( ":value", @$parameters[0], $message );
        });
    }
    /**
     * Check input value is lesser than specified.
     */
    public static function lesser()
    {
        Validator::extendImplicit('lesser', function($attribute, $value, $parameters, $validator) {
            if( $value < $parameters[0] )
            {
                return true ;
            }
            return false ;
        }, 'The :attribute must be less than :value') ;

        Validator::replacer('lesser', function($message, $attribute, $rule, $parameters) {
            return str_replace( ":value", @$parameters[0], $message );
        });
    }
    /**
     * Check input value is lesser than specified.
     */
    public static function lessereq()
    {
        Validator::extendImplicit('lessereq', function($attribute, $value, $parameters, $validator) {
            if( $value <= $parameters[0] )
            {
                return true ;
            }
            return false ;
        }, 'The :attribute must be less than :value') ;

        Validator::replacer('lessereq', function($message, $attribute, $rule, $parameters) {
            return str_replace( ":value", @$parameters[0], $message );
        });
    }

    /**
     * check user input has atlease anything in it.
     */
    public static function ismissing()
    {
        Validator::extendImplicit('ismissing', function($attribute, $value, $parameters, $validator) {
            if( $value )
            {
                return true ;
            }
            return false ;
        }, 'The :attribute not specified') ;
    }

    /**
     * Check user missed to enter a value in any of field in an array. All field must be filled in.
     */
    public static function ismissing_array()
    {
        Validator::extendImplicit('ismissing_array', function($attribute, $value, $parameters, $validator) {
            foreach( $value AS $k => $v )
            {
                if( ! $v ) {
                    return false;
                }
            }
            return true ;
        }, 'Some :attribute is missing') ;
    }

    /**
     * Check wheather the array of input has duplicate values. Means in a row user selected same values.
     */
    public static function duplicate_array()
    {
        Validator::extendImplicit('duplicate_array', function($attribute, $value, $parameters, $validator) {
            $dupe_array = array();
            if( is_array($value) ) {
                foreach ($value as $val)
                {
                    if( ! isset($dupe_array[$val]) ){
                        $dupe_array[$val] = 1 ;
                    }
                    else {
                        $dupe_array[$val] ++ ;
                    }
                    if( $dupe_array[$val] > 1 ) {
                        return false ;
                    }
                }
            }
            return true ;
        }, 'Duplicate :attribute present') ;
    }
}
?>