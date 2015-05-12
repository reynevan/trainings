<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Exercise extends Model {

	protected $fillable = ['name', 'description'];

  public function users(){
    return $this->belongsToMany('App\User');
  }

  public function trainings(){
    return $this->belongsToMany('App\Training');
  }

  public function series(){
    return $this->belongsToMany('App\Serie');
  }

  public function maxRepeats($user_id){
    $user = User::find($user_id);
    if (!$user){
      return 0;
    }
    $max = 0;
    $trainings = $user->trainings;
    foreach ($trainings as $training){
      $series = $training->series;
      foreach ($series as $serie){
        $s_exercise = $serie->exercises()->find($this['id']);
        if ($s_exercise['pivot']['repeats'] > $max || $max == 0){
          $max = $s_exercise['pivot']['repeats'];
        }

      } 
    }
    return $max;  
  }
}
