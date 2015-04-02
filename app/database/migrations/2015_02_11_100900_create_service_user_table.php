<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_user', function(Blueprint $table)
		{
			$table->increments('id');

			$table->unsignedInteger('user_id')->nullable();
			$table->unsignedInteger('service_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('service_id')->references('id')->on('services');
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
		Schema::drop('service_user');
	}

}
