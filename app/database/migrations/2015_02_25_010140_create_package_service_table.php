<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageServiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('package_service', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('package_id')->nullable();
			$table->unsignedInteger('service_id')->nullable();
			$table->foreign('package_id')->references('id')->on('packages');
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
		Schema::drop('package_service');
	}

}
