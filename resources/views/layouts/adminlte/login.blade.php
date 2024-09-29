<?php
/**
 * Created by PhpStorm.
 * User: Sajill
 * Date: 12/16/2015
 * Time: 12:52 PM
 */
?>

@include('layouts.adminlte.loginhead')

<!--inline styles related to this page-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body class="hold-transition login-page">
<div class="main-container container-fluid">
    <div class="main-content">
        <div class="row-fluid">
            <div class="span12">
                <div class="login-container">


                    <div class="space-6"></div>

                    <div class="row-fluid">
                        <div class="position-relative">
                            <div id="login-box" class="login-box visible widget-box no-border">
                                <div class="widget-body">
                                    <div class="widget-main">


                                        @yield("content")

                                    </div><!--/widget-main-->

                                    <div class="toolbar clearfix">

                                    </div>
                                </div><!--/widget-body-->
                            </div><!--/login-box-->



                        </div><!--/position-relative-->
                    </div>
                </div>
            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div>
</div><!--/.main-container-->




@include('layouts.adminlte.scripts')

</body>
