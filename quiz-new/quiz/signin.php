<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="loginStyle.css">
</head>
<?php
require_once 'functions.php';
	if(! GetPageRequest())
    {
		// if(isset($_POST['submit']) and $_POST['submit'] == 'login')
		{
			if(CheckLogin($_POST['username'],$_POST['password']))
			{
				Login();
                if(isset($_SESSION["admin"])){
                    header("Location: dash.php");
                exit;
                }
                header('Location: account.php?q=1');
			}else
			{
			echo'<script>alert("خطا:اسم المستخدم او كلمة المرور غير صحيح");</script>';
			}
		}
     
	
	 }
	?>

<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" method="post" id="login-form">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" name="username" id="username" placeholder="User name / Email">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" name="password" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="button login__submit" >Log In Now
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
                <div>
                    <a href="register.php" > New User</a>
                </div>
                <!-- <div class="social-login">
                    <h3>log in via</h3>
                    <div class="social-icons">
                        <a href="#" class="social-login__icon fab fa-instagram"></a>
                        <a href="#" class="social-login__icon fab fa-facebook"></a>
                        <a href="#" class="social-login__icon fab fa-twitter"></a>
                    </div>
                </div> -->
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>

  
</body>

</html>