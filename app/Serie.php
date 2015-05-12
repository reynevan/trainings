<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model {

  protected $fillable = ['order'];

	public function training(){
    return $this->belongsTo('App\Training');
  }

  public function exercises(){
    return $this->belongsToMany('App\Exercise')->withPivot('repeats');
  }

  public function user(){
    return $this->belongsTo('App\User');
  }

}
