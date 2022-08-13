<style>
body{
    position: relative;
}
#outPopUp {
    position: absolute;
    width: 300px;
    height: 200px;
    z-index: 15;
    top: 50%;
    left: 50%;
    margin: -100px 0 0 -150px;
    background: red;
}
</style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<?php 

if(isset($_POST)){
    header('location: ../registration/register.php');
}
echo '<form method="POST">';
echo '<div class="text-center">';
    echo '<p class="bg-success text-center text-white p-2 rounded-3">Your Account Has Been Deleted!</p>';
    echo '<button class="btn btn-primary text-center px-5" name="register">Register</button>';
echo '</div>';
echo '</form>'

?>