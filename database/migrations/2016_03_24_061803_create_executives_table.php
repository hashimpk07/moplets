<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExecutivesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('executives', function (Blueprint $table) {
			$table->integer('id', true);
			$table->string('name');
			$table->string('username');
			$table->string('password', 64);
			$table->rememberToken();
			$table->boolean('is_blocked') ;
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('executives');
	}

}
