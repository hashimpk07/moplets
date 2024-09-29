<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requests', function (Blueprint $table) {
			$table->integer('id', true);
			$table->timestamp('dt') ;
			$table->integer('location_id');
			$table->integer('branch_id');
			$table->integer('region_id');
			$table->integer('employee_id');
			$table->string('customer');
			$table->string('phone', 16);
			$table->char('call_status', 1);
			$table->dateTime('call_dt');
			$table->string('call_dtmf');
			$table->char('call_response', 1);

			$table->foreign('location_id')->references('id')->on('locations') ;
			$table->foreign('region_id')->references('id')->on('regions') ;
			$table->foreign('branch_id')->references('id')->on('branches') ;
			$table->foreign('employee_id')->references('id')->on('employees') ;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('requests');
	}

}
