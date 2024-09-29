<div class="box-body">
    <table class="table table-hover">
    <tr>
        <th>Sl#</th>
        <th>Date</th>
        <th>Customer</th>
        <th>Phone</th>
        <?php  if(CONST_MODULE_EMPLOYEE==1) { ?>
        <th>Employee</th>
        <?php }  if(CONST_MODULE_BRANCH==1) { ?>
        <th>Branch</th>
        <?php  } ?>
        <th>Location</th>
        <?php   if(CONST_MODULE_REGION==1) { ?>
        <th>Region</th>
        <?php  } ?>
        <th>Call Status</th>
        <th>Response Status</th>
    </tr>
    <tbody id="ReportTableBody">
    {!! $rawsethtml !!}

    </tbody>
</table>

</div>

{!! $pagerhtml !!}

<?php /*
<div class="box-footer clearfix">
    <ul class="pagination pagination-sm no-margin pull-right">
        <li><a href="#">&laquo;</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">&raquo;</a></li>
    </ul>
</div>
 */ ?>