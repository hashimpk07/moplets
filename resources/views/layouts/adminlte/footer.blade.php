<?php
/**
 * Created by PhpStorm.
 * User: Anitha
 * Date: 12/16/2015
 * Time: 1:02 PM
 */
?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">

    </div>
    <strong>Copyright &copy; <?php echo date('Y');?> <a href="http://www.qudratom.com" target="_blank">Qudratom R & D</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>


<script type="text/javascript">
    var QRD_CELL_ACRION_URL = '<?php echo action("AjaxController@clickedit") ; ?>' ;

   $(".datepicker").datepicker();
   $(".select2").select2();

   $("#btn_toggle").click(function () {
       $("#text1").toggle();
   });
   //color picker with addon
   $(".my-colorpicker2").colorpicker();

   /*uplod jqury*/
   $("#uploadFile").on("change", function () {
       var files = !!this.files ? this.files : [];
       if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
       $("#current_image").hide();
       if (/^image/.test(files[0].type)) { // only image file
           var reader = new FileReader(); // instance of the FileReader
           reader.readAsDataURL(files[0]); // read the local file
           reader.onloadend = function () { // set image data as background of div

               $("#imagePreview").css("background-image", "url(" + this.result + ")");
           }
       }
   });
   //Timepicker
   $("#timepicker").timepicker({
       showInputs: false
   });
   $('.timepicker1').timepicker({
       minuteStep: 1,
       showSeconds: true,
       showMeridian: false
   }).next();





   //Datemask dd/mm/yyyy
        $(".dateinputpicker").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
//Datemask2 mm/dd/yyyy
        $(".dateinputpicker").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
//Money Euro
    //    $("[data-mask]").inputmask();

//Date range picker
        $('.daterangepicker').daterangepicker();
//Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
//Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function (start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
        );

//iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
//Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
//Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });










</script>
<!-- Repoprt section end -->

<script>
    function toggleAddForm(elementForm, show, elementInvert) {

        if (show) {
            $(elementForm).show();
            if (typeof elementInvert != 'undefined') {
                jQuery(elementInvert).hide();
            }
        }
        else {
            $(elementForm).hide();
            if (typeof elementInvert != 'undefined') {
                jQuery(elementInvert).show();
            }
        }
    }
</script>
<style>

    /** Icon Style { **/
    .inner-addon {
        position: relative;
    }
    .inner-addon .glyphicon:hover{
        opacity: 1.0;
    }
    .inner-addon .glyphicon {
        position: absolute;
        padding: 10px;
        cursor: pointer;
        opacity: 0.5;
    }
    .left-addon .glyphicon  { left:  0px;}
    .right-addon .glyphicon { right: 0px;}

    .left-addon .glyphicon2  { left:  30px;}
    .right-addon .glyphicon2 { right: 30px;}

    .left-addon input  { padding-left:  30px; }
    .right-addon input { padding-right: 30px; }
    /** Icon Style } **/
</style>
</body>
</html>
