<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	namespace App\Http\Controllers;

	use App\Models\CashAccount;
	use App\Models\Currency;
	use App\Models\Virtual\BalanceViewer;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Input;
	use Illuminate\Support\Facades\View;
	use Qudratom\Response\JsonResponse;
	use Qudratom\Response\Response;
	use Qudratom\Response\ResponseBuilder;
	use Qudratom\Traits\SelectPairs;
	use Qudratom\Utilities\AjaxPaginator;

	class AjaxController extends Controller {

		use SelectPairs ;

		public function __construct()
		{
		}

		public function options($type) {
			$method = "$type" . "Options" ;
			return $this->{$method}(true);
		}
		public function clickedit()
		{
			$value = Input::get('value') ;
			$id = Input::get('id') ;
			$tableRef = Input::get('table') ;

			$tables = [

				'branch' => [ 'table' => 'branches',
							'field' => 'name',
							'id' => 'id' ] ,

				'region' => [ 'table' => 'regions',
							'field' => 'name',
							'id' => 'id' ] ,

				'location' => [ 'table' => 'locations',
							'field' => 'name',
							'id' => 'id' ] ,

				'location-ivr' => [ 'table' => 'locations',
							'field' => 'ivr',
							'id' => 'id' ] ,

				'employee' => [ 'table' => 'employees',
							'field' => 'name',
							'id' => 'id' ] ,

				'executive' => [ 'table' => 'executives',
							'field' => 'name',
							'id' => 'id' ] ,
			] ;

			if( ! isset($tables[$tableRef]) ) {
				return ;
			}

			$ti = $tables[$tableRef] ;

			$affected = DB::table( $ti['table'] )->where( $ti['id'] , $id )->update( [ $ti['field'] => $value ] ) ;

			if( $affected < 1 )
			{
				return Response::send( Response::bulider()->setStatus(ResponseBuilder::$FAIL)->setMessage('Failed')->build() ) ;
			}
			return Response::send( Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('Success')->build() ) ;
		}
	}