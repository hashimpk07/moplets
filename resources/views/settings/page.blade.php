@extends('layouts.adminlte.inner')



@section('BRAND_COLOR', $BRAND_COLOR)
@section('BRAND_IMAGE', \Qudratom\Utilities\FileUpload::downloadUrl($BRAND_IMAGE))

@section('contents')
    <section class="content-header ">
        <h1>Settings</h1>
    </section>
    <!-- Content Header (Page header) -->
    <section class="content ">

        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs (Pulled to the right) -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <!--<li class="pull-left header"><i class="fa fa-th"></i> Custom Tabs</li>-->
                        <li class="active" ><a href="#tab_2-2" data-toggle="tab">API</a></li>
                        <li><a href="#tab_1-1" data-toggle="tab">Parameters</a></li>
                        <li><a href="#tab_3-2" data-toggle="tab">Branding</a></li>
                    </ul>
                    <div class="tab-content col-md-12">

                        <div class="tab-pane active" id="tab_2-2">
                            <div class="row">
                                @include('settings.api-call')
                                @include('settings.api-incoming')

                            </div>
                        </div>

                        <div class="tab-pane" id="tab_1-1">
                            <div class="row">
                                @include('settings.parameters-call-permitted-time')
                                @include('settings.parameters-ivr')

                            </div>
                        </div><!-- /.tab-pane -->
                        <!-- /.tab-pane -->

                        <div  class="tab-pane" id="tab_3-2">
                            <div class="row">
                                @include ('settings.branding-general')
                                @include ('settings.branding-modules')

                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
        </div>
        <!-- /.col (left) -->           <!-- /.row -->
    </section>

@stop