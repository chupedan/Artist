<?php
$conn=mysqli_connect('localhost','root','','drawing_project');
if(isset($_POST['username']) && isset($_POST['psw']) && isset($_POST['rpsw'])){
    //neu nguoi dung nhap day du thong tin thi se cho cac bien toan cuc lay data da nhap
    $username=$_POST['username'];
    $psw=$_POST['psw'];
    $rpsw=$_POST['rpsw'];
    if(empty($username)){//neu nguoi dung chua nhap Username
        header("Location:SignUp.php?error=Username is require");
        exit();
    }
    else if(empty($psw)){//neu nguoi dung chua nhap Password
        header("Location:SignUp.php?error=Password is require");
        exit();
    }
    else if(empty($rpsw)){//neu nguoi dung chua nhap Repeat Password
        header("Location:SignUp.php?error=Repeat Password is require");
        exit();
    }
    else{
        $user_check_query = "SELECT * From users WHERE username='$username' LIMIT 1";//set bien username chi co 1
        $result = mysqli_query($conn, $user_check_query);
        $User = mysqli_fetch_assoc($result);
        if ($psw != $rpsw) {//kiem tra xem 2 mat khau nhap vao co giong nhau khong
            header("Location:SignUp.php?error=The two Password do not match");
            exit();
        }
        else if($User) { // if user exists
            if ($User['username'] === $username) {
                header("Location:SignUp.php?error=The Username is already exists");
                exit();
            }
        }
        //nhap du lieu vao database
        else{ $query = "INSERT INTO users (username, password)
            VALUES('$username','$psw')";
            mysqli_query($conn, $query);
            header("location:Login.php");
            exit();
            }    
    }
}
else{
    header("Location:SignUp.php");
    exit();
}