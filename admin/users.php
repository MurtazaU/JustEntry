<?php 
include('../assets/admintemplate/header.php');
include('../assets/modules/database-connection.php');

// Users
$usersql = $con->prepare('select * from users');
$usersql -> execute();
$usercount = $usersql->rowCount();
$userrecord = $usersql -> fetchAll(PDO::FETCH_OBJ);

// New Users
$date = date('Y-m-d');
$newusersql = $con->prepare('select * from users where registrationdate = ?');
$newusersql-> bindParam(1, $date);
$newusersql -> execute();
$newusercount = $newusersql->rowCount();

if(isset($_POST['user_delete'])){

}

?>

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
                <li class="active ">
                    <a href="./users.php" class="mt-3"><span class="fa fa-solid fa-user mr-3"></span>Users</a>
                </li>
                <li>
                    <a href="./uploads.php" class="mt-3"><span class="fa-solid fa-upload mr-3"></span>Uploads</a>
                </li>
                <li>
                    <a href="./groups.php" class="mt-3"><span class="fa fa-solid fa-people-group mr-3"></span>Groups</a>
                </li>
                <li>
                    <a href="./newgroup.php" class="mt-3"><span class="fa fa-solid fa-circle-plus mr-3"></span>New Group</a>
                </li>
                <li>
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
        <h2 class="mb-4">View Users</h2>
       <div class="container-fluid">

    <!-- Total Analytics -->

    <div class="row">
      <div class="col-md-6 col-lg-6 col-sm-12">
 <div class="row">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase text-center">Total Users:</h5>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12 col-sm-12 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div>
                <h3 class="text-success"> <?php echo $usercount; ?> </h3>
                <p class="mb-0">Users</p>
              </div>
              <div class="align-self-center">
                <i class="far fa-user text-success fa-3x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

</div>
      </div>

      <div class="col-md-6 col-lg-6 col-sm-12">
 <div class="row">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase text-center">New Users:</h5>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12 col-sm-12 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div>
                <h3 class="text-success"><i class="fa-solid fa-plus"></i> <?php echo $newusercount; ?> </h3>
                <p class="mb-0">New Users</p>
              </div>
              <div class="align-self-center">
                <i class="far fa-user text-success fa-3x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

</div>
      </div>
   
    </div>



<!-- User Table -->
 <div class="row">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase text-center">Total Users:</h5>
      </div>
    </div>

<table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Email</th>
      <th>Password</th>
      <th>Registration Date</th>
      <th>Edit Account Date</th>
      <th>Status</th>
      <th>Group</th>
      <th>Group Joining Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach($userrecord as $row){
        ?>
 <tr>
      <td>
            <p class="fw-bold mb-1"><?php echo $row->userid; ?></p>
      </td>
      <td>
            <p class="mb-1"><?php echo $row->username; ?></p>
      </td>
      <td>
            <p class=" mb-1"><?php echo $row->useremail; ?></p>
      </td>
      <td>
        <p class=" mb-1 "><?php echo $row->userpassword; ?></p>
      </td>
      <td>
        <p class=" mb-1 "><?php echo $row->registrationdate; ?></p>
      </td>
      <td>
        <p class=" mb-1 "><?php echo $row->editaccount; ?></p>
      </td>
      <td>
        <p class=" mb-1 "><?php echo $row->status; ?></p>
      </td>
      <td>
        <?php 
        // Groups Joined Data
        $groupsql = $con -> prepare('select groupname from groups where groupid = ?');
        $groupsql -> bindParam(1, $row->groupnameid);
        $groupsql->execute();
        $grouprecord = $groupsql->fetchAll(PDO::FETCH_OBJ);
        foreach($grouprecord as $group){
          ?>
            <p class=" mb-1 "><?php echo $group->groupname; ?></p>
          <?php
        }
        ?>
      </td>
      <td>
            <p class=" mb-1 "><?php echo $row->groupdatetime; ?></p>
      </td>
      <td>
        <a href="./deleteuser.php?email=<?php echo $row->useremail ?>">
          <button class="btn btn-warning" type="submit" name="delete_user">
            <p class=" mb-1 text-center "><i class="fa-solid fa-ban text-danger font-lg"></i></p>
          </button>
        </a>
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


<?php 
include('../assets/admintemplate/footer.php');

?>