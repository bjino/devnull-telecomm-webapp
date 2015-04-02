<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('package_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('user_id')->nullable();
			$table->unsignedInteger('package_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('package_id')->references('id')->on('packages');
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
		Schema::drop('package_user');
	}

}
