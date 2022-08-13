<?php
session_start();
include('../assets/modules/database-connection.php');

if(isset($_SESSION['delete'])){
// Deleting user
$user = $con -> prepare('delete from users where useremail = ?');
$user->bindParam(1, $_SESSION['user_email']);
$user->execute();

// Deleting Uploads
$upload = $con -> prepare('delete from uploads where uploaduser = ?');
$upload -> bindParam(1, $_SESSION['user_email']);
$upload -> execute();

// Location
header('location: ./accountdeleted.php');
} else{
session_unset();
session_destroy();
// header('location: ../registration/login.php');
}






?>