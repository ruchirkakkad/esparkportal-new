<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarketingDatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketing_datas', function(Blueprint $table)
		{
			$table->increments('marketing_datas_id');
            $table->string('owner_name');
            $table->string('company_name');
            $table->string('website');
            $table->string('phone');
            $table->string('email');

            $table->unsignedInteger('marketing_states_id');
            $table->foreign('marketing_states_id')
                ->references('marketing_states_id')->on('marketing_states')
                ->onDelete('cascade');

            $table->unsignedInteger('marketing_categories_id');
            $table->foreign('marketing_categories_id')
                ->references('marketing_categories_id')->on('marketing_categories')
                ->onDelete('cascade');


            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('cascade');

            $table->unsignedInteger('leads_statuses_id');
            $table->foreign('leads_statuses_id')
                ->references('leads_statuses_id')->on('leads_statuses')
                ->onDelete('cascade');

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
		Schema::drop('marketing_datas');
	}

}
