app.controller('ExercisesCtrl', function($scope, $http){
  $scope.loading = true;
  $scope.exercises = [];
  $http.get('/exercises/user/').success(function(data){
    $scope.loading = false;
    $scope.exercises = data.exercises;
    console.log(data.exercises)
  })
  $scope.token = angular.element(document.getElementsByName('_token')[0]).val();

  $scope.addExercise = function(){
    $scope.sending = true;
    var fdata = {name: $scope.newExercise, _token: $scope.token}
    $http.post('/exercises/', fdata)
      .success(function(data){
        if (data['success']){
          $scope.exercises = data['exercises'];
        }
        clearAfterRequest();
      })
      .error(function(data){
        clearAfterRequest();
      });
    
  }

  var clearAfterRequest = function(){
    $scope.sending = false;
    $scope.newExercise = null;
  }

  
  
})