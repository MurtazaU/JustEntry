<?php 
include('../assets/admintemplate/header.php');
include('../assets/modules/database-connection.php');

// Users
$usersql = $con->prepare('select * from users');
$usersql -> execute();
$usercount = $usersql->rowCount();
$userrecord = $usersql -> fetchAll(PDO::FETCH_OBJ);


// Uploads
$uploadsql = $con->prepare('select * from uploads');
$uploadsql -> execute();
$uploadcount = $uploadsql->rowCount();

// Groups
$groupssql = $con->prepare('select * from groups');
$groupssql -> execute();
$groupscount = $groupssql->rowCount();
$groupsrecord = $groupssql -> fetchAll(PDO::FETCH_OBJ);

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
                <li class="active ">
                    <a href="./adminpanel.php" class="mt-3"><span class="fa fa-home mr-3"></span>Main Panel</a>
                </li>
                <li>
                    <a href="./users.php" class="mt-3"><span class="fa fa-solid fa-user mr-3"></span>Users</a>
                </li>
                <li>
                    <a href="./users.php" class="mt-3"><span class="fa fa-solid fa-people-group mr-3"></span>Groups</a>
                </li>
                <li>
                    <a href="./users.php" class="mt-3"><span class="fa fa-solid fa-circle-plus mr-3"></span>New Group</a>
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
                    </script> All rights reserved | This template is made <i class="icon-heart" aria-hidden="true"></i>
                    by <a href="https://colorcom" target="_blank">Colorlib.com</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>


        </div>
    </nav>



    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">Welcome <?php echo $_SESSION['admin_email']; ?></h2>
       <div class="container-fluid">
  <section>


    <!-- Total Analytics -->

    <div class="row">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase text-center">Total Analytics:</h5>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-4 col-sm-6 col-12 mb-4">
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
       <div class="col-xl-4 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div>
                <h3 class="text-danger"><?php echo $uploadcount; ?></h3>
                <p class="mb-0">Uploads</p>
              </div>
              <div class="align-self-center">
                <i class="fa fa-solid fa-upload text-danger fa-3x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div>
                <h3 class="text-warning"> <?php echo $groupscount; ?></h3>
                <p class="mb-0">Groups</p>
              </div>
              <div class="align-self-center">
                <i class="fa fa-solid fa-user-group text-warning fa-3x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

  </section>
</div>

<!-- User Table -->
 <div class="row">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase text-center">Users:</h5>
      </div>
    </div>

<table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>User Id</th>
      <th>User Name</th>
      <th>User Email</th>
      <th>User Password</th>
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
     
    </tr>
        <?php
    }
    ?>
  </tbody>
</table>
  <div class="row">
    <div class="col-12  mb-3 mt-1">
        <button class="btn btn-primary form-control" onclick="location.href='./users.php'">
            <h5 class="text-white text-center">More <i class="fa-solid fa-arrow-right-long"></i></h5>
        </button>
    </div>
  </div>

  <!-- Groups Table -->

 <div class="row">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase text-center">Groups:</h5>
      </div>
    </div>

<table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>Group Id</th>
      <th>Group Name</th>
      <th class="text-center">Total Users</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <div class="d-flex align-items-center">
          <img
            src="https://wellbeingchirony.com/wp-content/uploads/2021/03/Deafult-Profile-Pitcher.png"
              style="width: 45px; height: 45px"
              class="rounded-circle"
              />
          <div class="ms-3">
            <p class="fw-bold mb-1">Maths</p>
          </div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-1 text-center">256</p>
      </td>
      <td>
        <p class="fw-normal mb-1 text-center">256</p>
      </td>
     
    </tr>
   
   
  </tbody>

</table>
  <div class="row">
    <div class="col-12  mb-3 mt-1">
        <button class="btn btn-primary form-control" onclick="location.href='./groups.php'">
            <h5 class="text-white text-center">More <i class="fa-solid fa-arrow-right-long"></i></h5>
        </button>
    </div>
  </div>
</div>
                </div>


<?php 
include('../assets/admintemplate/footer.php');

?>