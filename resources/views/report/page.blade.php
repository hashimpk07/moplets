@extends('layouts.adminlte.inner')
@section('contents')
        <!-- form branch -->
<section class="content-header ">

    <h1>Reports</h1>
</section>
<!-- Content Header (Page header) -->
<section class="content ">
    <div class="row">
        <div class="col-md-12">
            <!-- /.box -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="col-sm-10">

                                <form class="frm-export widget-excel" method="get" action="reports/listtable" target="_blank" autocomplete="off">
                                    <button class="button-rows" value="Export" style="float: right;" name="btnSearchCsvExport" type="submit"><i class="ace-icon glyphicon glyphicon-export bigger-110"></i> Export </button>

                                </form>



                            </div>
                            <div class="col-sm-2">
                                {{--<h3 class="box-title"></h3>--}}
                                <div class="box-tools">
                                    <div class="input-group search-1">
                                        @include ('shared.search', [ 'SEARCH_CONTROLLER_PREFIX' => "Report" ])
                                        <div class="input-group-btn">
                                            <button class='report-toggle btn btn-box-tool' ><i class='fa fa-chevron-down'></i></button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-header -->

                        <div class="box-body table-responsive no-padding" style="overflow-x: visible;">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <?php echo Form::open(array( 'url' => action('ReportController@listtable'), 'id' => 'ReportForm', 'class' => 'form-horizontal' ) );  ?>
                                    <div class="box-body" id="text1" style="display: none;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="col-sm-3 control-label">From</label>

                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control datepicker" name="fromdate" id="fromdate"  >
                                                    </div><!-- /.input group -->
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="col-md-3 control-label">To</label>

                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control datepicker" name="todate" id="todate" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                                    </div><!-- /.input group -->
                                                    <label class="qrd-error" id="eName"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="name" class="col-md-3 control-label ">Customers</label>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="name" id="name"
                                                           placeholder="Select Customers">
                                                    <label class="qrd-error" id="eName"></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="name" class="col-md-3 control-label ">Phone</label>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="phone" id="name"
                                                           placeholder="Phone Number">
                                                    <label class="qrd-error" id="eName"></label>
                                                </div>
                                            </div>

                                            <?php  if(CONST_MODULE_EMPLOYEE==1) { ?>
                                            <div class="col-sm-6">
                                                <label for="employees" class="col-md-3 control-label  ">Employees</label>
                                                <div class="col-md-9">

                                                    <select id="employees" name="employees[]" class="form-control select2" multiple="multiple" data-placeholder="Select Employees" style="width: 100%;">
                                                        {!! DEFAULT_SELECT_TEXT !!}
                                                        @foreach( $employeeOptions as $key => $value )
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach

                                                    </select>
                                                    <label class="qrd-error" id="eEmployees"></label>
                                                </div>
                                            </div>
                                                <?php  } if(CONST_MODULE_BRANCH==1) { ?>
                                            <div class="col-sm-6">
                                                <label for="branches" class="col-md-3 control-label ">Branches</label>
                                                <div class="col-md-9">
                                                    <select id="branches" name="branches[]" class="form-control select2" multiple="multiple" data-placeholder="Select Branches" style="width: 100%;">
                                                        {!! DEFAULT_SELECT_TEXT !!}

                                                        @foreach( $branchOptions as $key => $value )
                                                            <option  value="{{ $key }}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="qrd-error" id="eRegions"></label>
                                                </div>
                                            </div>
                                                <?php } ?>

                                            <div class="col-sm-6">
                                                <label for="locations" class="col-md-3 control-label ">Locations</label>
                                                <div class="col-md-9">
                                                    <select id="locations" name="locations[]" class="form-control select2" multiple="multiple" data-placeholder="Select Locations" style="width: 100%;">
                                                        {!! DEFAULT_SELECT_TEXT !!}
                                                        @foreach( $locationOptions as $key => $value )
                                                            <option {{ ((@$record->id == $key) ? 'selected="selected' : '') }} value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="qrd-error" id="eLocations"></label>
                                                </div>
                                            </div>
                                            <?php  if(CONST_MODULE_REGION==1) { ?>
                                            <div class="col-sm-6">
                                                <label for="regions" class="col-md-3 control-label ">Regions</label>
                                                <div class="col-md-9">
                                                    <select id="regions" name="regions[]" class="form-control select2" multiple="multiple" data-placeholder="Select Regions" style="width: 100%;">
                                                        {!! DEFAULT_SELECT_TEXT !!}
                                                        @foreach( $regionOptions as $key => $value )
                                                            <option  value="{{ $key }}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="qrd-error" id="eRegions"></label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="callstatus" class="col-md-3 control-label ">Call Status</label>
                                                <div class="col-md-9">
                                                    <select id="regions" name="callstatus[]" class="form-control select2" multiple="multiple" data-placeholder="Select Call Status" style="width: 100%;">
                                                        {!! DEFAULT_SELECT_TEXT !!}
                                                        @foreach( $callstatusOptions as $key => $value )
                                                            <option {{ ((@$record->id == $key) ? 'selected="selected' : '') }} value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="qrd-error" id="eCallstatus"></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="responsestatus" class="col-md-3 control-label ">Response Status</label>
                                                <div class="col-md-9">
                                                    <select id="responsestatus" name="responsestatus[]" class="form-control select2" multiple="multiple" data-placeholder="Select Responce Status" style="width: 100%;">
                                                        {!! DEFAULT_SELECT_TEXT !!}

                                                        @foreach( $responseStatusOptions as $key => $value )
                                                            <option {{ ((@$record->id == $key) ? 'selected="selected' : '') }} value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="qrd-error" id="eResponsestatus"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-info_108">Search</button>
                                        </div><!-- /.box-footer -->
                                    </div>
                                        </form>
                                </div>
                            </div>
                            <div id="ReportTableWrap">
                            {!! $tablehtml !!}
                            </div>

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->
                </div>
            </div>

        </div>

    </div><!-- /.col (left) -->
    <!-- /.row -->

</section>


<script type="text/javascript">
    function doExecutiveValidation()
    {
        return true ;
    }
    document.addEventListener('onPageReady', function (e) {
    /* submitForm( formName, beforeFunctionm, afterFunction, targetId, autofill json response); */
        submitForm('ReportForm', doExecutiveValidation, function(data) { }, 'ReportTableWrap', true, {

        } );


        //
        jQuery(".report-toggle").click(function () {
            if( $("#text1").is(':visible') ) {
                $("#text1").slideUp();
                jQuery(".report-toggle .fa").removeClass('fa-chevron-up') ;
                jQuery(".report-toggle .fa").addClass('fa-chevron-down') ;
            }else {
                $("#text1").slideDown();
                jQuery(".report-toggle .fa").removeClass('fa-chevron-down') ;
                jQuery(".report-toggle .fa").addClass('fa-chevron-up') ;
            }
        });

    }) ;


</script>

@stop