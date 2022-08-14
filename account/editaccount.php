<?php 
session_start();
include('../assets/modules/database-connection.php');
if(!isset($_SESSION['user_email'])){
    header('location: ../registration/login.php');
}

if(isset($_POST['editAccount'])){
    if($_POST['editPassword'] == $_POST['editConfirm']){
        $username = $_POST['editFirst'] . $_POST['editLast'];
        $userpassword = $_POST['editPassword'];
        $datetime = date("Y-m-d:h:i:s");

        $sql = $con -> prepare("update users set username = ?, userpassword = ?, editaccount = ? where useremail = ?");
        $sql -> bindParam(1, $username);
        $sql -> bindParam(2, $userpassword);
        $sql -> bindParam(3, $datetime);
        $sql -> bindParam(4, $_SESSION['user_email']);
        $sql->execute();

        echo '<p class="bg-success text-center text-white p-2 mb-0 sticky-top">Your Account Has Been Successfully Updated!</p>';


    } else{
        echo '<p class="bg-danger text-center text-white p-2 mb-0 sticky-top">Please Confirm Your Password Correctly!</p>';

    }
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
    <link rel="stylesheet" href="../assets/CSS/editaccount.css">

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
                    <a href="./viewaccount.php" class="mt-3"><span class="fa fa-solid fa-user mr-3"></span>Account</a>
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
                    by <a href="https://colorlib.com" target="_blank">Colorlib.com</a></a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>


        </div>
    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->   
                    <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button">Upload new image</button>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form method="POST">
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (Name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="editFName">First Name</label>
                                <input class="form-control" id="editFName" name="editFirst" type="text" placeholder="Enter your first name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="editLName">Last Name</label>
                                <input class="form-control" id="editLName" name="editLast" type="text" placeholder="Enter your last name" required>
                            </div>
                        </div>
                        <!-- Form Row    -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (email)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="editEmail">Email Address <span class="text-danger">*Not Allowed*</span></label>
                                <input class="form-control" id="editEmail" name="editEmail" type="email" disabled placeholder="Enter your email address">
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="row">
                            <!-- Form Group (Password)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="editPassword">Password</label>
                                <input class="form-control" id="editPassword" name="editPassword" type="password" placeholder="Enter your password" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="editConfirm">Confirm Password</label>
                                <input class="form-control" id="editConfirm" name="editConfirm" type="password" placeholder="Confirm your password" required>
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" name="editAccount">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
