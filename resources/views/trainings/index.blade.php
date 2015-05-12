@extends('app')

@section('content')
<div class='exercises' ng-controller='TrainingsCtrl'>

  <button class='btn btn-success' ng-click='newTraining()'>New training</button>
  <div class="new-training" ng-show="training">
      <table>
          <thead>
          <tr>
              <td>
                  -
              </td>
              <td ng-repeat="serie in training.series">
                  Seria <% $index+1 %>
              </td>
          </tr>
          </thead>
          <tbody>
          <tr ng-repeat="exercise in training.exercises">
              <td>
                  {!! Form::select('exercise', $exercises, array('ng-model' => 'training.exercises[$index]')) !!}
              </td>
              <td ng-repeat="serie in training.series">
                  {!! Form::input('number', 'repeats', '', array('ng-change'=>'change()', 'ng-model'=>'training.series[$index].exercises[$parent.$index].repeats')) !!}
              </td>
          </tr>
          </tbody>
      </table>
      <button class="btn btn-success" ng-click="addSerie()">Dodaj serię</button>
      <button class="btn btn-info" ng-click="addExercise()">Dodaj ćwiczenie</button>
      <button class="btn btn-error" ng-click="saveTraining()">Zapisz</button>
  </div>
  <div ng-show="loading">Loading</div>
  <div ng-hide="loading">
    <div class="trainings">
      <div ng-repeat="training in trainings">
        Trening z : <% training.created_at %> 
        <button class='btn btn-danger' ng-class="{disabled: training.deleting}" ng-click="deleteTraining(training)">delete</button><br/>
        <div ng-repeat="serie in training.series">
          Seria <% serie.order %> <br/>
          Ćwiczenia:
          <div ng-repeat="exercise in serie.exercises">
            <% exercise.name %> - <% exercise.pivot.repeats %>
          </div>
        </div>
      </div>
    </div>
    <div ng-show="sending">Sending...</div>
    
  </div>
</div>

@stop

@section('script')
<script src='/js/controllers/trainings_controller.js'></script>
@stop
