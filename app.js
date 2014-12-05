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
  app.factory('CartFactory', ['$resource',
    function($resource) {
      return $resource('/cart.php', {}, {
        query: {
          method: 'GET',
          isArray: true
        },
        update: {
          method: 'GET'
        }
      });
    }
  ]);

  app.controller('paintingsController',function($scope, CategoryFactory, CartFactory, PaintingsFactory){
    $scope.paintingsArray = [];
    $scope.searchName = "";
    $scope.categoriesArray = [];
    $scope.currentCart = [];
    $scope.showingCart = false;
    $scope.totalCart = 0;
    $scope.cleanCart =true;

    PaintingsFactory.query().$promise.then(function(data){
      $scope.paintingsArray = data;
    });

    CategoryFactory.query().$promise.then(function(data){
      $scope.categoriesArray = data;
    });

    $scope.getImagesByName = function(){
      PaintingsFactory.query({searchName:$scope.searchName}).$promise.then(function(data){
      $scope.paintingsArray = data;
      $scope.enlargeOnePainting = false;
      $scope.showingCart = false;
    });
    }
    $scope.getImagesBycategory = function(categoryId){
      PaintingsFactory.query({category:categoryId}).$promise.then(function(data){
      $scope.paintingsArray = data;
      $scope.enlargeOnePainting = false;
      $scope.showingCart = false;
    });
    }

    $scope.displayCart = function(){
        $scope.showingCart = true;
        $scope.enlargeOnePainting = false;
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

    $scope.addToCart = function(){
      CartFactory.update({method:'add',painting_id:$scope.selectedPainting.painting_id}).$promise.then(function(data){
        $scope.selectedPainting.painting_status = "ADDED TO CART";
        $scope.totalCart = $scope.totalCart+ parseInt($scope.selectedPainting.price);
        $scope.currentCart.push($scope.selectedPainting);
        $scope.showingCart =true;
        $scope.enlargeOnePainting=false;
      });
    }

    $scope.removeFromCart = function(painting_id){
      $scope.cleanCart = true;
      $scope.totalCart = 0;
        CartFactory.update({method:'remove',painting_id:painting_id}).$promise.then(function(data){
        CartFactory.query().$promise.then(function(data){
        $scope.currentCart = data;
        $scope.currentCart.forEach(function(item){
       if(item.painting_status == 'SOLD'){
          $scope.cleanCart = false;
        }
        $scope.totalCart = $scope.totalCart + parseInt(item.price);
        $scope.paintingsArray.forEach(function(painting){
          if(painting.painting_id == item.painting_id && item.painting_status != 'SOLD'){
            painting.painting_status = "ADDED TO CART";
          }

        });
      });
    });
      });


    };

    CartFactory.query().$promise.then(function(data){
      $scope.currentCart = data;
      $scope.currentCart.forEach(function(item){
        if(item.painting_status == 'SOLD'){
          $scope.cleanCart = false;
        }
        $scope.totalCart = $scope.totalCart + parseInt(item.price);
        $scope.paintingsArray.forEach(function(painting){
          if(painting.painting_id == item.painting_id && item.painting_status != 'SOLD'){
            painting.painting_status = "ADDED TO CART";
          }

        });
      });
    });


  });
})();