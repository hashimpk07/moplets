<?php

	namespace App\Http\Controllers;

	use App\Models\AccountEntry;
	use App\Models\AccountLedger;
	use App\Models\Location;
	use App\Models\LocationDetail;
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

	class LocationController extends Controller {

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
			$records = Location::paginate() ;

			$rowsetview = View::make('location.row', ['records' => $records] ) ;

			$pagerhtml = AjaxPaginator::render($records, 'LocationTableWrap', 'LocationController@listtable' ) ;

			return View::make('location.table', ['rawsethtml' => $rowsetview, 'pagerhtml' => $pagerhtml] ) ;
		}
		public function page()
		{
			$data = $this->listtable() ;
			return View::make('location.page', ['tablehtml'=> $data] ) ;
		}
		public function block($id)
		{
			$location             = Location::find( $id );
			$location->is_blocked = 0;
			if( $location->save() ) {
				return Response::send( Response::bulider()->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() );
			}
			else {
				return Response::send( Response::bulider()->setStatus( ResponseBuilder::$FAIL )->setMessage( 'Failed' )->build() );
			}


		}
		public function unblock($id)
		{

			$location             = Location::find( $id );
			$location->is_blocked = 1;
			if( $location->save() ) {
				return Response::send( Response::bulider()->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() );
			}
			else{
				return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->setMessage('Failed')->build());

			}
		}
	}