<?php
session_start();
session_unset();
session_destroy();
include('../assets/modules/database-connection.php');
if(isset($_POST['user_submit'])){
    $user_email = $_REQUEST['user_email'];

    $sql = $con->prepare('select * from users where useremail = ?');
    $sql->bindParam(1,$user_email);


    $sql->execute();

    $count = $sql->rowCount();

    if($count > 0){
         $subject = "Password Recovery";
              $body = "Hello, We noticed that you want to reset your password. Please click on the following link to make that change.
                https://justentrylevel.com/registration/resetpassword.php?email=$user_email

                Thanks
                justEntry Team
               ";
              $headers = "From: Info@justentrylevel.com";

              if (mail($user_email, $subject, $body, $headers)) {
                echo '<p class="bg-success text-center text-white p-2 rounded-3">Please Check Your Email To Reset Your Password!</p>';
                $_SESSION['reset-mail']= 'sent';
              }
    
    }else{
        echo '<p class="bg-danger text-center text-white p-2 mb-0 sticky-top">No Email Found!</p>';
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
    <title>Recover Password</title>
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

                  <div class="d-flex flex-row align-items-center mb-4 mt-5">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-floating form-outline flex-fill mb-0">
                        <input type="email" id="user_email" class="form-control" name="user_email" required/>
                        <label for="user_email">Email</label>
                    </div>
                  </div>
                  <?php if(isset($_SESSION['reset-mail'])){
                    ?>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input type="submit" class="btn btn-outline-primary  " disabled name="user_submit" value="Recover" />
                  </div>
                    <?php
                  } else{
                    ?>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input type="submit" class="btn btn-outline-primary  " name="user_submit" value="Recover" />
                    </div>
                    <?php
                  }?>


                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7  order-1 order-lg-2">
                <img src="../assets/images/undraw_My_password_re_ydq7.png"
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