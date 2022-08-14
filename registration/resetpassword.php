<?php
session_start();
session_unset();
session_destroy();
include('../assets/modules/database-connection.php');

if(isset($_POST['user_submit'])){
    if(isset($_GET['email'])){
    $user_pass = $_REQUEST['user_new_pass'];
    $user_confirm = $_REQUEST['user_confirm_pass'];
    $user_email = $_GET['email'];
    $datetime = date("Y-m-d:h:i:s");


    if($user_pass != $user_confirm){
        echo "<script>alert('Please Check Your Passwords')</script>";
    } else{
        $query = $con->prepare('select * from users where useremail = ? ');
        $query->bindParam(1, $user_email);
        $query -> execute();

        if($query){
            $sql = $con->prepare('update users set userpassword = ?, forgotpassword = ? where useremail = ?');
            $sql->bindParam(1, $user_pass);
            $sql->bindParam(2, $dateTime);
            $sql->bindParam(3, $user_email);
            $sql->execute();
            echo '<p class="bg-success text-center text-white p-2 sticky-top">Your Password has been Updated!. Kinldy Log Back In To Continue </p>';
            session_unset();
            session_destroy();
            
        } else{
        echo '<p class="bg-warning text-center text-white p-2 mb-0 sticky-top">Please Try Again!</p>';
        }
    

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
    <title>Reset Password</title>
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

                <p class="text-center h1 fw-bold mx-1 mx-md-4 mt-5">Reset Your Password</p>

                <form class="mx-1 mx-md-4" method="POST">

                  <div class="d-flex flex-row align-items-center mb-4 mt-5">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-floating form-outline flex-fill mb-0">
                        <input type="password" id="user_new_pass" class="form-control" name="user_new_pass" required/>
                        <label for="user_new_pass">New Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4 mt-5">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-floating form-outline flex-fill mb-0">
                        <input type="password" id="user_confirm_pass" class="form-control" name="user_confirm_pass" required/>
                        <label for="user_confirm_pass">Confirm Password</label>
                    </div>
                  </div>

                       <div class="d-flex flex-row align-items-center mb-2">
                    <div class="flex-fill  ">
                      <p class="text-center">
                      Go To: <a href="./login.php" class="text-decoration-none">Login</a>
                      </p>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input type="submit" class="btn btn-outline-primary  " name="user_submit" value="Reset" />
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7  order-1 order-lg-2">
                <img src="../assets/images/undraw_User_flow_re_bvfx.png"
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