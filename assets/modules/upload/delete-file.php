<?php
    include('../database-connection.php');
    $fileId = $_GET['fileId'];
    $group = $_GET['group'];
    $groupId = $_GET['groupid'];
    $sql = $con->prepare('delete from uploads where uploadid = ?');
    $sql->bindParam(1,$fileId);
    $sql-> execute();
?>
<script >
    window.location.replace("../upload.php?group=<?php echo $group; ?>&groupid=<?php echo $groupId ?>");
</script>