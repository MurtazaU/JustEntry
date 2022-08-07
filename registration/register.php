<?php
include('../assets/modules/database-connection.php');
if(isset($_POST['user_submit'])){
    $user_name = $_REQUEST['user_name'];
    $user_email = $_REQUEST['user_email'];
    $user_password = $_REQUEST['user_password'];
    $user_confirm = $_REQUEST['user_confirm'];

    if($user_password != $user_confirm){
        echo "<script>alert('Please Confirm Your Password')</script>";
    } else{
        $query = $con->prepare('select * from users where useremail = ?');
        $query->bindParam(1, $user_email);
        $query -> execute();
        $query_count = $query->rowCount();

        if($query_count == 0){

            $sql = $con->prepare('insert into users(username,useremail,userpassword) values (?,?,?)');
            $sql->bindParam(1,$user_name);
            $sql->bindParam(2,$user_email);
            $sql->bindParam(3,$user_password);
    
            $sql->execute();
    
            header('location: ./login.php');
    
    
    } else{
        echo "<script>alert('This Email Is Already In Use By Another Account')</script>";
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
    <title>Register</title>
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

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form class="mx-1 mx-md-4" method="POST">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class=" form-floating form-outline flex-fill mb-0">
                        <input type="text" id="user_name" class="form-control" name="user_name" required/>
                        <label for="user_name">Name</label>
                    </div>
                  </div>

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

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-floating form-outline flex-fill mb-0">
                        <input type="password" id="user_confirm" class="form-control" name="user_confirm" required/>
                        <label class="form-label" for="user_confirm">Confirm Password</label>
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
                      <p class="text-center ">
                        Already Have An Account? <a href="./login.php" class="text-decoration-none">Login</a>
                      </p>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input type="submit" class="btn btn-outline-primary  " name="user_submit" value="Sign Up" />
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7  order-1 order-lg-2">
              <div data-bs-toggle="tooltip" data-bs-placement="top" title="Citizen vector created by storyset - www.freepik.com" >
              <a target="_blank" href="https://www.freepik.com/vectors/citizen">
                <img src="../assets/images/register.webp"
                  class="img-fluid img" alt="SignUp-Image">
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