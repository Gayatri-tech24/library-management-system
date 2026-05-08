<?php

$server="127.0.0.1";
$user="root";
$password="";
$dbname="library_db";
$port=3307;
$conn=new mysqli($server,$user,$password,$dbname,$port);
if (! $conn)
    {
       die("Connection failed: ".mysqli_connect_error());

    }
    

?>