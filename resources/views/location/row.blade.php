@if( count($records) < 1 )
    <tr class="qrd-norecords"><td colspan="100%">{!! DEFAULT_NO_RECORD_MESSAGE !!}</td></tr>
    <?php return ; ?>
@endif
@foreach ($records as $record )
<tr>
    <td>{{ $records->recordno->getNext() }}</td>
    <td>{{ $record->ref_location_id }}</td>
    <td width="50%" height="50" data-source="location" data-id="{{$record->id}}" class="qrd-editable qrd-editable-id-{{$record->id}}" >{{ $record->name }}</td>
    <td width="50%" height="50" data-source="location-ivr" data-id="{{$record->id}}" class="qrd-editable qrd-editable-id-{{$record->id}}" >{{ $record->ivr }}</td>
    <td>
        <div class="qrd-listtable-actions">
            <?php if( $record->is_blocked !=  0 ) { ?>
            <a href="javascript:;" onclick="actionFlag('{{ action('LocationController@block', [@$record->id] ) }}', {}, null, null, null, onAjaxResult )" title="Unblock" ><i class="fa fa-ban"> </i></a>
           <?php } else { ?>
                <a href="javascript:;" onclick="actionFlag('{{ action('LocationController@unblock', [@$record->id] ) }}', {}, null, null, null, onAjaxResult )" title="Block" ><i class="fa fa-circle-thin"> </i></a>
           <?php } ?>
        </div>
    </td>
</tr>

@endforeach