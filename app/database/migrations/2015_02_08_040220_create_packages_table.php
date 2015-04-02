<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('packages', function(Blueprint $table)
      {
          $table->increments('id');
          $table->string('name',64);
          $table->integer('cost');
          $table->integer('active');
		  $table->integer('cancel_fee');
          $table->integer('duration');
          $table ->text('description');
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
      Schema::drop('packages');
  }

}
