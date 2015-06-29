<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('images', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->default(0);
			$table->foreign('user_id')->references('id')->on('users')->ondelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('images', function(Blueprint $table)
		{
			//
		});
	}

}
