<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExecutiveRegionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('executive_regions', function (Blueprint $table) {
			$table->integer('id', true);
			$table->integer('executive_id');
			$table->integer('region_id');

			$table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
			$table->foreign('executive_id')->references('id')->on('executives')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('executive_regions');
	}

}
