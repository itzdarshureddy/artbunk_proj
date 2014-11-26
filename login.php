
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <link rel="stylesheet" href="login.css">
  
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

          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" name ="email" class="form-control" placeholder="Email address" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" name= "passwd" class="form-control" placeholder="Password" required>
          <div class="checkbox">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
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
          <form id="signupform" class="form-horizontal" action="register.php" method="post" role="form">

            <div id="signupalert" style="display:none" class="alert alert-danger">
              <p>Error:</p>
              <span></span>
            </div>



            <div class="form-group">
              <label for="email" class="col-md-3 control-label">Email</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="email" placeholder="Email Address" required autofocus>
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
                <input type="password" class="form-control" name="passwd" placeholder="Password" required>
              </div>
            </div>

            <div class="form-group">
              <label for="address" class="col-md-3 control-label">Address</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="address" placeholder="Address" required>
              </div>
            </div>

            <div class="form-group">
              <!-- Button -->                                        
              <div class="col-md-offset-3 col-md-9">
                <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
              </div>
            </div>




          </form>
        </div>
      </div>




    </div> 

  </div> 
</body>
</html>