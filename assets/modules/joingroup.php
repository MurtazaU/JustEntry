<?php
session_start();
include('./database-connection.php');
$group_id = $_GET['id'];
$sql = $con->prepare("update users set groupnameid = ? where useremail = ?");
$sql->bindParam(1, $group_id);
$sql->bindParam(2, $_SESSION['user_email']);
$sql->execute();


$time = date("Y-m-d:h:i:s");
$email = $_SESSION['user_email'];

$query = $con->prepare("update users set groupdatetime = ? where useremail = ?");
$query->bindParam(1,$time);
$query -> bindParam( 2 , $_SESSION['user_email'] );
$query->execute();

header('location: ../../index.php');


?>