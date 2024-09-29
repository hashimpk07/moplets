@extends('layouts.adminlte.inner')

@section('contents')
<!-- form branch -->
<!-- Content Header (Page header) -->
<section class="content-header" >
    <div class="mop">
        <h1>
            Branches
        </h1>
    </div>
    <div class="box-tools">
        @include ('shared.search', [ 'SEARCH_CONTROLLER_PREFIX' => "Branch" ])

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

        <div id="BranchTableWrap">
            {!! $tablehtml !!}
        </div>
        <!-- /.box-body -->
    </div>
</div>

@stop