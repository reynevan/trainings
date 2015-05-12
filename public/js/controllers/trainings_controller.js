app.controller('TrainingsCtrl', function($scope, $http){
  $scope.loading = true;
  $scope.series = [];
  $http.get('/trainings/user').success(function(data){
    console.log(data);
    if (data.success){
      $scope.loading = false;
      $scope.trainings = data.trainings;
    }
  });

  $scope.newTraining = function(){
    $http.get('trainings/create').success(function(data){
      if (data.success){
        $scope.training = data.training;
          console.log(data);
      }
    })
  };

  $scope.addSerie = function(){
      $http.post('/trainings/'+$scope.training.id+'/add_serie', {'exercises':$scope.training.exercises}).success(function(data){
          if (data.success){
              $scope.training.series = data.series;
          }
      })
  };

  $scope.saveTraining = function(){
    $http.put('/trainings/'+$scope.training.id, {training: $scope.training}).success(function(data){
        console.log(data);
    })
  };

    $scope.addExercise = function(){
        angular.forEach($scope.training.series, function(serie){
            console.log(serie)
            serie.exercises.push({});
            console.log(serie)
        })
        $scope.training.exercises.push({});
    };

    $scope.change = function(){
        console.log($scope.training);
    }

    $scope.deleteTraining = function(training){
      training.deleting = true;
      $http.delete('/trainings/'+training.id).then(function(data){
          console.log(data);
          if (data.data.success){
              $scope.trainings = data.data.trainings;
          }
      })
    }

})