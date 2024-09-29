@extends('layouts.adminlte.inner')
@section('contents')

        <!-- Content Wrapper. Contains page content -->
<!-- form branch -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Comparison Charts

    </h1>



</section>


<section class="content ">

    @include ('comparison.form')

    <!-- /.col (left) -->
    <!-- /.row -->

</section>


<div class="col-md-12">

</div>


<!-- /.content -->
<!-- /.content-wrapper -->
<script type="text/javascript">

    function doExecutiveValidation()
    {
        return true ;
    }
    document.addEventListener('onPageReady', function (e) {
        /* submitForm( formName, beforeFunctionm, afterFunction, targetId, autofill json response); */
        submitForm('ComparisonForm', doExecutiveValidation, function(data) { }, 'ComparisonTableWrap', true, {

        } );
    }) ;
</script>

@stop