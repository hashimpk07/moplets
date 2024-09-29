@extends('layouts.adminlte.inner')

@section('contents')
        <!-- form branch -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Profile
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div id="ExecutiveAddWrap">


                        <div id="ExecutiveAddForm" class="QRD-ADD">

                            <form class="form-horizontal">
                                <div class="box box-50-center">
                                    <div class="box-header ">


                                        <div class="box-body no-padding">
                                            <table class="table">
                                                <tr>

                                                    <td>Name</td>
                                                    <td>{{ @$record->name }}</td>
                                                </tr>
                                                <tr>

                                                    <td>Username</td>
                                                    <td>{{ @$record->username }}</td>

                                                </tr>
                                                <?php

                                                if(CONST_MODULE_BRANCH==1) { ?>
                                                <tr>

                                                    <td>Branches</td>
                                                    <td>{{ @$branchOptions }}</td>


                                                </tr>
                                                <?php } if(CONST_MODULE_REGION==1) { ?>
                                                <tr>

                                                    <td>Regions</td>
                                                    <td>{{ @$regionOptions }}</td>


                                                </tr>
                                                <?php } ?>

                                            </table>
                                        </div>
                                    </div><!-- /.box-header --><!-- /.box-body -->
                                </div>
                            </form>

                        </div>




            </div>

        </div>
    </div>

</section>



@stop