@if( count($records) < 1 )
    <tr class="qrd-norecords"><td colspan="100%">{!! DEFAULT_NO_RECORD_MESSAGE !!}</td></tr>
    <?php return ; ?>
@endif
@foreach ($records as $record )

        <tr>
            <td>{{ $records->recordno->getNext() }}</td>
            <td >{{ $record->name }}</td>
            <td >{{ $record->username }}</td>
            <td>
                <div class="qrd-listtable-actions">

                    <a href="javascript:;" onclick="actionForm('{{ action('ExecutiveController@view', [@$record->id] ) }}', {}, 'ExecutiveAddWrap' )" title="View" ><i class="fa fa-eye"> </i></a>

                    <a  href="javascript:;" onclick="actionForm('{{ action('ExecutiveController@edit', [@$record->id] ) }}', {}, 'ExecutiveAddWrap' )" title="Edit" ><i class="fa fa-edit"> </i></a>
                    <?php if( $record->is_blocked !=  0 ) { ?>
                    <a href="javascript:;" onclick="actionFlag('{{ action('ExecutiveController@block', [@$record->id] ) }}', {}, null, null, null, onAjaxResult )" title="Unblock" ><i class="fa fa-ban"> </i></a>
                    <?php } else { ?>
                    <a href="javascript:;" onclick="actionFlag('{{ action('ExecutiveController@unblock', [@$record->id] ) }}', {}, null, null, null, onAjaxResult )" title="Block" ><i class="fa fa-circle-thin"> </i></a>
                    <?php } ?>
                </div>
            </td>
        </tr>

@endforeach