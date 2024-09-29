<?php

	namespace App\Http\Controllers;

	use App\Models\History;
	use Illuminate\Support\Facades\View;
	use Qudratom\Response\Response;
	use Qudratom\Response\ResponseBuilder;
	use Qudratom\Utilities\AjaxPaginator;

	class HistoryController extends Controller {


		public function index()
		{
			return $this->page() ;
		}
		public function listtable()
		{
			$records = History::paginate() ;

			$rowsetview = View::make('history.row', ['records' => $records] ) ;

			$pagerhtml = AjaxPaginator::render($records, 'HistoryTableWrap', 'HistoryController@listtable' ) ;

			return View::make('history.table', ['rawsethtml' => $rowsetview, 'pagerhtml' => $pagerhtml] ) ;
		}
		public function page()
		{
			$data = $this->listtable() ;
			return View::make('history.page', ['tablehtml'=> $data] ) ;
		}
		public static function addToHistory($data,$type)
		{
			$history =new History();

				$history->data=$data;
				$history->type=$type;

			if( $history->save() ) {
				return Response::send( Response::bulider()->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() );
			}
			else {
				return Response::send( Response::bulider()->setStatus( ResponseBuilder::$FAIL )->setMessage( 'Failed' )->build() );
			}

		}
		public function clear($id){
			try {

				History::destroy($id);
				return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('Success')->build());

			}
			catch(Exception $e) {
			}
			return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->setMessage('Failed')->build());
		}
		public function delete(){try {

				History::truncate();
				return Response::send(Response::bulider()->setStatus(ResponseBuilder::$OK)->setMessage('Success')->build());

			}
			catch(Exception $e) {
			}
			return Response::send(Response::bulider()->setStatus(ResponseBuilder::$FAIL)->setMessage('Failed')->build());

		}


	}

