<?php

    /*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

    namespace App\Http\Controllers;

    use App\Models\Branch;
    use App\Models\CashAccount;
    use App\Models\Employee;
    use App\Models\Location;
    use App\Models\Region;
    use App\Models\Request;
    use App\Models\Virtual\CallStatus;
    use App\Models\Virtual\ResponseStatus;
    use Carbon\Carbon;
    use Qudratom\Response\Response;
    use Qudratom\Response\ResponseBuilder;
    use Qudratom\Utilities\DateTime;
    use Qudratom\Utilities\Helper;
    use Illuminate\Support\Facades\Input;
    use Qudratom\Response\JsonResponse;
    use DB;

    class SchedulerController extends Controller
    {
        public function __construct()
        {
            parent::__construct(true);
            date_default_timezone_set('Asia/Calcutta');
        }

        /**
         * The dtmf response from ivr
         */
        public function dtmf()
        {
            $phone = Input::get('number');
            $dtmf_string = Input::get('dtmf');
            $pos = intval(CONST_DTMF_CHARACTER_POSITION) - 1 ;

            $IVR_MAX_AGE_MINS = 60 ;
            //dtmf character received.
            $dtmf = substr($dtmf_string, $pos, 1);

            $response_status = ( ($dtmf == CONST_DTMF_SUCCESS_CHARACTER) ? ResponseStatus::$SATISFIED : ResponseStatus::$UNSATISFIED ) ;

            $stat = Request::where('call_status', CallStatus::$CALLED)
                           ->where('phone', $phone)
                           ->where('call_dt', '>=', DB::raw( 'TIMESTAMP( DATE_SUB(NOW(), INTERVAL ' . (intval(CONST_IVR_DELAY) + intval($IVR_MAX_AGE_MINS)) . ' MINUTE) ) ') )
                           ->where('call_dt', '<=', DB::raw('NOW()'))
                           ->orderBy('id', 'ASC')
                           ->limit(1)
                           ->update(['call_response' => $response_status, 'call_dtmf' => $dtmf, 'call_status' => CallStatus::$SUCCESS ]);

            if( $stat )
            {
                return Response::send( Response::bulider()->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() ) ;
            }
            return Response::send( Response::bulider()->setStatus( ResponseBuilder::$FAIL )->setMessage( 'Failed' )->build() ) ;
        }
        // schedule jobs
        public function schedule()
        {
            $past = CONST_PROCESS_PAST_CALLS;
            $sysTime = strtotime(date("2016-01-01 H:i:s"));
            $startTime = strtotime(date("2016-01-01 " . CONST_START_TIME));
            $endTime = strtotime(date("2016-01-01 " . CONST_END_TIME));

            if ($sysTime >= $startTime && $sysTime <= $endTime)
            {
                if ($past == 1)
                {
                    $results = Request::select( 'ivr', 'phone', 'requests.id')->where('call_status', CallStatus::$PENDING )
                                      ->where('dt', '<=', DB::raw( 'TIMESTAMP( DATE_SUB(NOW(), INTERVAL ' . intval(CONST_IVR_DELAY) . ' MINUTE) ) ') )
                                      ->where(DB::raw('DATE(dt)'), DB::raw('CURDATE()'))
                                      ->join('locations', 'locations.id', '=', 'location_id')
                                      ->get();

                }
                else
                {
                    $results = Request::select('ivr', 'phone', 'requests.id')->where('call_status', CallStatus::$PENDING )
                                      ->where('dt', '<=', DB::raw( 'TIMESTAMP( DATE_SUB(NOW(), INTERVAL ' . intval(CONST_IVR_DELAY) . ' MINUTE) ) ') )
                                      ->join('locations', 'locations.id', '=', 'location_id')
                                      ->get();
                }

                if (!is_null($results))
                {
                    foreach ($results as $result)
                    {
                        $toreplace = array("{apikey}", "{ivr}", "{phone}");
                        $replace = array(CONST_IVR_API_KEY, $result->ivr, $result->phone);
                        $url = str_replace($toreplace, $replace, CONST_IVR_URL_FORMAT);
                        $respo = Helper::pingUrl($url);
                        if ($respo)
                        {
                            Request::where('id', $result->id)
                                   ->update(['call_status' => CallStatus::$CALLED, 'call_dt' => DB::raw('now()')]);

                        }
                    }
                }
            }
        }

        /**
         * Incoming Receive API requests
         */
        public function api_request()
        {
            $api_key = Input::get('api_key');
            $region = Input::get('region');
            $location = Input::get('location');
            $branch = Input::get('branch');
            $employee = Input::get('employee');
            $customer = Input::get('customer');
            $phone = Input::get('phone');

            if (CONST_API_KEY == $api_key)
            {
                $locOldData = Location::where('ref_location_id', '=', $location)->first() ;
                if (is_null($locOldData))
                {
                    $loc = new Location();
                    $loc->name = $location;
                    $loc->ivr = $location;
                    $loc->ref_location_id = $location;

                    if ($loc->save())
                    {
                        $locId = $loc->id;
                    }
                }
                else
                {
                    $locId = $locOldData->id;
                }

                $regData = Region::where('ref_region_id', '=', $region)->first();
                if (is_null($regData))
                {
                    $reg = new Region();
                    $reg->name = $region;
                    $reg->ref_region_id = $region;
                    $reg->is_blocked = 0;
                    if ($reg->save())
                    {
                        $regId = $reg->id;
                    }
                }
                else
                {
                    $regId = $regData->id;
                }

                $brachData = Branch::where('ref_branch_id', '=', $branch)->first();
                if (is_null($brachData)) {

                    $bran = new Branch();
                    $bran->name = $branch;
                    $bran->ref_branch_id = $branch;
                    $bran->is_blocked = 0;
                    if ($bran->save()) {
                        $brId = $bran->id;
                    }
                } else {
                    $brId = $brachData->id;
                }

                $empData = Employee::where('ref_employee_id', '=', $employee)->first();

                if (is_null($empData)) {


                    $emp = new Employee();
                    $emp->name = $employee;
                    $emp->ref_employee_id = $employee;
                    $emp->is_blocked = 0;
                    if ($emp->save()) {
                        $empId = $emp->id;
                    }

                } else {
                    $empId = $empData->id;
                }

                $request = new Request();

                $request->dt = DB::raw('NOW()') ;
                $request->location_id = $locId;
                $request->branch_id = $brId;
                $request->region_id = $regId;
                $request->employee_id = $empId;
                $request->customer = $customer;
                $request->phone = $phone;
                $request->call_status = 'P';
                $request->call_dtmf = '';
                $request->call_response = '';
                $request->save();

                return Response::send( Response::bulider()->setStatus( ResponseBuilder::$OK )->setMessage( 'Success' )->build() ) ;
            }

            return Response::send( Response::bulider()->setStatus( ResponseBuilder::$FAIL )->setMessage( 'Failed' )->build() ) ;
        }
    }