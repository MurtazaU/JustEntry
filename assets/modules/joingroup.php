<?php
session_start();
include('./database-connection.php');
$group_name = $_GET['name'];
$sql = $con->prepare("update users set $group_name = 1 where useremail = ?");
$sql->bindParam(1, $_SESSION['user_email']);
$sql->execute();
setcookie($group_name, $group_name, time() + (86400 * 30), "/"); // 86400 = 1 day
header('location: ../../index.php');


?>