<?php

	namespace App\Http\Controllers;

	use App\Models\AccountEntry;
	use App\Models\AccountLedger;
	use App\Models\Executive;
	use App\Models\ExecutiveBranch;
	use App\Models\ExecutiveDetail;
	use App\Models\ExecutiveRegion;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Hash;
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
	use Symfony\Component\EventDispatcher\Tests\EventDispatcherTest;

	class ExecutiveController extends Controller {

		use SelectPairs;

		public function __construct()
		{
			parent::__construct() ;

			$id=Auth::user()->id;
			if($id != ADMIN_ID)
			{
				Auth::logout();
				return redirect()->intended('auth/login') ;
			}

		}

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
			$records = Executive::paginate() ;
			$rowsetview = View::make('executive.row', ['records' => $records] ) ;
			$pagerhtml = AjaxPaginator::render($records, 'ExecutiveTableWrap', 'ExecutiveController@listtable' ) ;

			return View::make('executive.table', ['rawsethtml' => $rowsetview, 'pagerhtml' => $pagerhtml] ) ;
		}
		public function page()
		{
			$data = $this->listtable() ;
			return View::make('executive.page', ['tablehtml'=> $data] ) ;
		}
		public function doValidate($mode, $editId = 0 )
		{
			//error fields
			$pwdErrfield =  array('executivePassword' => 'eexecutivePassword') ;
			$errfields = array(
				'executiveName' => 'eexecutiveName',
				'executiveUserName' => 'eexecutiveUserName',
				'executiveRegion' => 'eexecutiveRegion',
				'executiveBranch' => 'eexecutiveBranch'

			) ;

			$pwdAttributes =  array('executivePassword' => 'executivePassword') ;
			//lable display attributes
			$attributes = array(
				'executiveName' => 'executiveName',
				'executiveUserName' => 'executiveUserName',
				'executiveRegion' => 'executiveRegion',
				'executiveBranch' => 'executiveBranch'
			) ;

			$pwdData=array('executivePassword' => Input::get('executivePassword'));
			//validation data
			$data = [
				'executiveName' => Input::get('executiveName'),
				'executiveUserName' => Input::get('executiveUserName'),
				'executiveRegion' => Input::get('executiveRegion'),
				'executiveBranch' => Input::get('executiveBranch')

			];
			//validation rules
			$where = "" ;
			if( $mode == EDIT ){
				$where = ", id !='" . $editId . "' ";
			}
			if((CONST_MODULE_REGION==1)&&(CONST_MODULE_BRANCH==1)){

				$pwdRules=array('executivePassword'=>['required']);
				$rules = [
					'executiveName' => ['required'],
					'executiveUserName' => ['required',"isexists:executives,username $where"],
					'executiveRegion'=>['required'],
					'executiveBranch'=>['required']
				] ;

			}
			else if((CONST_MODULE_REGION==1)&&(CONST_MODULE_BRANCH!=1)){

				$pwdRules=array('executivePassword'=>['required']);
				$rules = [
					'executiveName' => ['required'],
					'executiveUserName' => ['required',"isexists:executives,username $where"],
					'executiveRegion'=>['required']

				] ;

			}
			else if((CONST_MODULE_REGION!=1)&&(CONST_MODULE_BRANCH==1)){
				$pwdRules=array('executivePassword'=>['required']);
				$rules = [
					'executiveName' => ['required'],
					'executiveUserName' => ['required',"isexists:executives,username $where"],
					'executiveBranch'=>['required']
				] ;

			}
			else{
				$pwdRules=array('executivePassword'=>['required']);
				$rules = [
					'executiveName' => ['required'],
					'executiveUserName' => ['required',"isexists:executives,username $where"],

				] ;

			}

			if(  $mode == ADD )
			{
				array_push($errfields,$pwdErrfield);
				array_push($attributes,$pwdAttributes);
				array_push($data,$pwdData);
				array_push($rules,$pwdRules);

			}
			$validator = Validator::make( $data, $rules );
			$validator->setAttributeNames($attributes) ;

			if ($validator->fails())
			{
				$errors = $validator->messages();
				return ErrorFormat::format($errors, $errfields) ;
			}
			return null ;
		}
		public function onAdd()
		{
			$executiveName = Input::get('executiveName');
			$executiveUserName = Input::get('executiveUserName');
			$executivePassword = Input::get('executivePassword');
			$executiveRegion = Input::get('executiveRegion');
			$executiveBranch = Input::get('executiveBranch');

			$newPassword = Hash::make($executivePassword);


			//if any error return
			$errors = $this->doValidate(ADD);
			if ($errors != null) {
				if (count($errors) > 0) {
					return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->addErrors($errors)->setMessage('Please fix errors')->build()) ;
				}
			}

			$ca = new Executive();
			$ca->name = $executiveName ;
			$ca->username = $executiveUserName;
			$ca->	password = $newPassword;
			if( $ca->save() )
			{
				if ( !is_null( $executiveRegion) ) {
					foreach ( $executiveRegion as $id ) {

						$exc               = new ExecutiveRegion();
						$exc->executive_id = $ca->id;
						$exc->region_id    = $id;
						$exc->Save();
					}
				}
				if ( !is_null( $executiveBranch ) ) {
					foreach ( $executiveBranch as $id ) {

						$bran               = new ExecutiveBranch();
						$bran->executive_id = $ca->id;
						$bran->branch_id    = $id;
						$bran->Save();

					}
				}
				return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('Success')->build()) ;
			}
			return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->setMessage('Failed')->build()) ;
		}
		public function add()
		{
			$vars = array(
				'url' => action('ExecutiveController@onAdd'),
				'QRD_MODE' => ADD,
				'regionOptions' => $this->regionOptions(),
				'branchOptions' => $this->branchOptions(),

			);
			return urlencode(View::make('executive.add', $vars)->render()) ;
		}
		public function onEdit($id){

			$executiveName = Input::get('executiveName');
			$executiveUserName = Input::get('executiveUserName');
			$executivePassword = Input::get('executivePassword');
			$executiveRegion = Input::get('executiveRegion');
			$executiveBranch = Input::get('executiveBranch');

			if($executivePassword!="")
			{
				$newPassword = Hash::make($executivePassword);

			}

			//if any error return
			$errors = $this->doValidate(EDIT,$id);
			if ($errors != null) {
				if (count($errors) > 0) {
					return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->addErrors($errors)->setMessage('Please fix errors')->build()) ;
				}
			}

			DB::table('executive_regions')->where('executive_id', $id)->delete();
			DB::table('executive_branches')->where('executive_id', $id)->delete();
			$ca = Executive::find($id) ;
			$ca->name = $executiveName ;
			$ca->username = $executiveUserName;
			if($executivePassword!="")
			{
				$ca->	password = $newPassword;
			}

			if( $ca->save() )
			{
				if ( !is_null( $executiveRegion) ) {
					foreach ( $executiveRegion as $id ) {

						$exc               = new ExecutiveRegion();
						$exc->executive_id = $ca->id;
						$exc->region_id    = $id;
						$exc->Save();
					}
				}
				if ( !is_null( $executiveBranch ) ) {
					foreach ( $executiveBranch as $id ) {

						$bran               = new ExecutiveBranch();
						$bran->executive_id = $ca->id;
						$bran->branch_id    = $id;
						$bran->Save();
					}
				}

				return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('Success')->build()) ;
			}
			return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->setMessage('Failed')->build()) ;

		}
		public function edit($id)
		{
			$ca = Executive::detail($id) ;
			$vars = array(
				'url' => action('ExecutiveController@onEdit',[$id]),
				'record' => $ca,
				'QRD_MODE' => EDIT,
				'regionOptions' => $this->regionOptions(),
				'branchOptions' => $this->branchOptions(),
				'executiveBranches' => $this->executiveBranchOptions($id),
				'executiveRegions' => $this->executiveRegionOptions($id),

			);
			return urlencode(View::make('executive.add', $vars)->render()) ;
		}
		public function view($id)
		{
			$ca = Executive::detail($id) ;
			$vars = array(
				'url' => action('ExecutiveController@onAdd'),
				'record' => $ca,
				'QRD_MODE' => VIEW,
				'regionOptions' => $this->regionOptions(),
				'branchOptions' => $this->branchOptions(),
				'executiveBranches' => $this->executiveBranchOptions($id),
				'executiveRegions' => $this->executiveRegionOptions($id),
			);

			return urlencode(View::make('executive.add', $vars)->render()) ;
		}
		public function block($id)
		{
			$executive             = Executive::find( $id );
			$executive->is_blocked = 0;
			if( $executive->save() ) {
				return Response::send( Response::bulider()->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() );
			}
			else {
				return Response::send( Response::bulider()->setStatus( ResponseBuilder::$FAIL )->setMessage( 'Failed' )->build() );
			}
		}
		public function unblock($id)
		{
			$executive             = Executive::find( $id );
			$executive->is_blocked = 1;
			if( $executive->save() ) {
				return Response::send( Response::bulider()->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() );
			}
			else{
				return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->setMessage('Failed')->build());

			}
		}
	}