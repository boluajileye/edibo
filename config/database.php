<?php
 DEFINE('host', 'localhost');
 DEFINE('user', 'root');
 DEFINE('password', '');
 DEFINE('dbname', 'edibo');


$dbconnect = new mysqli(host, user, password, dbname);
if($dbconnect->connect_error){
    die('Connection failed ' .$dbconnect->connect_error);
}
?>