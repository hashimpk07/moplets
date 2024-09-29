<div class="col-md-6">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Top Calling</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-condensed">
                @if( count($topBranches) > 0 )
                    @foreach( $topBranches as $one )
                        <tr>
                            <td>{{ $one->branch }}</td>
                            <td><span class="badge bg-red">{{ $one->cnt }}</span></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2">No data for today</td>
                    </tr>
                @endif
            </table>
        </div><!-- /.box-body -->
    </div>
</div>