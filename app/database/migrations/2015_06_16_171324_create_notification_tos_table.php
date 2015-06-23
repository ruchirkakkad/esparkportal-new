<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationTosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notification_tos', function(Blueprint $table)
		{
			$table->increments('notification_tos_id');
			$table->integer('notifications_id');
			$table->integer('users_id');
			$table->enum('status',['read','unread'])->default('unread');
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
		Schema::drop('notification_tos');
	}

}
