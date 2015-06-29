<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepostNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('repost_notifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tweet_id')->references('id')->on('tweets')->ondelete('cascade');
			$table->boolean('seen')->default(false);
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
		Schema::drop('repost_notifications');
	}

}