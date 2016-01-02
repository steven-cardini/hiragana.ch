// declare a module
var myAppModule = angular.module('hiragana', []);

myAppModule.controller('ColorController', ['$scope', function($scope) {

  $scope.reset = function(user) {
    user.color = '069';
  };

 $scope.$watch('user.color', function(newValue, oldValue) {
   $('footer').css('background-color', '#'+newValue);
 });

}]);
