<?php
namespace Qudratom\Utilities;

use Illuminate\Support\Facades\DB;

class Notification
{
    public static function countPendingClaims()
    {
        return DB::table(DB::raw('claims AS c'))
            ->select(DB::raw('COUNT(*) as cnt'))
            ->pluck('cnt') ;
    }
    public static function countUnbalancedAdjustments()
    {
        return 0 ;
    }
    public static function countUnbalancedAdvances()
    {
        return 0 ;
    }
    public static function countExpiringDocuments()
    {
        return DB::table(DB::raw('people AS p'))
            ->select(DB::raw('COUNT(*) as cnt'))
            ->join('people_documents AS pd', 'pd.people_id', '=', 'p.id')
            ->where('pd.expiry', '<', DB::raw('NOW()'))
            ->pluck('cnt') ;
    }
    public static function countCashBalanceAlerts()
    {
        return DB::table(DB::raw('cash_accounts AS c'))
            ->select(DB::raw("COUNT(*) as cnt, e.amount, d.alert_level"))
            ->join('cash_account_details AS d', 'd.cash_account_id', '=', 'c.id')
            ->join('currencies AS r', 'd.currency_id', '=', 'r.id')
            ->join('account_ledgers AS l', 'c.account_ledger_id', '=', 'l.id')
            ->join('account_entries AS e', 'e.account_ledger_id', '=', 'l.id')
            ->groupBy('l.id')->groupBy('d.currency_id')
            ->havingRaw('SUM(e.amount) < d.alert_level')
            ->pluck('cnt') ;
    }
}