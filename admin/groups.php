<?php 
include('../assets/admintemplate/header.php');
include('../assets/modules/database-connection.php');

// Groups
$groupssql = $con->prepare('select * from groups');
$groupssql -> execute();
$groupscount = $groupssql->rowCount();
$record = $groupssql -> fetchAll(PDO::FETCH_OBJ);

// New Groups
$date = date('Y-m-d');
$newgroupssql = $con->prepare('select * from groups where groupregistrationdate = ?');
$newgroupssql-> bindParam(1, $date);
$newgroupssql -> execute();
$newgroupscount = $newgroupssql->rowCount();
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
                <li>
                    <a href="./users.php" class="mt-3"><span class="fa fa-solid fa-user mr-3"></span>Users</a>
                </li>
                <li class="active ">
                    <a href="./groups.php" class="mt-3"><span class="fa fa-solid fa-people-group mr-3"></span>Groups</a>
                </li>
                <li>
                    <a href="./users.php" class="mt-3"><span class="fa fa-solid fa-circle-plus mr-3"></span>New Group</a>
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
                    </script> Copyright© 2022 All rights reserved. Powdered by justEntry| Developed by <a href="https://maszamtech.com" target="_blank">Maszam Technologies</a> | Template
                    by <a href="https://colorlib.ccom" target="_blank">Colorlib.com</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>


        </div>
    </nav>



    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">View Groups</h2>
       <div class="container-fluid">

    <!-- Total Analytics -->

    <div class="row">
      <div class="col-md-6 col-lg-6 col-sm-12">
 <div class="row">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase text-center">Total Groups:</h5>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12 col-sm-12 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div>
                <h3 class="text-warning"> <?php echo $groupscount; ?> </h3>
                <p class="mb-0">Groups</p>
              </div>
              <div class="align-self-center">
                <i class="fa fa-solid fa-user-group text-warning fa-3x"></i>
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
        <h5 class="text-uppercase text-center">New Groups:</h5>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12 col-sm-12 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div>
                <h3 class="text-warning"><i class="fa-solid fa-plus"></i> <?php echo $newgroupscount; ?> </h3>
                <p class="mb-0">New Groups</p>
              </div>
              <div class="align-self-center">
                <i class="fa fa-solid fa-user-group text-warning fa-3x"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

</div>
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
      <th>Group Grade</th>
      <th>Group Desc</th>
    </tr>
  </thead>
  <tbody>
        <?php 
    foreach($record as $row){
        ?>
    <tr>
      <td>
        <p class="fw-bold mb-1"> <?php echo $row->groupid; ?> </p>
      </td>
      <td>
        <p class="fw-normal mb-1 "><?php echo $row->groupname; ?></p>
      </td>
      <td>
        <p class="fw-normal mb-1 "><?php echo $row->groupgrade; ?></p>
      </td>
      <td>
        <p class="fw-normal mb-1 "><?php echo $row->groupdesc; ?></p>
      </td>
     
    </tr>
   <?php } ?>
   
  </tbody>

</table>


    </div>
  </div>
</div>


<?php 
include('../assets/admintemplate/footer.php');

?>