<?php

 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ecl_lessons', function(Blueprint $table)
		{
			$table->increments('id');
			$table->dateTime('lesson_at')->nullable();
			$table->string('teacher')->nullable();
			$table->boolean('enabled')->default('1');
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
		Schema::drop('ecl_lessons');
	}

}
