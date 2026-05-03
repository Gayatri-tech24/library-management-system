<?php
include "../config/db.php";
session_start();
if ($_SERVER['REQUEST_METHOD']=='POST')
    {
        $name=$_POST['name'];
        $usn=$_POST['usn'];
        $sql="select * from student where usn='$usn' and name='$name'";
        $result=mysqli_query($conn,$sql);
    
    if ( $result->num_rows==1)
        {
            $user=$result->fetch_assoc();
            $_SESSION['usn'] = $user['usn'];
            $_SESSION['name'] = $user['name'];
           header("Location: ../frontend/dashboard.php");
            exit(); 
        } 
        else 
        {
            $error = "Invalid USN or Name.";
        }
    } 
?>