<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Executive;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Qudratom\Response\Response;
use Qudratom\Response\ResponseBuilder;
use Qudratom\Utilities\ErrorFormat;

class PasswordController extends Controller {

	public function index()
	{
		return $this->listtable() ;
	}
	public function listtable()
	{
		$userId = Auth::user()->id ;

		return View::make('password.page', [
			'url' => action('PasswordController@onEdit', $userId)
		] ) ;
	}
	public function doValidate($mode, $id)
	{
		$old = Input::get('currentPassword') ;
		$pass1 = Input::get('newPassword') ;
		$pass2 = Input::get('conformPassword') ;

		//error fields
		$errfields = array(
			'currentPassword' => 'ecurrentPassword',
			'newPassword' => 'enewPassword',
			'conformPassword' => 'econformPassword',
		) ;
		//lable display attributes
		$attributes = array(
			'currentPassword' => 'Old Password',
			'newPassword' => 'New Password',
			'conformPassword' => 'Confirm Password',
		) ;
		//validation data
		$data = [
			'currentPassword' => Input::get('currentPassword'),
			'newPassword' => Input::get('newPassword'),
			'conformPassword' => Input::get('conformPassword'),
		];
		//validation rules
		$rules = [
			'currentPassword' => ['required', 'password_check:executives,password,id=' . $id],
			'newPassword' => ['required'],
			'conformPassword' => ['required']
		] ;

		$validator = Validator::make( $data, $rules );
		$validator->setAttributeNames($attributes) ;

		if ($validator->fails())
		{
			$errors = $validator->messages() ;
			return ErrorFormat::format($errors, $errfields) ;
		}
		return null ;
	}
	public function onEdit($id)
	{
		$old = Input::get('currentPassword');
		$pass1 = Input::get('newPassword');

		//if any error return
		$errors = $this->doValidate(EDIT, $id);

		if ($errors != null) {
			if (count($errors) > 0) {

				return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->addErrors($errors)->setMessage('Please fix errors')->build()) ;
			}
		}

		$id = Auth::user()->id ;
		$p = Executive::find($id) ;
		$p->password = Hash::make($pass1) ;
		if( $p->save() )
		{
			return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('Success')->build()) ;
		}
		return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->setMessage('Failed')->build()) ;
	}
	public function edit($id)
	{
		$ca = Executive::find($id) ;

		$vars = array(
			'url' => action('PasswordController@onEdit'),
			'record' => $ca,
			'QRD_MODE' => EDIT,
		) ;
		return urlencode(View::make('password.add', $vars)->render()) ;
	}
	public function view($id)
	{
		$ca = Executive::find($id) ;

		$vars = array(
			'QRD_MODE' => VIEW,
			'record' => $ca,
			'url' => action('PasswordController@onEdit'),
		) ;
		return urlencode(View::make('password.add', $vars)->render()) ;

	}



}
