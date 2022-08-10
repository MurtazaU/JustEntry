<?php
session_start();
include('./database-connection.php');
$group_name = $_GET['name'];
$sql = $con->prepare("update users set groupnameid = 1 where useremail = ?");
$sql->bindParam(1, $_SESSION['user_email']);
$sql->execute();
header('location: ../../index.php');


?>