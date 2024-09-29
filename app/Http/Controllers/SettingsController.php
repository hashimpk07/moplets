<?php

	namespace App\Http\Controllers;

	use App\Models\AccountEntry;
	use App\Models\AccountLedger;
	use App\Models\Setting;
	use App\Models\SettingDetail;
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
	use Qudratom\Utilities\FileUpload;

	class SettingsController extends Controller {

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
		public function page()
		{
			$general = $this->brandingGeneral() ;
			$modules = $this->brandingModules() ;

			$call = $this->apiCalling() ;
			$income = $this->apiIncome() ;

			$callTime = $this->parametersPermitedTime() ;
			$ivr = $this->parameterIvr() ;


			$data = array_merge($general, $modules,$call,$income,$callTime,$ivr) ;

			return View::make('settings.page', $data ) ;
		}
		public function brandingGeneral()
		{
			$name = Setting::where( 'code', 'BRAND_NAME' )->pluck('value') ;
			$color = Setting::where( 'code', 'BRAND_COLOR' )->pluck('value') ;
			$file = Setting::where( 'code', 'BRAND_IMAGE' )->pluck('value') ;

			return ['BRAND_NAME' => $name, 'BRAND_COLOR' => $color, 'BRAND_IMAGE' => $file ] ;
		}
		public function brandingModules()
		{
			$branch = Setting::where( 'code', 'MODULE_BRANCH' )->pluck('value') ;
			$region = Setting::where( 'code', 'MODULE_REGION' )->pluck('value') ;
			$employee = Setting::where( 'code', 'MODULE_EMPLOYEE' )->pluck('value') ;

			return ['MODULE_BRANCH' => $branch, 'MODULE_REGION' => $region, 'MODULE_EMPLOYEE' => $employee ] ;
		}
		public function parametersPermitedTime()
		{
			$startTime = Setting::where( 'code', 'START_TIME' )->pluck('value') ;
			$endStart = Setting::where( 'code', 'END_TIME' )->pluck('value') ;
			$permitDays = Setting::where( 'code', 'PROCESS_PAST_CALLS' )->pluck('value') ;

			return ['START_TIME' => $startTime, 'END_TIME' => $endStart, 'PROCESS_PAST_CALLS' => $permitDays ] ;
		}
		public function parameterIvr()
		{
			$ivrDelay = Setting::where( 'code', 'IVR_DELAY' )->pluck('value') ;

			return ['IVR_DELAY' => $ivrDelay] ;
		}
		public function apiCalling()
		{
			$apiKey = Setting::where( 'code', 'API_KEY' )->pluck('value') ;


			return ['API_KEY' => $apiKey ] ;
		}
		public function apiIncome()
		{
			$ivrKey = Setting::where( 'code', 'IVR_API_KEY' )->pluck('value') ;
			$urlFormat = Setting::where( 'code', 'IVR_URL_FORMAT' )->pluck('value') ;
			$characterPosition = Setting::where( 'code', 'DTMF_CHARACTER_POSITION' )->pluck('value') ;

			return ['IVR_KEY' => $ivrKey, 'IVR_URL_FORMAT' => $urlFormat, 'DTMF_CHARACTER_POSITION' => $characterPosition ] ;
		}
		public function onBrandingGeneral()
		{
			$name  = Input::get( 'BrandName' );
			$color = Input::get( 'BrandColor' );
			$image = FileUpload::upload( 'BrandImage' );

			Setting::where( 'code', 'BRAND_NAME' )->update( [ 'value' => $name ] );
			Setting::where( 'code', 'BRAND_COLOR' )->update( [ 'value' => $color ] );
			if($image)
				Setting::where( 'code', 'BRAND_IMAGE' )->update( [ 'value' => $image ] );

			//response sent...
			$js = "jQuery('.btn-info_108').css('background-color', '$color');" ;
			return Response::send( Response::bulider()->addScript($js)->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() );
		}
		public function onUrlPath()
		{
			$image = FileUpload::upload( 'BrandImage' );
			$url=FileUpload::downloadUrl($image);
			return $url;
		}
		public function onBrandingModules()
		{
			$regions  = Input::get( 'region' );
			$branchs = Input::get( 'branch' );
			$employees = Input::get( 'employee' );

			if($regions=='') {
				$region=0;
			}
			else{
				$region=1;
			}
			if($branchs==''){
				$branch=0;
			}
			else{
				$branch=1;
			}
			if($employees==''){
				$employee=0;
			}
			else{
				$employee=1;
			}

			Setting::where( 'code', 'MODULE_REGION' )->update( [ 'value' => $region ] );
			Setting::where( 'code', 'MODULE_BRANCH' )->update( [ 'value' => $branch ] );
			Setting::where( 'code', 'MODULE_EMPLOYEE' )->update( [ 'value' => $employee ] );

			//response sent...
			return Response::send( Response::bulider()->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() );
		}
		public function onApiCall(){
			$apikeyname  = Input::get( 'apiKeyName' );
			Setting::where( 'code', 'API_KEY' )->update( [ 'value' => $apikeyname ] );

			return Response::send( Response::bulider()->addScript('window.location.href=window.location.href;')->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() );

		}
		public function onApiIncome() {
			$ivrKey  = Input::get( 'ivrKey' );
			$urlFormat  = Input::get( 'urlFormat' );
			$characterPosition  = Input::get( 'characterPosition' );


			Setting::where( 'code', 'IVR_API_KEY' )->update( [ 'value' => $ivrKey ] );
			Setting::where( 'code', 'IVR_URL_FORMAT' )->update( [ 'value' => $urlFormat ] );
			Setting::where( 'code', 'DTMF_CHARACTER_POSITION' )->update( [ 'value' => $characterPosition ] );


			//response sent...

			return Response::send( Response::bulider()->addScript('window.location.href=window.location.href;')->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() );


		}
		public function onParameterCallPermitted() {

			$startTime  = Input::get( 'startTime' );
			$endTime  = Input::get( 'endTime' );
			$permittedDay  = Input::get( 'permitDays' );

			if($permittedDay=='')
			{
				$day=0;
			}
			else
			{
				$day=1;
			}

			Setting::where( 'code', 'START_TIME' )->update( [ 'value' => $startTime ] );
			Setting::where( 'code', 'END_TIME' )->update( [ 'value' => $endTime ] );
			Setting::where( 'code', 'PROCESS_PAST_CALLS' )->update( [ 'value' => $day ] );

			//response sent...
			return Response::send( Response::bulider()->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() );
		}
		public function onParameterIvr()
		{
			$ivrDelay  = Input::get( 'IvrDelay' );

			Setting::where( 'code', 'IVR_DELAY' )->update( [ 'value' => $ivrDelay ] );
			//response sent...
			return Response::send( Response::bulider()->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() );
		}
	}