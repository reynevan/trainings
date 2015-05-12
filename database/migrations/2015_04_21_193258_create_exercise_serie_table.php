<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerciseSerieTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exercise_serie', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('serie_id')->unsigned();
			$table->foreign('serie_id')
				->references('id')->on('series')
				->onDelete('cascade');
			$table->integer('exercise_id')->unsigned();
			$table->foreign('exercise_id')
				->references('id')->on('exercises')
				->onDelete('cascade');
			$table->integer('repeats')->unsigned();
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
		Schema::drop('exercise_serie');
	}

}
