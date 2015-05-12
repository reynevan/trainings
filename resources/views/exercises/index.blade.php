@extends('app')

@section('content')
<div class='exercises' ng-controller='ExercisesCtrl'>
  <div ng-show="loading">Loading</div>
  <div ng-hide="loading">
    <div class="exercises" ng-repeat="exercise in exercises">
      <% exercise.name %> | <% exercise.maxRepeats %>
    </div>
    <div ng-show="sending">Sending...</div>
    {!! Form::open(array('action' => 'ExercisesController@create')) !!}
    {!! Form::text('name', 'Name', array('ng-model' => 'newExercise')) !!}    
    {!! Form::close() !!}
    <button ng-click="addExercise()" href>Dodaj</button>
  </div>
</div>

@stop

@section('script')
<script src='/js/controllers/exercises_controller.js'></script>
@stop
