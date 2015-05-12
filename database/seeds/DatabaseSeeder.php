<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		DB::table('users')->delete();
		DB::table('trainings')->delete();
		DB::table('series')->delete();
		DB::table('exercise_user')->delete();
		DB::table('exercise_training')->delete();
		DB::table('exercise_serie')->delete();
		DB::table('exercises')->delete();

		$user = App\User::create(['name'=>'pafeu', 'email'=>'pafeu@example.com', 'password'=>Hash::make('dupa123')]);
		$ex_1 = $user->exercises()->create(['name'=>'sranie na renkach']);
		$ex_2 = $user->exercises()->create(['name'=>'jedzenie paruwek']);

		$training_1 = $user->trainings()->create([]);
		$serie_1 = $training_1->series()->create([]);
		$serie_2 = $training_1->series()->create([]);

		$serie_1->exercises()->attach([$ex_1['id'] => ['repeats' => 10], $ex_2['id'] => ['repeats' => 15]]);
		$serie_2->exercises()->attach([$ex_1['id'] => ['repeats' => 20], $ex_2['id'] => ['repeats' => 25]]);	

		$training_2 = $user->trainings()->create([]);

		$serie2_1 = $training_2->series()->create([]);
		$serie2_2 = $training_2->series()->create([]);

		$serie2_1->exercises()->attach([$ex_1['id'] => ['repeats' => 10], $ex_2['id'] => ['repeats' => 15]]);
		$serie2_2->exercises()->attach([$ex_1['id'] => ['repeats' => 20], $ex_2['id'] => ['repeats' => 25]]);	





		//$this->call('UserTableSeeder');
	}

}
