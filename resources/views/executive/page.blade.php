@extends('layouts.adminlte.inner')
@section('contents')
        <!-- form branch -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="mop">
        <h1>
            Executives
        </h1>

    </div>

    <div class="box-tools">



    </div>
    @include ('shared.search', [ 'SEARCH_CONTROLLER_PREFIX' => "Executive" ])
        <button type="button" style="float:right;" onclick="actionForm('<?php echo  action('ExecutiveController@add'); ?>', {}, 'ExecutiveAddWrap' )" id="add" class="button-rows">
            <i class="ace-icon glyphicon glyphicon-plus bigger-110"></i>
            New
        </button>

</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div id="ExecutiveAddWrap" ></div>

        </div>
    </div>

</section>

<div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>



        </div>

        <div id="ExecutiveTableWrap">
            {!! $tablehtml !!}

        </div>

        <!-- /.box-body -->
    </div>
</div>


@stop