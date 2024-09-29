<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExecutiveBranchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('executive_branches', function (Blueprint $table) {
			$table->integer('id', true);
			$table->integer('executive_id');
			$table->integer('branch_id');

			$table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
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
		Schema::drop('executive_branches');
	}

}
