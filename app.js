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
  app.factory('CategoryFactory', ['$resource',
    function($resource) {
      return $resource('/categories.php', {}, {
        query: {
          method: 'GET',
          isArray: true
        }
      });
    }
  ]);

  app.controller('paintingsController',function($scope, CategoryFactory, PaintingsFactory){
  	$scope.paintingsArray = [];
  	$scope.searchName = "";
  	$scope.categoriesArray = [];
  	PaintingsFactory.query().$promise.then(function(data){
  		$scope.paintingsArray = data;
  	});

  	CategoryFactory.query().$promise.then(function(data){
  		$scope.categoriesArray = data;
  	});

  	$scope.getImagesByName = function(){
  		PaintingsFactory.query({searchName:$scope.searchName}).$promise.then(function(data){
  		$scope.paintingsArray = data;
  	});
  	}
  	$scope.getImagesBycategory = function(categoryId){
  		PaintingsFactory.query({category:categoryId}).$promise.then(function(data){
  		$scope.paintingsArray = data;
  	});
  	}

  	$scope.selectedPainting = {};

  	$scope.enlargeOnePainting = false;

  	$scope.selectPainting = function(painting){
  		$scope.selectedPainting = painting;
  		$scope.categoriesArray.forEach(function(category){
  			if(category.category_id==painting.category_id){
  				$scope.selectedPainting.category_name = category.category_name;
  			}
  		});
  		$scope.enlargeOnePainting = true;
  	}


  });
})();