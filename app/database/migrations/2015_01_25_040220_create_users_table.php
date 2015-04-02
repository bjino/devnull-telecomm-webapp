<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('users', function(Blueprint $table)
      {
          $table->increments('id');

          $table->string('firstname', 32);
          $table->string('lastname', 32);
          $table->string('email', 320);
          $table->string('address', 320);
          $table->string('city', 60);
          $table->string('state', 20);
          $table->string('phone', 20);
          $table->string('password', 64);
		  $table->string('bill', 20);
          $table->integer('userable_id');
	      $table->string('userable_type');

          $table->string('remember_token', 100)->nullable();
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
      Schema::drop('users');
  }

}