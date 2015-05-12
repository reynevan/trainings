<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model {

	
  public function exercises(){
    return $this->belongsToMany('App\Exercise');
  }

  public function user(){
    return $this->belongsTo('App\User');
  }

  public function series(){
    return $this->hasMany('App\Serie');
  }
}
