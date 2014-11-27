<?php
session_start();

if(!$_SESSION['userId']){
  header("Location: login.php");
}
?>
<html ng-app="homeDashboard">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.4/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.4/angular-resource.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.4/angular-route.min.js"></script>
  <script src="app.js"></script>

  <link rel="stylesheet" href="home.css">
</head>
<body ng-controller="paintingsController">
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand logo" href="home.php">ArtBunk</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-paint-brush"></i>  Categories <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li ng-repeat="category in categoriesArray" ng-click="getImagesBycategory(category.category_id)"><a href="#" >{{category.category_name}}</a></li>
              
            </ul>
          </li>
        </ul>
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" ng-model="searchName" class="form-control" placeholder="Enter Painting Name">
          </div>
          <button type="submit" ng-click="getImagesByName()" class="btn btn-default">Search</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li><a><i class="fa fa-shopping-cart"></i> Cart</a></li>
          <li><a data-toggle="modal" data-target="#uploadModal"><i class="fa fa-upload"></i> Upload</a></li>
          <li><a href="logout.php"><i class="fa fa-sign-out"></i> Sign out</a></li>

        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <div class="container">
    <div class="row" ng-show="!enlargeOnePainting">

                <div ng-repeat="painting in paintingsArray" class="col-md-3 thumbnail img-responsive">
                    <a ng-click="selectPainting(painting)" title="Image 1">
                        <img ng-src="showimage.php?id={{painting.painting_id}}"  /></a>
                        <div class="details">
                        <h4 class="title">{{painting.painting_name}}</h4>
                        Price: <span class="price">{{painting.price}} $</span>
                        <span class="banner">{{painting.painting_status}}</span>
                      </div>
                </div>
    </div>
    <div class="row" ng-show="enlargeOnePainting">
        <div class="col-md-12 thumbnail img-responsive">
          <img class="col-md-6"  ng-src="showimage.php?id={{selectedPainting.painting_id}}"  />
          <div class="col-md-6 details">
            <h3>{{selectedPainting.painting_name}}</h3>
            <p>{{selectedPainting.description}}</p>
            <p><b>Painting Category: </b>{{selectedPainting.category_name}}</p>
            <p><b>Painting Year: </b>{{selectedPainting.painting_year}}</p>
            <p><b>Artist: </b>{{selectedPainting.artist_name}}</p>
            <p><b>Dimensions: </b>{{selectedPainting.dimensions}} inches</p>
            <p><b>Status: </b><span class="banner"> {{selectedPainting.painting_status}}</sapn></p>
            <button class="btn btn-primary" ng-disabled="selectedPainting.painting_status!='AVAILABLE'"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
          </div>
        </div>

    </div>
  </div> 

  <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="uploadModalLabel">Enter Painting Details</h4>
        </div>
        <form role="form" method="post" action="uploadPainting.php" enctype="multipart/form-data">
          <div class="modal-body">

            <div class="form-group">
              <label for="painting-name" class="control-label">Painting Name:</label>
              <input type="text" name="name" class="form-control" id="painting-name" required>
            </div>
            <div class="form-group">
              <label for="description-text" class="control-label">Description:</label>
              <textarea class="form-control" name="description" id="description-text"></textarea>
            </div>
            <div class="form-group">
              <label for="painting-artist" class="control-label">Artist:</label>
              <input type="text" class="form-control" name="artist" id="painting-artist">
            </div>
            <div class="form-group">
              <label for="painting-category" class="control-label">Category:</label>
              <select  class="form-control" name="category" id="painting-category" required>
                <option ng-repeat="category in categoriesArray" value="{{category.category_id}}">{{category.category_name}}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="painting-price" class="control-label">Price:</label>
              <input type="number" class="form-control" name="price" id="painting-price" required>
            </div>
            <div class="form-group">
              <label for="painting-year" class="control-label">Painting Year:</label>
              <input type="number" class="form-control" name="year" id="painting-year">
            </div>
            <div class="form-group form-inline">
              <label for="painting-width" class="control-label">Width:</label>
              <input type="number" class="form-control" name="width" id="painting-width" placeholder="0 inches" required>
              <label for="painting-height" class="control-label">Height:</label>
              <input type="number" class="form-control" name="height" id="painting-height" placeholder="0 inches" required>
            </div>

            <input type="file" name="image" id="painting-img" required>
            

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload Painting</button>

          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

