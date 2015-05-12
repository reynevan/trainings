<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerciseTrainingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exercise_training', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('training_id')->unsigned();
			$table->foreign('training_id')
				->references('id')->on('trainings')
				->onDelete('cascade');
			$table->integer('exercise_id')->unsigned();
			$table->foreign('exercise_id')
				->references('id')->on('exercises')
				->onDelete('cascade');
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
		Schema::drop('exercise_training');
	}

}
