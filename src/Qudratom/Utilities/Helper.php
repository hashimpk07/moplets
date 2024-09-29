<?php
/**
 * Created by PhpStorm.
 * User: Hashim
 * Date: 12/9/2016
 * Time: 1:40 PM
 */

namespace Qudratom\Utilities;

class Helper {

	public static function arrayToInQuery( $array ) {
		$str = "";
		if ( @ count( $array ) < 1 ) {
			return 'NULL';
		}
		foreach ( $array AS $one ) {
			if ( $str ) {
				$str .= ",";
			}
			$str .= "'$one'";
		}

		return $str;
	}

	/**
	 * Get current action details
	 *
	 * @param $typical
	 *
	 * @return mixed
	 */
	public static function actionDetail( $typical ) {
		$action = app( 'request' )->route()->getAction();
		$cname  = basename( $action['controller'] );
		list( $controller, $function ) = explode( '@', $cname );

		$set = [
				'controller' => $controller,
				'method' => $function,
				'name' => str_ireplace('Controller', '', $controller)
			];

		if ( isset( $set[ $typical ] ) ) {
			return $set[ $typical ];
		}
	}

	public static function pingUrl( $url ) {

		ob_start();

		$ch      = curl_init();
		$timeout = 5;

		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
		$data = curl_exec( $ch );

		ob_get_clean();

		return $data;
	}
public static function array2Csv($recset, $columns, $header = null, $footer = null)
	{
		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename=excel' . Date('YmdHis') . '.csv');

		$handle = fopen('php://output', 'w');

		if (is_array($header))
		{
			foreach ($header as $v)
			{
				if(is_array($v)) {
					fputcsv($handle, $v);
				}
			}
		}

		if( ! is_array($columns) )
		{
			$columnsNew = array() ;
			$columnsTemp = array_keys(reset($recset)) ;
			foreach( $columnsTemp as $k => $v )
			{
				$key = $v ;
				$s = stripos($v, '_') ;
				if( $s !== false )
				{
					$s ++ ;
				}
				$v = substr($v, $s) ;
				$v = ucfirst($v) ;
				$columnsNew[$key] = $v ;
			}

			$columns = $columnsNew ;
		}
		fputcsv($handle, $columns);

		if (is_resource($recset))
		{
			while ($trec = mysql_fetch_array($recset))
			{
				$rec = array();
				foreach ($columns as $k => $v)
				{
					$rec[] = @$trec[$k];
				}
				fputcsv($handle, $rec);
			}
		}
		else
		{
			foreach ($recset as $row)
			{
				$rec = array();
				foreach ($columns as $k => $v)
				{
					$rec[] = @$row[$k];
				}
				fputcsv($handle, $rec);
			}
		}
		if (is_array($footer))
		{
			foreach ($footer as $v)
			{
				if( is_array($v) ){
					fputcsv($handle, $v);
				}
			}
		}
		fclose($handle);
	}


}
