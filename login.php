<?php
session_start();
include("php/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Login - <?php echo ucfirst($_SERVER['HTTP_HOST']); ?></title>
      <link href="css/sb-admin.min.css" rel="stylesheet">
      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   </head>
   <body>
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
               <div class="card shadow o-hidden border-0 my-5">
                  <div class="card-body p-0">
                     <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center" style="background-color: #F8F7FC">
                           <img src="https://<?php echo $_SERVER['HTTP_HOST']; ?>/img/nav-logo.png" class="px-5" style="width:auto;max-width:100%;height:auto;max-height: 50px" />
                        </div>
                        <div class="col-lg-6">
                           <div class="p-5">
                              <div class="text-center">
                                 <h1 class="h4 text-gray-900 mb-4">Login <small><?php echo ucfirst($_SERVER['HTTP_HOST']); ?></small></h1>
                              </div>
                              <form action="/admin/php/process.php" method="post" id="form">
                                 <input type="hidden" name="submit" value="signin">
                                 <div class="form-group">
                                    <input type="text" name="user" class="form-control" placeholder="Username" required>
                                 </div>
                                 <div class="form-group">
                                    <input type="password" name="pass" class="form-control" placeholder="Password" required>
                                 </div>
                                 <button type="submit" class="btn btn-success btn-block">
                                    Login
                                 </button>
                                 <div id="msg"></div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="js/java.js"></script>
   </body>
</html>
