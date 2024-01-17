<?php
$host = "127.0.0.1";
$port = 3306;
$socket = "";
$user = "root";
$password = "";
$dbname = "saampapi";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
