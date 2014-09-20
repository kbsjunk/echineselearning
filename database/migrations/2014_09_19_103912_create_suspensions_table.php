<?php

 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Database\Migrations\Migration;

class CreateSuspensionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ecl_suspensions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('start_at');
			$table->date('end_at');
			$table->boolean('enabled')->default('1');
			$table->text('desc');
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
		Schema::drop('ecl_suspensions');
	}

}
