<?php
/**
 * Created by PhpStorm.
 * User: Anitha
 * Date: 12/16/2015
 * Time: 12:52 PM
 */
?>
@include('layouts.adminlte.header')
@include('layouts.adminlte.sidebar')
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper row" >
        @yield('contents')


    <!-- /.content -->
</div><!-- /.content-wrapper -->

@include('layouts.adminlte.footer')