<?php

$host = "localhost";
$dbname = "rgc";
$username = "root";
$password = "";

$dsn = "mysql:host=".$host.";dbname=".$dbname;
$conn = new PDO($dsn, $username, $password);

?>