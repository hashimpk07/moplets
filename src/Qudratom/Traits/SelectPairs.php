<?php

namespace Qudratom\Traits;

use App\Models\Branch;
use App\Models\CashAccount;
use App\Models\CashAdjustment;
use App\Models\CashAdvance;
use App\Models\CashExpense;
use App\Models\Claim;
use App\Models\Currency;
use App\Models\DocumentType;
use App\Models\Employee;
use App\Models\Region;
use App\Models\Location;
use App\Models\MaterialGift;
use App\Models\MaterialGiftCategory;
use App\Models\People;
use App\Models\ExpenseType;
use App\Models\ClaimPaymentModeDomain;
use App\Models\CashGift;
use App\Models\ClaimSubmissionModeDomain;
use App\Models\PeopleGroup;
use App\Models\StorageLocation;
use App\Models\Virtual\CallStatus;
use App\Models\Virtual\ResponseStatus;
use Illuminate\Support\Facades\View;

Trait SelectPairs
{
    public function render($options) {
        return View::make('shared.options', ['options' => $options] ) ;
    }


    public function employeeOptions( $render = false )
    {
        $whereRaw = ' 1 ' ;
        $options = Employee::pairList('id', 'name', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    public function branchOptions( $render = false )
    {
        $whereRaw = ' 1 ' ;
        $options = Branch::pairList('id', 'name', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    public function locationOptions( $render = false )
    {
        $whereRaw = ' 1 ' ;
        $options = Location::pairList('id', 'name', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    public function regionOptions( $render = false )
    {
        $whereRaw = ' 1 ' ;
        $options = Region::pairList('id', 'name', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    public function callstatusOptions( $render = false )
    {
        $whereRaw = ' 1 ' ;
        $options = CallStatus::collections() ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    public function responseStatusOptions( $render = false )
    {
        $whereRaw = ' 1 ' ;
        $options = ResponseStatus::collections() ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }

    private function claimOptions( $render = false )
    {
        $whereRaw = " 1 AND domain_id !='" . CLAIM_DOMAIN_NEGATIVE  . "'" ;
        $options = Claim::pairList('id', 'id', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    private function negativeClaimOptions( $render = false )
    {
        $whereRaw = " 1 AND domain_id ='" . CLAIM_DOMAIN_NEGATIVE  . "'" ;
        $options = Claim::pairList('id', 'id', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    private function expenseClaimOptions( $render = false )
    {
        $whereRaw = " 1 AND domain_id ='" . CLAIM_DOMAIN_EXPENSE  . "'" ;
        $options = Claim::pairList('id', 'id', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    private function cashgiftClaimOptions( $render = false )
    {
        $whereRaw = " 1 AND domain_id ='" . CLAIM_DOMAIN_CASHGIFT  . "'" ;
        $options = Claim::pairList('id', 'id', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    private function expenseParentOptions($render = false)
    {
        $whereRaw = " 1 AND parent_id = 0 " ;
        $options = ExpenseType::pairList('id', 'name', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    private function materialGiftParentOptions($render = false)
    {
        $whereRaw = " 1" ;
        $options = MaterialGiftCategory::pairList('id', 'name', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    private function materialGiftCategoryOptions($render = false)
    {
        $whereRaw = " 1" ;
        $options = MaterialGiftCategory::pairList('id', 'name', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }

    private function materialGiftOptions($render = false, $parent)
    {
        $whereRaw = " 1 AND category_id='" . $parent . "' " ;
        echo $whereRaw;
        $options = MaterialGift::pairList('id','name', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    private function storageLocationOptions($render = false)
    {
        $whereRaw = " 1" ;
        $options = StorageLocation::pairList('id','name', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }

    private function itemListOptions($render = false)
    {
        $whereRaw = " 1 " ;
        $options = MaterialGift::pairList('id','name', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    private function peopleGroupOptions($render = false)
    {
        $whereRaw = " 1 " ;
        $options = PeopleGroup::pairList('id','name', $whereRaw ) ;
        if( $render ) {
            return $this->render($options) ;
        }
        return $options ;
    }
    private function executiveBranchOptions( $executiveId){

        $result = Branch::select('branches.id','name')
                        ->join('executive_branches','branches.id','=','executive_branches.branch_id')
                        ->where('executive_id',$executiveId) ->lists('name','branches.id');

        return $result ;
    }
    private function executiveRegionOptions( $executiveId){

        $options = Region::select('regions.id','name')
                         ->join('executive_regions','executive_regions.region_id','=','regions.id')
                         ->where('executive_id',$executiveId)->lists('name','regions.id');

        return $options ;
    }
}