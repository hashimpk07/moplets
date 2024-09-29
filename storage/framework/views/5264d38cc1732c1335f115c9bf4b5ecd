<div class="col-md-12">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title text-warning">Graphical Report</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body chart-area text-center">

            <div class="col-xs-6">
                <div class="piechart">
                    <p>
                        <span class="inlinepie" values="<?php print($recordsatisfied); ?>,<?php print($recordunsatisfied); ?>" ></span>
                    </p>
                </div>
                <div class="barchart">
                    <p>
                        <span class="inlinebar" values="<?php print($recordsatisfied); ?>,<?php print($recordunsatisfied); ?>,0" ></span>
                    </p>
                </div>
                <div class="col-xs-12">
                    <span class="satisfied"></span> <?php echo intval($recordsatisfied); ?> - Satisfied &nbsp;&nbsp; <span class="unsatisfied"></span> <?php echo intval($recordunsatisfied) ; ?> - Unstatisfied
                </div>
            </div>


            <div class="col-xs-6">
                <table class="table center-block table-bordered qrd-listtable">
                    <tr>
                        <th class="text-center">Satisfied</th>
                        <th class="text-center">Unsatisfied</th>
                    </tr>
                    <tr>
                        <td><?php echo $recordsatisfied; ?></td>

                        <td><?php echo $recordunsatisfied; ?></td>
                    </tr>
                </table>
            </div>

        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box --><!-- /.box-body -->

</div>


<script type="text/javascript">
    /* Use 'html' instead of an array of values to pass options
     to a sparkline with data in the tag */
    if (document.getElementById('piechart').checked) {
        $('.inlinepie').sparkline('html', {sliceColors : ['green', 'red'], height: '150px', type: 'pie' });
    }
    else if (document.getElementById('barchart').checked) {
        $('.inlinebar').sparkline('html', { colorMap : ['green', 'red'], zeroColor : 'white', width: '250px', barWidth: '40px', height: '150px', barSpacing : '20px', type: 'bar' });
    }
</script>