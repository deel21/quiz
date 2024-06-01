<?php
     require_once 'functions.php';
	 if(! GetPageRequest() )
     {
        $done = AddUser($_POST['name'],$_POST['username'],$_POST['password']);
        if($done)
        {
          Login();    
        }
        else
        {
          echo'<script>alert("البريد الالكتروني الذي ادخلته مستخدم من قبل مستخدم اخر");</script>';
        }
	 }
	?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="loginStyle.css">
</head>

<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form method="post" class="login" id="login-form">
                    
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" name="name" class="login__input" id="name" placeholder="Full name / Email">
                    </div>
                    
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" name="username" class="login__input" id="username" placeholder="User name / Email">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" name="password" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="button login__submit" onclick="login()">Create Account
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
                <div>
                    <a href="signin.php" >Already has account</a>
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