<?php
session_start();
use function Safe\mysql_num_rows;
$conn=mysqli_connect('localhost','root','','drawing_project');
if(isset($_POST['username']) && isset($_POST['password']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    if(empty($username)){
        header("Location:login.php?error=Username is require");
        exit();
    }
    else if(empty($password)){
        header("Location:login.php?error=Password is require");
        exit();
    }
    else{
        $sql="Select * FROM users WHERE username='$username' AND password='$password' ";
        $result=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)===1){
            $row=mysqli_fetch_assoc($result);
            if($row['username']===$username && $row['password']===$password){
                header("Location:Artist.html");
                exit();
            }
            else{
                header("Location:login.php?error=Username or Password is incorrect");
                exit();
            }
        }
        else{
            header("Location:login.php?error=Username or Password is incorrect");
            exit();
        }
    }
}
else{
    header("Location:login.php");
    exit();
}
