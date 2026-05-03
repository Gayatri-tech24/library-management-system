<?php
include "../config/db.php";
if ($_SERVER['REQUEST_METHOD']=="POST")
    {
        $name=$_POST['name'];
        $usn=$_POST['usn'];
        $class=$_POST['class'];
        $branch=$_POST['branch'];
        $year=$_POST['year'];
        $email=$_POST['email'];
        $sql="insert into student (usn,name,class,branch,year,email) values ('$usn','$name','$class','$branch','$year','$email')";
        $result=mysqli_query($conn,$sql);
        if (! $result)
            {
                echo "Oops!!".mysqli_error($conn);
            }
        else{
                echo"You have registered!";
            }
    }
?>
