<?php

$server="localhost:3307";
$user="root";
$password="";
$dbname="library_db";
$conn=new mysqli($server,$user,$password,$dbname);
if (! $conn)
    {
        echo"OOps! cannot connect!! {$conn->connect_error}";

    }
    

?>