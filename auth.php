<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'xwdf265k6h';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(mysqli_connect_error()) {
    die('Connection Error');
}
