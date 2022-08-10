<?php
include('./assets/template/header.php');
include('./assets/modules/database-connection.php');


?>
<link rel="stylesheet" href="./assets/CSS/home.css">


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
                    <a href="./index.php" class="mt-3"><span class="fa fa-home mr-3"></span>DashBoard</a>
                </li>
                <li>
                    <a href="./account/account.php" class="mt-3"><span class="fa fa-solid fa-user mr-3"></span>Account</a>
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
                    <a href="./registration/logout.php" class="mt-3"><span
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
        <h2 class="mb-4">Welcome</h2>
        <section>
            <div class="container">
                <div class="row">
                    <div class="text-center mb-5">
                        <h1 class="display-4">View Groups</h1>
                        <h5>You Can Only Join A Single Group At Once</h5>
                    </div>
                </div>
                <div class="row">
                    <?php 
                    $sql = $con->prepare('select * from groups limit 1,1000');
                    $sql -> execute();
                    $record = $sql -> fetchAll(PDO::FETCH_OBJ);
                    foreach($record as $row){
                      ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <form method="GET">
                            <div class="card text-white card-has-bg "
                                style="background-image:url('<?php echo $row->groupbgimg; ?>');">
                                <div class="card-img-overlay d-flex flex-column">
                                    <div class="card-body">
                                        <small class="card-meta mb-2 text-success">Grade:
                                            <?php echo $row->groupgrade; ?></small>
                                        <h4 class="card-title mt-0 "><a
                                                class="text-white"><?php echo $row->groupname; ?></a></h4>
                                    </div>
                                    <div class="card-footer">
                                        <div class="media">
                                            <?php
                                            $query = $con -> prepare("select * from users where groupnameid = ? && useremail = ?");
                                            $query->bindParam(1, $row->group_name);
                                            $query->bindParam(2, $_SESSION['user_email']);
                                            $query -> execute();
                                            $count = $query->rowCount();

                                            $sql = $con -> prepare("select groupnameid from users");
                                            $sql -> execute();
                                            $group_name_id = $sql -> fetchAll(PDO::FETCH_OBJ);
                                            foreach($group_name_id as $group_name){
                                            if($row->groupid != $group_name->groupnameid){
                                              ?>
                                            <button type="submit" name="join_group"
                                                class="btn btn-primary mb-3 mx-1 form-control col-12" id="group_id">
                                                <a href='./assets/modules/joingroup.php?id=<?php echo $row->groupid; ?>'
                                                    class="text-white">Join
                                                    Group</a> </button>
                                            <?php
                                            } else{
                                            ?>
                                            <button type="submit" name="leave_group"
                                                class="btn btn-red mb-3 mx-1 form-control col-10" id="group_id">
                                                <a href='./assets/modules/leavegroup.php?name=<?php echo $row->groupname; ?>'
                                                    class="text-white">Leave Group</a> </button>

                                            <button type="button" 
                                                class="btn upload-btn mb-3 mx-1 form-control col-2" id="group_id"  name="upload_file">
                                                <a href="./assets/modules/upload.php?group=<?php echo $row->groupname;?>">
                                                 <span
                                                        class="mx-1 fa fa-solid fa-upload mr-3 text-white">
                                                 </span>
                                                 </a>
                                            </button>

                                            <?php
                                            }}?>
                                            



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    }
                    ?>

                </div>

            </div>



</section>
</div>
                </div>


<?php
    include('./assets/template/footer.php');
?>