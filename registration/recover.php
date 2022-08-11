<?php
session_start();
include('../assets/modules/database-connection.php');
if(isset($_POST['user_submit'])){
    $user_email = $_REQUEST['user_email'];

    $sql = $con->prepare('select * from users where useremail = ?');
    $sql->bindParam(1,$user_email);

    $sql->execute();
    $count = $sql->rowCount();

    if($count > 0){
         $subject = "Email Activation";
              $body = "Hi, $user_name. Welcome to JustEntryLevel. To continue further, kindly click here to activate your account:
              // https://justentrylevel.com/registration/activate.php?token=$token ";
              $headers = "From: murtazausmani985@gmail.com";

              if (mail($user_email, $subject, $body, $headers)) {
                  $_SESSION['message'] = "Kindly Check Your Email: $user_email  To Activate your account";
                  header('location: ./login.php');
              }
    
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e1a5a5ef59.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/CSS/registration.css">
    <title>Log In</title>
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mx-1 mx-md-4 mt-5">Recover Your Password</p>

                <form class="mx-1 mx-md-4" method="POST">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-floating form-outline flex-fill mb-0">
                        <input type="email" id="user_email" class="form-control" name="user_email" required/>
                        <label for="user_email">Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-2">
                    <div class="flex-fill  ">
                      <p class="text-center">
                      Don't Have An Account? <a href="./register.php" class="text-decoration-none">Register</a>
                      </p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input type="submit" class="btn btn-outline-primary  " name="user_submit" value="Recover" />
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7  order-1 order-lg-2">
                <img src="../assets/images/undraw_Login_re_4vu2.png"
                  class="img-fluid img" alt="LogIn-Image">
            </div>

        </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>