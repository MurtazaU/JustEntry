<?php
session_start();
include('../../assets/modules/database-connection.php');
if(isset($_POST['user_submit'])){
    $user_email = $_REQUEST['user_email'];
    $user_password = $_REQUEST['user_password'];


    $sql = $con->prepare('select * from admin where adminemail = ? && adminpassword = ?');
    $sql->bindParam(1,$user_email);
    $sql->bindParam(2,$user_password);

    $sql->execute();
    $count = $sql->rowCount();

    if($count > 0){
      $_SESSION['user_email'] = $user_email;
      $_SESSION['admin_email'] = $user_email;
      header('location: ../adminpanel.php');


    } else{
      echo "<script>alert('Invalid Credentials')</script>";
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

                <p class="text-center h1 fw-bold mx-1 mx-md-4 mt-5">Log In As An Admin</p>
                <p class="text-center fw-bold mb-5 ">To Continue To JustEntryLevel</p>

                <form class="mx-1 mx-md-4" method="POST">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-floating form-outline flex-fill mb-0">
                        <input type="email" id="user_email" class="form-control" name="user_email" required/>
                        <label for="user_email">Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-floating form-outline flex-fill mb-0">
                        <input type="password" id="user_password" class="form-control" name="user_password" required/>
                        <label  for="user_password">Password</label>
                    </div>
                  </div>

                  <!-- <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div> -->
                    <div class="d-flex flex-row align-items-center mb-2">
                    <div class="flex-fill  ">
                      <p class="text-center">
                      Not An Admin? <a href="../../registration/login.php" class="text-decoration-none">Click Here</a>
                      </p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input type="submit" class="btn btn-outline-primary  " name="user_submit" value="Log In" />
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7  order-1 order-lg-2">
              <div data-bs-toggle="tooltip" data-bs-placement="top" title="Access control vector created by vectorjuice - www.freepik.com" >
              <a target="_blank" href="https://www.freepik.com/vectors/access-control">
                <img src="../../assets/images/login.webp"
                  class="img-fluid img" alt="LogIn-Image">
                  </button>
                  </a>
                </div>
            </div>

        </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
</body>
</html>