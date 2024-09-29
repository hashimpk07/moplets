@extends('layouts.adminlte.inner')

@section('contents')
   <section class="content-header" >
    <div class="mop">
        <h1>
            Change Password
        </h1>
    </div>
    <div class="box-tools">
    </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('password.add')
            </div>
        </div>
    </section>


@stop