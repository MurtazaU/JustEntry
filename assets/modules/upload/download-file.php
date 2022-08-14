<?php 

$filename = $_GET['filename'];

header("Content-type: application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document");

header("Content-Disposition: attachment; filename=$filename");

readfile("../../../upload-files/$filename");

?>