<?php
/**
 * Created by PhpStorm.
 * User: Anitha
 * Date: 23/12/15
 * Time: 12:51 PM
 */
?>

@extends("layouts.adminlte.inner")

@section("class_pep" , "open active")
@section("class_pep_grp" , "active")

@section("bread")
    <li class="active"><a href="#">People</a></li>
    <li class="active">Group</li>
@stop

@section("content")

    <div class="page-content">

        <div class="page-header">
            <h1>
                Dashboard
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                </small>

            </h1>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->



            </div>
        </div>
        {{--Page Content row closing--}}



    </div>
@stop
