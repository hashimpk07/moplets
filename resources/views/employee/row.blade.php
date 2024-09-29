@foreach ($records as $record )

    <tr>
        <td>{{ $records->recordno->getNext() }}</td>
        <td>{{ $record->ref_employee_id }}</td>
        <td width="50%" height="50" data-source="employee" data-id="{{$record->id}}" class="qrd-editable qrd-editable-id-{{$record->id}}" >{{ $record->name }}</td>
        <td>
            <div class="qrd-listtable-actions">
                <?php if( $record->is_blocked !=  0 ) { ?>
                <a href="javascript:;" onclick="actionFlag('{{ action('EmployeeController@block', [@$record->id] ) }}', {}, null, null, null, onAjaxResult )" title="Unlock" ><i class="fa fa-ban"> </i></a>
                <?php } else { ?>
                <a href="javascript:;" onclick="actionFlag('{{ action('EmployeeController@block', [@$record->id] ) }}', {}, null, null, null, onAjaxResult )" title="Block" ><i class="fa fa-circle-thin"> </i></a>
                <?php } ?>
            </div>
        </td>
    </tr>

@endforeach