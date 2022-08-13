<?php 
session_start();
include('../assets/modules/database-connection.php');
if(!isset($_SESSION['user_email'])){
    header('location: ../registration/login.php');
}

// Fetching User Details
$sql = $con -> prepare('select * from users where useremail = ?');
$sql -> bindParam(1, $_SESSION['user_email']);
$sql -> execute();
$record = $sql -> fetchAll(PDO::FETCH_OBJ);

// Fetching Joined Groups Details
$query = $con -> prepare('select * from groups limit 1,1000');
$query -> execute();
$grouprecord = $query -> fetchAll(PDO::FETCH_OBJ);

// Edit Account
if(isset($_POST['edit_button'])){
  header('location: ./editaccount.php');
}

// Delete Account
if(isset($_POST['delete_button'])){
  $_SESSION['delete'] = true;
  header('location: ./deleteaccount.php');
}

?>

<!doctype html> 
<html lang="en">

<head>
    <title>Just Entry</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/CSS/sidebar.css">
    <script src="https://kit.fontawesome.com/e1a5a5ef59.js" crossorigin="anonymous"></script>

    <style>
    #sidebar {
        position: fixed;
        height: 100%;
        z-index: 200;
    }

    #content {
        margin-left: 250px;
        padding: 1px 16px;
        height: 1000px;
    }

    @media screen and (max-width: 1000px) {
        #content {
            margin-left: 0;
        }
    }

    @media screen and (max-width: 700px) {
        #content {
            margin-left: 0;
        }
    }

    .btn-red {
        background-color: red;
    }

    .view-btn {
        background-color: green;
    }
    </style>


</head>

<body>
<div class="wrapper d-flex align-items-stretch vh-100">
    <nav class="h-100 " id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
        </div>
        <div class="p-4 ">
            <h1><a href="../index.php" class="logo">JustEntry </a></h1>
            <ul class="list-unstyled components mb-5 mt-5 sidebar-links">
                <li>
                    <a href="../index.php" class="mt-3"><span class="fa fa-home mr-3"></span>DashBoard</a>
                </li>
                <li class="active ">
                    <a href="./account/viewaccount.php" class="mt-3"><span class="fa fa-solid fa-user mr-3"></span>Account</a>
                </li>
                <?php 
                if(isset($_SESSION['admin_email'])){
                    ?>
                <li>
                    <a href="../admin/adminpanel.php" class="mt-3"><span class="fa fa-solid fa-unlock mr-3"></span>Admin Panel</a>
                </li>
                    <?php
                }
                ?>
               
                <li>
                    <a href="../registration/logout.php" class="mt-3"><span
                            class="fa fa-solid fa-arrow-right-from-bracket mr-3"></span>LogOut</a>
                </li>
            </ul>

            <div class="footer">
                <p>
                                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                    document.write(new Date().getFullYear());
                    </script> All rights reserved. Powdered by justEntry | Developed by <a class="text-white" href="https://maszamtech.com" target="_blank">Maszam Technologies</a> <a href="">Template
                    by <a href="https://colorlib.ccom" target="_blank">Colorlib.com</a></a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>


        </div>
    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <section>
  <div class="container py-5">
 
        <?php 
        foreach($record as $row){
            ?>
                <div class="row">

      <div class="col-lg-4">
        <form method="POST">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="https://thumbs.dreamstime.com/b/businessman-icon-vector-male-avatar-profile-image-profile-businessman-icon-vector-male-avatar-profile-image-182095609.jpg" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3 text-capitalize"><?php echo $row->username ?></h5>
            <p class="text-muted mb-1"><?php echo $row->useremail ?></p>
            <p class="text-muted mb-4">User Id:<?php echo $row->userid ?></p>
            <div class="d-flex justify-content-center mb-2">
              <button class="btn btn-outline-danger ms-1" name="delete_button">Delete Account</button>
            </div>
          </div>
          <div class="card-footer text-center">
            <button class="btn btn-outline-success px-5" name="edit_button">Edit Account</button>
          </div>
        </div>
        </form>
        

      </div>
      <div class="col-lg-8">
        <div class="card mb-4 px-5">
          <div class="card-body">
            <h5 class="text-center mb-3">Details:</h5>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0 text-capitalize"><?php echo $row->username ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $row->useremail ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Status</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0 text-capitalize"><?php echo $row->status ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
                  <div class="card mb-4 mb-lg-0 ">
          <div class="card-body p-0">
              <?php
              if($row->groupnameid != 1){
                  foreach($grouprecord as $grouprow){
                if($grouprow->groupid == $row->groupnameid){

                ?>
                                    <h5 class="text-center my-3 text-capitalize">Group:</h5>
                    <ul class="list-group list-group-flush rounded-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="border-top: 2.5px solid rgb(223,223,223);">
                        <p>Group Id:</p>
                        <p ><?php echo $grouprow->groupid ?></p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3" style="border-top: 2.5px solid rgb(223,223,223);">
                        <p>Group Name:</p>
                        <p><?php echo $grouprow->groupname ?></p>
                    </li>


                    </ul>
                <?php
              }}}else{

                    ?>

                    <h5 class="text-center my-3 text-capitalize">Group:</h5>
                <h6 class="text-center my-3 text-capitalize">No Group Joined!</h6>
                    <ul class="list-group list-group-flush rounded-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="border-top: 2.5px solid rgb(223,223,223);">
                        <p>Group Id:</p>
                        <p >No Group Id</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3" style="border-top: 2.5px solid rgb(223,223,223);">
                        <p>Group Name:</p>
                        <p>No Group Name</p>
                    </li>


                    </ul>
                    <?php
                }
                ?>
                <?php
          
            ?>
          </div>
        </div>
        </div>
      </div>
    </div>
            <?php
        }
        ?>

  </div>
</section>
</div>
                </div>

       <!-- SCRIPTS -->
       <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="./assets/JS/sidebar.js"></script>

    </script>
    </body>
    </html>
