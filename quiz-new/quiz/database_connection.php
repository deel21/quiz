<?php

$con = mysqli_connect('localhost','root','quiz_db');
if(mysqli_connect_error())
{
    die('خطأ: فشل الاتصال بقاعدة البيانات');
}