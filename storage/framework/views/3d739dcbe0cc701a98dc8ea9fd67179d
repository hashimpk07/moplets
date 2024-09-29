<?php

	$filename = "php://output";
	$handle = fopen($filename, 'w');
	fputcsv($handle, [
			"Sl#",
			"Date",
			"Customer",
			"Phone",
			"Employee",
			"Branch",
			"Location",
			"Region",
			"Call Status",
			"Response Status",

	]);

	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename=data.csv');


	$new_array = array();
	$count=1;
	foreach($records as $key){
		$key->callstatus= \App\Models\Virtual\CallStatus::explain( $key->callstatus) ;
		$key->responsestatus = \App\Models\Virtual\ResponseStatus::explain($key->responsestatus) ;

	}

	foreach($records as $row){

		$array =(array) $row;
		array_unshift($array,$count);
		foreach($array as $k => $v)
		{

			array_push($new_array,$v);

		}

		$count++;
		fputcsv($handle, $new_array);
		$new_array = array();

	}
	exit;

?>

