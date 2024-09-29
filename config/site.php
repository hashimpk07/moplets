<?php
/**
 * Created by PhpStorm.
 * User: nithin
 * Date: 1/6/2016
 * Time: 5:46 PM
 */

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

//DEFINE CONTANTS..
if( ! defined('SITE_CONTANTS') ) {

    //Self test..
    define('SITE_CONTANTS', true);

    //Design transform
    define('EDIT', 'QRD-EDIT');
    define('ADD', 'QRD-ADD');
    define('VIEW', 'QRD-VIEW');

    define('ADMIN_ID', '1');
    define('PAGER_IPP', 10);
    define('PAGER_QUERY_VAR', 'page');

    define('DEFAULT_SELECT_VALUE', '' ) ;
    define('DEFAULT_SELECT_TEXT', '<option value="' . DEFAULT_SELECT_VALUE . '">--Select--</option>' ) ;
    define('DEFAULT_NO_RECORD_MESSAGE', 'There are no data to display.' ) ;


    //Global functions
    function sortable_column($title, $column, $controller = null ) {
        $args = ['title'=> $title, 'column' => $column, 'controller' => $controller ] ;
        return \Qudratom\Utilities\AjaxPaginator::sortable($args) ;
    }


}

return array(
    'TITLE' => 'Moplet feedback system'
) ;