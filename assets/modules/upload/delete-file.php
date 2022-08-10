<?php
    include('../database-connection.php');
    $fileId = $_GET['fileId'];
    $group = $_GET['group'];
    $sql = $con->prepare('delete from uploads where uploadid = ?');
    $sql->bindParam(1,$fileId);
    $sql-> execute();
    // header("location: ../upload.php");
?>
<script >
    window.location.replace("../upload.php?group=<?php echo $group; ?>");
</script>