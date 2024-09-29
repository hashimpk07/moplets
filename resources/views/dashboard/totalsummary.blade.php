<div class="col-md-6">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Total Summary</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-condensed">
                <tr>
                    <td>Customers</td>
                    <td><span class="badge bg-red">{{$TotalCustomerCount}}</span></td>
                </tr>
                <tr>
                    <td>Calls (Satisfied : Unsatisfied)</td>
                    <td><span class="badge bg-yellow">{{$TotalCustomerCount}} ({{$totalSatisfiedCustomer}} : {{$TotalUnatisfiedCustomer}})</span></td>
                </tr>


            </table>
        </div><!-- /.box-body -->
    </div>
</div>