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
		Schema::create('users', function($t) {
		 	            $t->bigIncrements('id');
						$t->string('registered-id')->unique();
						$t->string('editable-email');
						$t->string('firstname');
						$t->string('lastname');
						$t->string('date-of-birth');
						$t->string('gender');
						$t->string('phone');
						$t->string('img-file-name');
						$t->string('account-type');
						$t->boolean('email-confirmed');
						$t->boolean('phone-confirmed');
						$t->string('token');
						$t->string('password', 64);
		                $t->timestamps();
		 });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
