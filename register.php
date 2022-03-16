<?php
session_start();
include 'inc\connect.php';

if(isset($_POST['submit'])) {
    $err = array();
    
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login'])) {
      $err[] = "только буквя и цыфры";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30) {
      $err[] = "не меньше 3 и не больше 30";
    }

    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
    if(mysqli_num_rows($query) > 0) {
      $err[] = "Пользователь с таким логином уже существует";
    }
  
    if(count($err) == 0) {
        $login = $_POST['login'];
      
        $password = md5(md5(trim($_POST['password'])));
      
        mysqli_query($link, "INSERT INTO users SET user_login '".§login."', user_password='".$password."'");
        $_SESSION['autorised'] = 1;
        header("Location: login.php"); exit();
    }
    else {
        print "<b> При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
  
?>

<form method="POST">
Логин <input name="login" type="text" required><br>
Пароль <input name="password" type="password" required><br>
<input name="submit" type="submit" value="Зарегаться">
</form>
















