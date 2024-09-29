@if( count($records) < 1 )
    <tr class="qrd-norecords"><td colspan="100%">{!! DEFAULT_NO_RECORD_MESSAGE !!}</td></tr>
    <?php return ; ?>
@endif
@foreach ($records as $record )
    <tr>
        <td>{{$records->recordno->getNext() }}</td>
      <!--  <td><?php //echo "date";?></td>-->
        <td> {{ \Qudratom\Utilities\DateTime::clientDateTime($record->createdat) }}</td>
        <td>{{ $record->rcustomer }}</td>
        <td>{{ $record->rphone }}</td>
        <?php  if(CONST_MODULE_EMPLOYEE==1) { ?>
        <td>{{ $record->empname }}</td>
        <?php } if(CONST_MODULE_BRANCH==1) { ?>
        <td>{{ $record->branchname }}</td>
        <?php } ?>
        <td>{{ $record->llocations }}</td>
        <?php  if(CONST_MODULE_REGION==1) { ?>
        <td>{{ $record->regname }}</td>
        <?php  } ?>
        <td>{{ \App\Models\Virtual\CallStatus::explain( $record->callstatus) }}</td>
        <td>{{ \App\Models\Virtual\ResponseStatus::explain( $record->responsestatus) }}</td>
    </tr>

@endforeach