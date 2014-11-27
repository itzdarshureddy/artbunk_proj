(function(){
var app=angular.module('homeDashboard',['ngResource','ngRoute']);

  app.factory('PaintingsFactory', ['$resource',
    function($resource) {
      return $resource('/getPaintings.php', {}, {
        query: {
          method: 'GET',
          isArray: true
        }
      });
    }
  ]);

  app.controller('paintingsController',function($scope, PaintingsFactory){
  	$scope.paintingsArray = [];
  	PaintingsFactory.query().$promise.then(function(data){
  		$scope.paintingsArray = data;
  		console.log($scope.paintingsArray.length);
  	});


  });
})();