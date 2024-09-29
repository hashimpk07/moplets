<?php
        function putOne( $obj ) {
        ?>
<?php if( !$obj || $obj->satisfied || $obj->unsatisfied ) { ?>
<span class="inlinepie" values="<?php echo( intval($obj->satisfied) ); ?>,<?php echo( intval($obj->unsatisfied) ); ?>" ></span>
<?php } else { ?>
<span class="circle" style="height: 150px; line-height: 150px;">No Data</span>
<?php } ?>
<?php } ?>

<div class="col-md-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Comparison Report</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table table-condensed">

                    <div>
                        <div class="piechart">
                            <p style="text-align: center">

                                <?php putOne( $cToday) ;?>
                                    <span>Today</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        <div class="piechart">
                            <p style="text-align: center">

                                <?php putOne( $cWeek) ;?>
                                    <span>This Week</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        <div class="piechart">
                            <p style="text-align: center">

                                <?php putOne( $cMonth) ;?>
                                    <span>This Month</span>
                            </p>
                        </div>
                    </div>
                <div>
                    <div class="piechart">
                        <p style="text-align: center">

                            <?php putOne( $cPrevMonth) ;?>
                                <span>Previous Month</span>
                        </p>
                    </div>
                </div>
                    <div>
                        <div class="piechart">
                            <p style="text-align: center">

                                <?php putOne( $cAll) ;?>
                                    <span>All Time</span>
                            </p>
                        </div>
                    </div>

            </div>
        </div><!-- /.box-body -->
    </div>


    <script type="text/javascript">
            $('.inlinepie').sparkline('html', {sliceColors: ['green', 'red'], height: '150px', type: 'pie'});
    </script>
</div>