<?php

// 4 Variables
$dbname = 'dbs8219573';
$host = "db5009695496.hosting-data.io";
$username = "dbu2803817";
$password = "h#37K_Vrk&!37";

try {
  $con = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>