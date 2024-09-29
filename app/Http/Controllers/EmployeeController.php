<?php

namespace App\Http\Controllers;

use App\Models\AccountEntry;
use App\Models\AccountLedger;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Qudratom\Response\JsonResponse;
use Qudratom\Response\Response;

use Illuminate\Support\Facades\View;
use Qudratom\Response\ResponseBuilder;
use Qudratom\Traits\Options;
use Qudratom\Traits\SelectPairs;
use Qudratom\Utilities\AjaxPaginator;
use Qudratom\Utilities\ErrorFormat;

class EmployeeController extends Controller {

	use SelectPairs;

	/**
	 * Show the profile for the given user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function index()
	{
		return $this->page() ;
	}
	public function listtable()
	{
		$records = Employee::paginate() ;

		$rowsetview = View::make('employee.row', ['records' => $records] ) ;

		$pagerhtml = AjaxPaginator::render($records, 'EmployeeTableWrap', 'EmployeeController@listtable' ) ;

		return View::make('employee.table', ['rawsethtml' => $rowsetview, 'pagerhtml' => $pagerhtml] ) ;
	}
	public function page()
	{
		$data = $this->listtable() ;
		return View::make('employee.page', ['tablehtml'=> $data] ) ;
	}
	public function doValidate($mode)
	{
		$amtA = Input::get('txtAmount') ;
		$levelA = Input::get('txtAlertLevel') ;
		$currencyA = Input::get('selCurrency') ;

		//error fields
		$errfields = array(
			'txtName' => 'eName',
			'selCurrency' => 'eCurrency',
		) ;
		//lable display attributes
		$attributes = array(
			'txtName' => 'Account Name',
			'selCurrency' => 'Currency',
		) ;
		//validation data
		$data = [
			'txtName' => Input::get('txtName'),
			'selCurrency' => Input::get('selCurrency'),
		];
		//validation rules
		$rules = [
			'txtName' => ['required', 'min:2'],
			'selCurrency' => ['duplicate_array'],
		] ;

		if( is_array($amtA) ) {
			foreach ($amtA AS $k => $amt) {

				$data['txtAmount#' . $k] = $amtA[$k];
				$rules['txtAmount#' . $k] = ['numeric'];
				$errfields['txtAmount#' . $k] = 'eAmount' . $k;
				$attributes['txtAmount#' . $k] = 'Opening balance';

				$data['txtAlertLevel#' . $k] = $levelA[$k];
				$rules['txtAlertLevel#' . $k] = ['numeric'];
				$errfields['txtAlertLevel#' . $k] = 'eAlertLevel' . $k;
				$attributes['txtAlertLevel#' . $k] = 'Alert Level';

				$data['selCurrency#' . $k] = $currencyA[$k];
				$rules['selCurrency#' . $k] = ['numeric', 'required'];
				$errfields['selCurrency#' . $k] = 'eCurrency' . $k;
				$attributes['selCurrency#' . $k] = 'Currency';
			}
		}

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
		$name = Input::get('txtName');
		$levelA = Input::get('txtAlertLevel');
		$amtA = Input::get('txtAmount');
		$curA = Input::get('selCurrency');
		$caA = Input::get('txtRowId');

		//if any error return
		$errors = $this->doValidate(EDIT);

		if ($errors != null) {
			if (count($errors) > 0) {

				return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->addErrors($errors)->setMessage('Please fix errors')->build()) ;
			}
		}

		//save to db.
		DB::beginTransaction();

		//save cash account
		$ca = Employee::find($id) ;
		$ca->name = $name ;
		$ledger_id = $ca->account_ledger_id ;
		//first insert ledger
		$al = AccountLedger::find($id) ;
		$al->name = $name;
		$al->save();

		if( $ca->save() )
		{
			$cash_acccount_id = $ca->id ;

			//multiple rows
			foreach( $curA as $i => $v ) {
				$amt1 = $amtA[$i];
				$level1 = $levelA[$i] ;
				$cur1 = $curA[$i];
				$caId = $caA[$i];

				if( $caId ) //its update
				{
					//info table
					$info = EmployeeDetail::find($caId);
					$info->alert_level = $level1;
					$info->save();
				}
				else
				{
					//info table
					$info = new EmployeeDetail();
					$info->branch_id = $cash_acccount_id;
					$info->alert_level = $level1;
					$info->currency_id = $cur1;
					$info->opening_balance = $amt1;
					$info->save();

					$ce = new AccountEntry();
					$ce->mode = ENTRY_OPENING ;
					$ce->account_ledger_id = $ledger_id;
					$ce->amount = $amt1;
					$ce->currency_id = $cur1;
					$ce->dt = DB::raw('NOW()') ;
					$ce->save();
				}
			}

			DB::commit() ;
			return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('Success')->build()) ;
		}
		DB::rollback() ;
		return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->setMessage('Failed')->build()) ;
	}
	public function onAdd()
	{
		$name = Input::get('txtName');
		$levelA = Input::get('txtAlertLevel');
		$amtA = Input::get('txtAmount');
		$curA = Input::get('selCurrency');

		//if any error return
		$errors = $this->doValidate(ADD);

		if ($errors != null) {
			if (count($errors) > 0) {
				return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->addErrors($errors)->setMessage('Please fix errors')->build()) ;
			}
		}

		//save to db.
		DB::beginTransaction() ;
		//first insert ledger
		$al = new AccountLedger();
		$al->name = $name;
		$al->account_group_id = ACCOUNT_GROUP_CASH;
		$al->save();
		//get insert id
		$ledger_id = $al->id;
		//save cash account
		$ca = new Branch();
		$ca->name = $name;
		$ca->account_ledger_id = $ledger_id;
		if( $ca->save() )
		{
			$cash_acccount_id = $ca->id ;

			//multiple rows
			if( is_array($curA) ) {
				foreach ($curA as $i => $v) {
					$amt1 = $amtA[$i];
					$level1 = $levelA[$i];
					$cur1 = $curA[$i];
					//info table
					$info = new BranchDetail();
					$info->branch_id = $cash_acccount_id;
					$info->alert_level = $level1;
					$info->currency_id = $cur1;
					$info->opening_balance = $amt1;
					$info->save();

					$ce = new AccountEntry();
					$ce->mode = ENTRY_OPENING ;
					$ce->account_ledger_id = $ledger_id;
					$ce->amount = $amt1;
					$ce->currency_id = $cur1;
					$ce->dt = DB::raw('NOW()');
					$ce->save();
				}
			}
			DB::commit() ;
			return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('Success')->build()) ;
		}
		DB::rollback() ;
		return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->setMessage('Failed')->build()) ;
	}
	public function add()
	{
		$vars = array(
			'url' => action('BranchController@onAdd'),
			'QRD_MODE' => ADD,
			'currencyOptions' => $this->currencyOptions()
		);
		return urlencode(View::make('branch.add', $vars)->render()) ;
	}
	public function edit($id)
	{
		$ca = Branch::find($id) ;
		$cdi = BranchDetail::where('branch_id', '=', $id)->get() ;
		$vars = array(
			'url' => action('BranchController@onEdit', [$id] ),
			'record' => $ca,
			'details' => $cdi,
			'QRD_MODE' => EDIT,
			'currencyOptions' => $this->currencyOptions()
		) ;
		return urlencode(View::make('branch.add', $vars)->render()) ;
	}
	public function view($id)
	{
		$ca = Employee::find($id) ;
		$cdi = EmployeeDetail::where('branch_id', '=', $id)->get() ;

		$vars = array(
			'QRD_MODE' => VIEW,
			'record' => $ca,
			'details' => $cdi,
			'url' => action('EmployeeController@onAdd'),
			'currencyOptions' => $this->currencyOptions()
		) ;
		return urlencode(View::make('employee.add', $vars)->render()) ;
	}
	public function delete($id)
	{
		if( Employee::destroy($id) ) {
			return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('Success')->build());
		}
		return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->setMessage('Failed')->build());
	}
	public function block($id)
	{

		$employee = Employee::find( $id );

		$blk = $employee->is_blocked;

		if ( $blk == 0 ) {


			$employee->is_blocked = 1;
			if($employee->save()) {
				return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('Blocked')->build());
			}

		}

			$employee->is_blocked = 0;
			$employee->save();
			return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('UnBlocked')->build());


	}
}