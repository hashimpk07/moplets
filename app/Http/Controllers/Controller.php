<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;

abstract class Controller extends BaseController  {

	use DispatchesCommands, ValidatesRequests;

	public function __construct($public = false)
	{
		$result = DB::table('settings')->select('*')->get();
		foreach( $result as $result )
		{
			define( 'CONST_' . $result->code, $result->value ) ;
		}

		if( ! $public ) {
			$this->middleware( 'auth' );
		}
	}
}
