<?php
include('./assets/template/header.php');
?>


		<div class="wrapper d-flex align-items-stretch vh-100">
			<nav class="h-100" id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 ">
		  		<h1><a href="./index.php" class="logo">JustEntry </a></h1>
	        <ul class="list-unstyled components mb-5 mt-5">
	          <li class="active">
	            <a href="./index.php" class="mt-3"><span class="fa fa-home mr-3"></span>DashBoard</a>
	          </li>
	          <li>
	              <a href="./upload.php" class="mt-3"><span class="fa fa-solid fa-upload mr-3"></span> Upload</a>
	          </li>
	          <li>
              <a href="./registration/logout.php" class="mt-3"><span class="fa fa-solid fa-arrow-right-from-bracket mr-3"></span>LogOut</a>
	          </li>
	        </ul>

            <div class="footer">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserveThis template is made <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorcom" target="_blank">Colorlib.com</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>
	       

	      </div>
    	</nav>



            <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">Welcome</h2>
      </div>


		</div>


<?php
    include('./assets/template/footer.php');
?>