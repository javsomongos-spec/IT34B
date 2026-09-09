<?php
require_once 'config.php';

if(isset($_SESSION['user_id'])){
    header('location' . BASE_URL .  '/app/' . $_SESSION['user_role'] . '/index.php');
    exit;
}

$error='';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $login = TRIM($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';


   if(loginUser($pdo,$login,$password)){
     echo'location:' .BASE_URL  .  '/app/' . $_SESSION['user_role'] . '/index.php';
    header('location:' . BASE_URL .  '/app/' . $_SESSION['user_role'] . '/index.php');
    exit;
}

    $error = 'Invalid login credentials';
}

?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method = "POST">
     <label> Username or Email</label>
     <input type = "test"
             name= "login"
             required

   >form=method = "POST">
       <label>Username or Email</label>
       <input type="test"
           name="login"
           required>
    <br>
    <button type="submit">Sign In</button>/button>
    </form>

    
</body>
</html>