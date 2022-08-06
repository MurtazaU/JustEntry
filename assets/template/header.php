<?php 
session_start();
if(!isset($_SESSION['user_email'])){
    header('location: ./registration/login.php');
}
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Just Entry</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="./assets/CSS/sidebar.css">
        <script src="https://kit.fontawesome.com/e1a5a5ef59.js" crossorigin="anonymous"></script>

  </head>
  <body>
