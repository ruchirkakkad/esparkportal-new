<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordMgmtsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('password_mgmts', function(Blueprint $table)
		{
			$table->increments('password_mgmts_id');
            $table->string('project_name');
            $table->string('user_ids',1020);
            $table->string('live_f_url');
            $table->string('live_b_url');
            $table->string('live_b_username1');
            $table->string('live_b_password1');
            $table->string('live_b_username2');
            $table->string('live_b_password2');
            $table->string('live_b_username3');
            $table->string('live_b_password3');
            $table->string('live_c_url');
            $table->string('live_c_username');
            $table->string('live_c_password');
            $table->string('live_ftp_host');
            $table->string('live_ftp_port');
            $table->string('live_ftp_username');
            $table->string('live_ftp_password');
            $table->string('stagging_f_url');
            $table->string('stagging_b_url');
            $table->string('stagging_b_username1');
            $table->string('stagging_b_password1');
            $table->string('stagging_b_username2');
            $table->string('stagging_b_password2');
            $table->string('stagging_b_username3');
            $table->string('stagging_b_password3');
            $table->string('stagging_c_url');
            $table->string('stagging_c_username');
            $table->string('stagging_c_password');
            $table->string('stagging_ftp_host');
            $table->string('stagging_ftp_port');
            $table->string('stagging_ftp_username');
            $table->string('stagging_ftp_password');
            $table->string('ourserver_f_url');
            $table->string('ourserver_b_url');
            $table->string('ourserver_b_username1');
            $table->string('ourserver_b_password1');
            $table->string('ourserver_b_username2');
            $table->string('ourserver_b_password2');
            $table->string('ourserver_b_username3');
            $table->string('ourserver_b_password3');
            $table->string('ourserver_c_url');
            $table->string('ourserver_c_username');
            $table->string('ourserver_c_password');
            $table->string('ourserver_ftp_host');
            $table->string('ourserver_ftp_port');
            $table->string('ourserver_ftp_username');
            $table->string('ourserver_ftp_password');

			$table->timestamps();
            $table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('password_mgmts');
	}

}
