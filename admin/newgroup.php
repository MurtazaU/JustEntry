<?php 
include('../assets/modules/database-connection.php');
session_start();
if(!isset($_SESSION['admin_email'])){
  header('location: ./login/adminlogin.php');
}

// Groups
$groupssql = $con->prepare('select * from groups limit 1,1000');
$groupssql -> execute();
$groupscount = $groupssql->rowCount();
$record = $groupssql -> fetchAll(PDO::FETCH_OBJ);

// New Groups
$date = date('Y-m-d');
$newgroupssql = $con->prepare('select * from groups where groupregistrationdate = ?');
$newgroupssql-> bindParam(1, $date);
$newgroupssql -> execute();
$newgroupscount = $newgroupssql->rowCount();

// Create New Group
if(isset($_POST['create_group'])){
    $newgroup = $_POST['group_name'];
    $groupbg =  $_FILES['group_bg']['name'];
    $groupbgtmp = $_FILES['group_bg']['tmp_name'];

    $sql = $con -> prepare('insert into groups(groupname, groupbgimg, groupregistrationdate) values(?,?,?)');
    $sql -> bindParam(1, $newgroup);
    $sql -> bindParam(2, $groupbg);
    $sql -> bindParam(3, $date);
    $sql -> execute();
    move_uploaded_file($groupbgtmp, "../upload-files/groupbg/$groupbg");
    // header('locatio')
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/CSS/sidebar.css">
    <script src="https://kit.fontawesome.com/e1a5a5ef59.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/CSS/edit.css">

    
    <title>Just Entry</title>
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
                        <a href="./adminpanel.php" class="mt-3"><span class="fa fa-home mr-3"></span>Main Panel</a>
                    </li>
                    <li>
                        <a href="./users.php" class="mt-3"><span class="fa fa-solid fa-user mr-3"></span>Users</a>
                    </li>
                    <li>
                        <a href="./groups.php" class="mt-3"><span class="fa fa-solid fa-people-group mr-3"></span>Groups</a>
                    </li>
                    <li class="active">
                        <a href="./newgroup.php" class="mt-3"><span class="fa fa-solid fa-circle-plus mr-3"></span>New Group</a>
                    </li>
                    <li >
                        <a href="../index.php" class="mt-3"><span class="fa fa-solid fa-user-lock mr-3"></span>User Dashboard</a>
                    </li>
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
            <h2 class="mb-4">Create A New Group</h2>
            <section class=" text-dark">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-9">
            <form method="POST" enctype="multipart/form-data">

                <div class="card" style="border-radius: 15px; margin-top:50px;">
                  <div class="card-body">
        
                    <div class="row align-items-center pt-4 pb-3">
                      <div class="col-md-3 ps-5">
        
                        <h6 class="mb-0">Group Name</h6>
        
                      </div>
                      <div class="col-md-9">
                        <input type="text" class="form-control form-control-lg" name="group_name" required/>
                      </div>
                    </div>
                    <hr class="mx-n3">
                    <div class="row align-items-center pt-4 pb-3">
                      <div class="col-md-3 ps-5">
        
                        <h6 class="mb-0">Group BG Img</h6>
        
                      </div>
                      <div class="col-md-9">    
                        <input type="file" class="form-control form-control-lg" name="group_bg" required/>
                      </div>
                    </div>
        
                    <hr class="mx-n3">
        
                    <div class="px-5 py-4">
                      <button type="submit" class="btn btn-primary px-5" name="create_group">Create Group</button>
                    </div>
        
                  </div>
                </div>
            </form>
    
          </div>
        </div>
      </div>
    </section>
      </div>
    </div>
</body>
</html>


<?php 
include('../assets/admintemplate/footer.php');
?>