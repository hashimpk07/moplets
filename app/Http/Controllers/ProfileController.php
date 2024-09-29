<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Qudratom\Traits\SelectPairs;
use DB;


class ProfileController extends Controller
{
    use SelectPairs;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('profile.profile');

    }

    public function view()
    {
        $branches = "";
        $regions = "";

        $id = Auth::user()->id;
        $ca = DB::table(DB::raw('executives AS ex'))
            ->select(DB::raw('ex.id,ex.name As name,ex.username As username ,ex.password As password, exbr.branch_id,exre.region_id,b.name AS branchName, r.name AS regionName'))
            ->Join('executive_branches AS exbr', 'exbr.executive_id', '=', 'ex.id')
            ->Join('branches AS b', 'b.id', '=', 'exbr.branch_id')
            ->Join('executive_regions AS exre', 'exre.executive_id', '=', 'ex.id')
            ->Join('regions AS r', 'r.id', '=', 'exre.region_id')
            ->where('ex.id', '=', $id)
            ->groupBy('exre.region_id')
            ->first();

        $options = $this->executiveBranchOptions($id);
        foreach ($options as $name) {
            $branches .= $name . ' ,';
        }

        $branches = rtrim($branches, ',');
        $result = $this->executiveRegionOptions($id);
        foreach ($result as $name) {
            $regions .= $name . ' ,';
        }
        $regions = rtrim($regions, ',');

        $vars = array(
            'record' => $ca,
            'regionOptions' => $regions,
            'branchOptions' => $branches,
        );

        return View::make('profile.profile', $vars);
    }

}
