@extends('layouts.adminlte.inner')

@section('contents')
<!-- form branch -->
<!-- Content Header (Page header) -->
<section class="content-header" >
    <div class="mop">
        <h1>
            History
        </h1>
    </div>
    <div class="box-tools">
        @include ('shared.search', [ 'SEARCH_CONTROLLER_PREFIX' => "History" ])

    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
        </div>
    </div>
</section>
<div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
        </div><!-- /.box-header -->

        <div id="HistoryTableWrap">
            {!! $tablehtml !!}

        </div>
        <div id="delete_all" style="margin-left:13px;margin-bottom: 2px;"><button type="button" onclick="actionFlag('{{ action('HistoryController@delete' ) }}', 'Delete All  item?',  null, null, onAjaxResult )" id="delete" class="button-rows" >
                <i class="ace-icon fa fa-trash bigger-130"></i>
                Delete All
            </button></div>


        <!-- /.box-body -->
    </div>
</div>

@stop