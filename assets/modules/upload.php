<?php
session_start();
if(!isset($_SESSION['user_email'])){
    header('location: ./registration/login.php');
}
include('./database-connection.php');
                    $groupid = $_GET['groupid']; 
                    $group_name = $_GET['group'];
                    $useremail = $_SESSION['user_email'];
                    $query = $con->prepare('select * from uploads where uploadgroup = ? && uploaduser = ?');
                    $query->bindParam(1,$group_name);
                    $query->bindParam(2,$useremail);
                    $query-> execute();
                    $count = $query -> rowCount();
                    $record = $query -> fetchAll(PDO::FETCH_OBJ);

                    if(isset($_REQUEST['user_upload_file'])){
                    $uploadfile = $_FILES["upload_file"]['name'];
                    $uploadtmpname = $_FILES["upload_file"]['tmp_name'];
                    $uploadtype = $_FILES["upload_file"]['type'];
                    if($uploadtype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
                        move_uploaded_file($uploadtmpname, "../../upload-files/$uploadfile");
                        $sql = $con->prepare('insert into uploads(uploaduser, uploadgroup, uploadfile, uploadfiletype) values (?,?,?,?)');
                        $sql->bindParam(1,$useremail);
                        $sql->bindParam(2,$group_name);
                        $sql->bindParam(3, $uploadfile);
                        $sql->bindParam(4, $uploadtype);
                        $sql-> execute();
                        header("Refresh:0");
                    } else{
                        echo '<p class="bg-success sticky-top text-center text-white p-2 mb-0 rounded-3">Please Upload Only .docx Files!</p>'; 
                    }
                    }

                    // User Fetching
                    $usersql = $con -> prepare('select * from users where groupnameid = ?');
                    $usersql->bindParam(1, $groupid);
                    $usersql->execute();
                    $userrecord = $usersql -> fetchAll(PDO::FETCH_OBJ);
                    
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
    <link rel="stylesheet" href="../CSS/sidebar.css">
    <script src="https://kit.fontawesome.com/e1a5a5ef59.js" crossorigin="anonymous"></script>
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
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
        .btn-red {
        background-color: red;
    }
    .upload-card{
        border-radius: 5%;
    }
    .delete-btn{
        background-color: #dc3545;
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
    </style>

    <link rel="stylesheet" href="../CSS/upload.css">

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
            <h1><a href="./index.php" class="logo">JustEntry </a></h1>
            <ul class="list-unstyled components mb-5 mt-5 sidebar-links">
                <li >
                    <a href="../../index.php" class="mt-3"><span class="fa fa-home mr-3"></span>DashBoard</a>
                </li>
                <li>
                    <a href="../../account/viewaccount.php" class="mt-3"><span class="fa fa-solid fa-user mr-3"></span>Account</a>
                </li>
                                <?php 
                if(isset($_SESSION['admin_email'])){
                    ?>
                <li>
                    <a href="./admin/adminpanel.php" class="mt-3"><span class="fa fa-solid fa-unlock mr-3"></span>Admin Panel</a>
                </li>
                    <?php
                }
                ?>
                <li>
                    <a href="../../registration/logout.php" class="mt-3"><span
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
<div class="container">
    <div class="row">
                    <button type="submit" name="view_group"
            class="btn btn-red  mb-3  me-auto  col-4" id="group_id">
            <a href='./leavegroup.php?group=<?php echo $group_name;?>?>'
            class="text-white">Leave Group</a> </button>
        <div class="col-lg-12 col-sm-12">


            <h2 class="mb-4 ">Upload A File:</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <input class="form-control form-control-lg" type="file" name="upload_file" accept="application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
                    <p class="text-muted m-2">Please Upload Only .docx Files</p>
                    <p class="text-muted m-2">Please Upload A Maximum Of 3 Files</p>
                    <?php
                    if(3 <= $count)
                    { ?>
                    <button class="btn btn-primary mt-3 w-50 form-control form-control-lg  text-white" disabled>Upload File </button>
                    <?php
                    } else{
                        ?>
                        <button class="btn btn-primary mt-3 w-50 form-control form-control-lg  text-white" type="submit" name="user_upload_file" >Upload File </button>
                        <?php
                    }
                    ?>
                    
                </div>
            </form>
        </div>
       
    </div>



    <div class="row">
        <h2 class="mb-2 mt-4">Your Files:</h2>
            <?php
                foreach($record as $row){
            ?>
            <div class="card upload-card col-md-3 col-lg-3 col-sm-12 mx-2 my-2 text-center" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">File Name: <?php echo $row->uploadfile ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">File Type: Docx</h6>
                            <a href="./upload/delete-file.php?fileId=<?php echo $row->uploadid ?>&group=<?php echo $group_name;?>&groupid=<?php echo $groupid ?>">
                                <input type="submit" class="btn btn-danger delete-btn form-control text-white mb-2  mt-3" name="delete_file" value="Delete File"/>
                            </a>
                    <br/>
                </div>
            </div>
        <?php
    }
    ?>
    </div>
    <div class="row">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase mt-5">Total Users:</h5>
      </div>
    </div>

<table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>User Name</th>
      <th>User Email</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach($userrecord as $row){
        ?>
 <tr>
      <td>
            <p class="mb-1"><?php echo $row->username; ?></p>
      </td>
      <td>
            <p class=" mb-1"><?php echo $row->useremail; ?></p>
      </td>
     
    </tr>
        <?php
    }
    ?>
  </tbody>
</table>
</div>





    </div>
</div>
       <!-- SCRIPTS -->
       <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../JS/sidebar.js"></script>
    <script src="../JS/upload.js"></script>

    </script>
    </body>
    </html>