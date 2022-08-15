<?php
session_start();
include('./database-connection.php');
$time = date("Y-m-d:h:i:s");
$group_id = $_GET['id'];
$sql = $con->prepare("update users set groupnameid = ?, groupdatetime = ? where useremail = ?");
$sql->bindParam(1, $group_id);
$sql->bindParam(2,$time);
$sql->bindParam(3, $_SESSION['user_email']);
$sql->execute();


// $email = $_SESSION['user_email'];

// $query = $con->prepare("update users set groupdatetime = ? where useremail = ?");
// $query->bindParam(1,$time);
// $query -> bindParam( 2 , $_SESSION['user_email'] );
// $query->execute();

header('location: ../../index.php');


?>