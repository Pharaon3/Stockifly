<?php

$sname = "localhost";
$uname = "zscplszw_TOL";
$password = "!@Maya2996";

$db_name = "zscplszw_TOL";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if(!$conn){
    echo "Connection failed!";
    exit();
}