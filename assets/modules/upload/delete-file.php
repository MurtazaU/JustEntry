<?php
    include('../database-connection.php');
    $fileId = $_GET['fileId'];
    $sql = $con->prepare('delete from uploads where uploadid = ?');
    $sql->bindParam(1,$fileId);
    $sql-> execute();
    header('location: ../../../index.php');
?>