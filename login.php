<?php
session_start();

?>
<html ng-app="loginDashboard">
<head>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.4/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.4/angular-resource.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.4/angular-route.min.js"></script>
  <script src="login.js"></script>

  
</head>
<body>
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
      <a class="navbar-brand logo" href="#">ArtBunk</a>
    </div>

  </div><!-- /.container-fluid -->
</nav>
  <div class="container">
    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

      <div class="panel panel-info">

        <div class="panel-heading">
          <div class="panel-title">Sign in</div>
        </div>
        <div class='panel-body'>
        <form class="form-signin" method="post"  action="userLogin.php" role="form">
          <?php
          if($_SESSION['errorLogin']){
            echo "<div  class='alert alert-danger'>Email or Password is invalid</div>";
            }
          ?>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" name ="email" class="form-control" placeholder="Email address" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" name= "passwd" class="form-control" placeholder="Password" required>
          
          <button class="btn btn-lg btn-info btn-block" type="submit">Sign in</button>
          <div class="form-group">
            <div class="col-md-12 control">
              <div style="padding-top:15px; font-size:85%" >
                Don't have an account? 
                <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                  Sign Up Here
                </a>
              </div>
            </div>
          </div>  
        </form>
      </div>
      </div>
    </div>

    <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="panel-title">Sign Up</div>
          <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
        </div>  
        <div class="panel-body" >
          <form id="signupform" name="signupForm" class="form-horizontal" action="register.php" method="post" role="form" ng-controller="passwordController">

            <div id="signupalert" style="display:none" class="alert alert-danger">
              <p>Error:</p>
              <span></span>
            </div>



            <div class="form-group">
              <label for="email" class="col-md-3 control-label">Email</label>
              <div class="col-md-9">
                <input type="text" class="form-control"   name="email" ng-model="emailEntered" ng-change="checkEmail()" placeholder="Email Address" required autofocus>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
              <div ng-show="showEmailError" class="alert alert-danger col-md-offset-3">Email already registered.</div>
              </div>
            </div>

            <div class="form-group">
              <label for="firstname" class="col-md-3 control-label">First Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
              </div>
            </div>
            <div class="form-group">
              <label for="lastname" class="col-md-3 control-label">Last Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-md-3 control-label">Password</label>
              <div class="col-md-9">
                <input type="password" class="form-control" ng-model="password" ng-change="showPassPowrdLength()" name="passwd" placeholder="Password" required>
              </div>

            </div>
            <div class="form-group">
              <div class="col-md-12">
              <div ng-show="showLengthError" class="alert alert-danger col-md-offset-3">Password should contain at least 8 characters, 1 number,1 upper and 1 lowercase alphabet</div>
              </div>
            </div>

            <div class="form-group">
              <label for="address" class="col-md-3 control-label">Address</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="address" placeholder="Address">
              </div>
            </div>

            <div class="form-group">
              <!-- Button -->                                        
              <div class="col-md-offset-3 col-md-9">
                <button id="btn-signup" ng-disabled="signupForm.$invalid || showLengthError || form.email.$error.email" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
              </div>
            </div>




          </form>
        </div>
      </div>




    </div> 

  </div> 
</body>
</html>
