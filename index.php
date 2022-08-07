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
                    <a href="./upload.php" class="mt-3"><span class="fa fa-solid fa-upload mr-3"></span> Upload</a>
                </li>
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
                        <h1 class="display-4">Join A Group</h1>
                    </div>
                </div>
                <div class="row">
                    <?php 
                    $sql = $con->prepare('select * from groups');
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
                                        <style>
                                        @media (max-width: 420px) {
                                            .group-desc {
                                                display: none;
                                            }
                                        }
                                        </style>
                                        <p class="card-title mt-0 text-white group-desc">
                                            <?php echo $row->groupdesc; ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="media">
                                            <script>
                                            function changeButton() {
                                                document.getElementById('group_id').value = "Leave Group"
                                            }
                                            </script>
                                            <button onclick="changeButton()" type="button" name="join_group"
                                                class="btn btn-primary mb-3 form-control" id="group_id">
                                                <a href='./assets/modules/joingroup.php?name=<?php echo $row->groupname; ?>'
                                                    class="text-white">Join
                                                    Group</a> </button>
                                        </div>
                                        <div class="media">
                                            <img class="mr-3 mt-2" src="<?php echo $row->groupteacherimg; ?>"
                                                alt="Teacher Picture" style="width:50px; height:35px;">
                                            <div class="media-body">
                                                <h6 class="my-3 text-white d-block"><?php echo $row->groupteacher; ?>
                                                </h6>
                                            </div>
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
    </div>
</div>


</section>



<?php
    include('./assets/template/footer.php');
?>