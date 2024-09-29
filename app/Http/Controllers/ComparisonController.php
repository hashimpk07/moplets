<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Branch;
use App\Models\Location;
use App\Models\Region;
use App\Models\Request;
use App\Models\Executive;
use App\Models\ExecutiveBranch;
use App\Models\ExecutiveRegion;
use Illuminate\Support\Facades\Auth;
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

class ComparisonController extends Controller {

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
		//$records = Request::paginate() ;
	//	$records = Request::listChartSatisfied();
		$recordsatisfied = Request::listChartSatisfied();
		$recordunsatisfied = Request::listChartUnsatisfied();

		//	$employee = $this->employeeOptions();
		return View::make('comparison.table', ['recordsatisfied' => $recordsatisfied,'recordunsatisfied'=>$recordunsatisfied ] ) ;
	}
	public function page()
	{
		$data = $this->listtable() ;
		$employee = $this->employeeOptions();
		$id=Auth::user()->id;
		if($id==ADMIN_ID){

			$branch = $this->branchOptions();
			$region =$this->regionOptions();
		}
		else {
			$branch = $this->executiveBranchOptions($id);
			$region =$this->executiveRegionOptions($id);
		}

		$location=$this->locationOptions();
		$callstatusOptions = $this->callstatusOptions();
		return View::make('comparison.page', ['tablehtml'=> $data,'employeeOptions'=> $employee ,'branchOptions'=>$branch,'regionOptions'=>$region,'locationOptions'=>$location, 'callstatusOptions' => $callstatusOptions] ) ;
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
	public function view($id)
	{
		$ca = Comparison::find($id) ;
		$cdi = ComparisonDetail::where('report_id', '=', $id)->get() ;

		$vars = array(
			'QRD_MODE' => VIEW,
			'record' => $ca,
			'details' => $cdi,
			'url' => action('ComparisonController@onAdd'),
			'employeeOptions' => $this->employeeOptions()
		) ;
		return urlencode(View::make('report.add', $vars)->render()) ;
	}
	public function delete($id)
	{
		if( Report::destroy($id) ) {
			return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('Success')->build());
		}
		return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->setMessage('Failed')->build());
	}
	public function block($id)
	{
		$report = Report::find( $id );

		$blk = $report->is_blocked;

		if ( $blk == 0 ) {
			$report->is_blocked = 1;
			if($report->save()) {
				return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('Blocked')->build());
			}
		}

		$report->is_blocked = 0;
		$report->save();
		return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('UnBlocked')->build());


	}
}