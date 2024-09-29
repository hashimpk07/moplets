@if( count($records) < 1 )
    <tr class="qrd-norecords"><td colspan="100%">{!! DEFAULT_NO_RECORD_MESSAGE !!}</td></tr>
    <?php return ; ?>
@endif

@foreach ($records as $record )

    <?php if( $record->type==1)
    {
        $record->type='INCOMING CALL';
    }
    else if( $record->type==2)
    {
        $record->type='IVR CALL';
    }
    else
    {
        $record->type='IVR REQUEST';
    }
    ?>

<tr>
    <td>{{ $records->recordno->getNext() }}</td>
    <td>{{ $record->data_time }}</td>
    <td>{{ $record->data }}</td>
    <td>{{ $record->type }}</td>


    <td>
        <a class="blue" href="javascript:;"  onclick="actionFlag('{{ action('HistoryController@clear', [$record->id] ) }}', {}, null, null, null, onAjaxResult )" >
                <i class="ace-icon fa fa-trash bigger-130"></i>
        </a>

    </td>
</tr>

@endforeach