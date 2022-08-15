<?php 
session_start();
include('../assets/modules/database-connection.php');
if(!isset($_SESSION['admin_email'])){
  header('location: ./login/adminlogin.php');
}

$user = $_GET['email'];

$sql = $con -> prepare('delete from users where useremail = ?');
$sql -> bindParam(1, $user);
$sql -> execute();

$query = $con -> prepare('delete from uploads where uploaduser = ?');
$query->bindParam(1, $user);
$query -> execute();

header('location: ./users.php');

?>