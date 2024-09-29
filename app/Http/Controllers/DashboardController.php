<?php

namespace App\Http\Controllers;

use App\Models\AccountEntry;
use App\Models\AccountLedger;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Location;
use App\Models\Region;
use App\Models\Request;
use App\Models\Executive;
use App\Models\Virtual;
use App\Models\ExecutiveBranch;
use App\Models\ExecutiveRegion;
use App\Models\Virtual\Dashboard;
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

class DashboardController extends Controller {

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

		//$records = Dashboard::paginate() ;
		//$rowsetview = View::make('report.row', ['records' => $records] ) ;
		//$pagerhtml = AjaxPaginator::render($records, 'DashboardTableWrap', 'DashboardController@listtable' ) ;

		//	$employee = $this->employeeOptions();

		//	return View::make('dashboard.table', ['rawsethtml' => $rowsetview, 'pagerhtml' => $pagerhtml ] ) ;

	}

	/**
	 * @return mixed
	 */
	public function page()
	{
		$obj=Dashboard::todayDetails();
		$tilldate=Dashboard::tilldateDetails();
		$satisfiedCustomer=Dashboard::callsSatisfied();
		$unsatisfiedCustomer=Dashboard::callsUnsatisfied();
		$totalSatisfiedCustomer=Dashboard::totalCallsSatisfied();
		$totalUnsatisfiedCustomer=Dashboard::totalCallsUnsatisfied();
		$totalEmployee=Dashboard::countEmployee();
		$blockedEmployee=Dashboard::blockedEmployee();
		$totalRegion=Dashboard::countRegion();
		$blockedRegion=Dashboard::blockedRegion();
		$totalBranch=Dashboard::countBranch();
		$blockedBranch=Dashboard::blockedBranch();
		$totalLocation=Dashboard::countLocation();
		$blockedLocation=Dashboard::blockedLocation();

        $topBranches = Dashboard::topBranches() ;
		//pie reprots
		$cToday = Dashboard::comparisonToday() ;
		$cWeek = Dashboard::comparisonThisWeek() ;
		$cPrevMonth = Dashboard::comparisonPreviousMonth() ;
		$cMonth = Dashboard::comparisonThisMonth() ;
		$cAll= Dashboard::comparisonAllTime() ;

		//return View::make('report.page', ['tablehtml'=> $data,'employeeOptions'=> $employee ,'branchOptions'=>$branch,'regionOptions'=>$region,'locationOptions'=>$location, 'callstatusOptions' => $callstatusOptions] ) ;
		return View::make('dashboard.page', [
				'CustomerCount'=> $obj,
				'TotalCustomerCount'=>$tilldate,
				'TotalSatisfiedtoday'=>$satisfiedCustomer,
				'topBranches' => $topBranches,
				'Totalunsatisfiedtoday'=>$unsatisfiedCustomer,
				'totalSatisfiedCustomer'=>$totalSatisfiedCustomer,
				'TotalUnatisfiedCustomer'=>$totalUnsatisfiedCustomer,
				'totalEmploee'=>$totalEmployee,
				'blockedemployee'=>$blockedEmployee,
				'totalRegion'=>$totalRegion,
				'blockedRegion'=>$blockedRegion,
				'totalBranch'=>$totalBranch,
				'blockedBranch'=>$blockedBranch,
				'blockedRegion'=>$blockedRegion,
				'totalLocation'=>$totalLocation,
				'blockedLocation'=>$blockedLocation,
				'cToday' => $cToday,
				'cWeek' => $cWeek,
				'cPrevMonth' => $cPrevMonth,
				'cMonth' => $cMonth,
				'cAll' => $cAll,
			]
		) ;
	}





}