<?php
$claims = \Qudratom\Utilities\Notification::countPendingClaims() ;
$cashbalance = \Qudratom\Utilities\Notification::countCashBalanceAlerts() ;
$expiring = \Qudratom\Utilities\Notification::countExpiringDocuments() ;
$adjustments = \Qudratom\Utilities\Notification::countUnbalancedAdjustments() ;
$advances = \Qudratom\Utilities\Notification::countUnbalancedAdvances() ;

$totalNotifications = intval( $claims + $cashbalance + $expiring + $adjustments + $advances ) ;
?>

<li class="purple">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                <span class="badge badge-important">
                    {{ $totalNotifications }}
                </span>
    </a>

    <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
        <li class="dropdown-header">
            <i class="ace-icon fa fa-exclamation-triangle"></i>
            {{ $totalNotifications }} Notifications
        </li>

        @if( $totalNotifications > 0 )
            <li class="dropdown-content">
                <ul class="dropdown-menu dropdown-navbar navbar-pink">

                    @if($claims > 0 )
                        <li>
                            <a href="#">
                                <i class="btn btn-xs btn-primary fa fa-user"></i>
                                Pending Claims {{ $claims }}
                            </a>
                        </li>
                    @endif

                    @if($cashbalance > 0 )
                    <li>
                        <a href="#">
                            <i class="btn btn-xs btn-primary fa fa-user"></i>
                            Cash Balance Alerts {{ $cashbalance }}
                        </a>
                    </li>
                    @endif

                    @if( $adjustments > 0 )
                    <li>
                        <a href="#">
                            <i class="btn btn-xs btn-primary fa fa-user"></i>
                            Pending Adjustments {{ $adjustments }}
                        </a>
                    </li>
                    @endif

                    @if( $advances > 0 )
                    <li>
                        <a href="#">
                            <i class="btn btn-xs btn-primary fa fa-user"></i>
                            Pending Advances {{ $advances }}
                        </a>
                    </li>
                    @endif

                    @if($expiring > 0 )
                        <li>
                            <a href="#">
                                <i class="btn btn-xs btn-primary fa fa-user"></i>
                                Expiring Documents {{ $expiring }}
                            </a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif
    </ul>
</li>