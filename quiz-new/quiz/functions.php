<?php

require_once 'database_connection.php';
session_start();


function RedirectToLogin()
{
    if(!IsUserLogin())
        header('Location: ./signin.php');
}

function RedirectIfNotAdmin()
{
    if(!IsUserLogin() and !isset($_SESSION['admin']))
    {
        header('Location: ./signin.php');
    }
}
function GetPageRequest()
{
    return $_SERVER['REQUEST_METHOD']=='GET';
}
function IsUserLogin()
{   
   return isset($_SESSION['login']) or isset($_COOKIE['remmeber_me']);
}

function CheckLogin($username,$password)
{
    global $con;
    $check = false;
    $sql = "select * from users where username = '$username' and password = '$password'";
    $result = mysqli_query($con,$sql);
    if( mysqli_num_rows($result) > 0)
    {

        $row = mysqli_fetch_array($result);
        $_SESSION["user_id"] = $row["id"];

        if($username == "admin@quiz.com")
        {
            $_SESSION["admin"] = "admin@quiz.com";
            $_SESSION["email"] = "admin@quiz.com";
        }
       
       return true;
    }
   
    return $check;
}

function Login()
{
    $_SESSION['login'] = true;
	if(isset($_POST['remember_me']))
        setcookie('login-for-weak', 'true', time() + (60*60*24*7), "/");

   
    
    header('Location: account.php?q=1');
}


function Logout()
{
    unset($_SESSION['login']);
    setcookie("login-for-weak", "", time() - 3600);
}

function AddUser($name,$username,$password)
{
    global $con;
    
    $sql = "select password from users where username = '$username'";
    $result = mysqli_query($con,$sql);
    if( mysqli_num_rows($result)>0)
    {
        return false;
    }
    
    $sql2 = "insert into users (name,username,password)values('$name','$username','$password')";
    mysqli_query($con,$sql2) or die('خطا متعلق بقاعة البيانات : فشل اضافة مستخدم جديد');
    $_SESSION["user_id"] = mysqli_insert_id($con);
    return true;
}

