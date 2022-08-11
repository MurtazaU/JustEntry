<?php 
include('../assets/modules/database-connection.php');

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $sql = $con -> prepare("update users SET status = 'active' where token = ?");
    $sql->bindParam(1, $token);

    $sql -> execute();

    if($sql){
        if(isset($_SESSION['message'])){
            $_SESSION['message'] = 'Account Activated!';
            header('location: ./login.php');
            session_unset();
            session_destroy();
        } else{
            $_SESSION['message'] = 'Please Log In To Continue';
            header('location: ./login.php');
        }
    } else{
            $_SESSION['message'] = 'Account Not Activated';
            header('location: ./registration.php');
        }
}
?>