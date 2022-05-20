<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- <link href="img/logo/logo.png" rel="icon"> -->
  <title>WBSSRM - Login</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-4 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Web-based Sports Scheduling and Result Monitoring</h1>
                  </div>
                  <hr></hr>
                  <div class="alert alert-danger" id="msg" role="alert" style="display: none">Incorrect username or password!</div>
                  <div class="alert alert-danger" id="msg2" role="alert" style="display: none">User is Inactive!</div>
                  <form method="post" id="login_form">
                    <div class="form-group">
                      <input type="text" class="form-control" id="username" name="username" autocomplete="off" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Password" required>
                    </div>
                    <div class="form-group text-center">
                      <button type="submit" class="btn btn-primary btn-block" name="submit" value="save"><i class="fas fa-key"></i>&nbsp;&nbsp;Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="js/myjs.js"></script>
</body>

</html>