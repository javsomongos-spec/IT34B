<?php
require_once 'config/config.php';
require_once 'config/function.php';

if (isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if (loginUser($pdo, $login, $password)) {
        header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
        exit;
    }

    $error = 'Invalid login credentials';

    if ( $login ==='' || $password === '' ){

    logActivity($pdo,null,$login,'login','failed);
    } else { 
          if(logInUser($pdo,$login,password){
       echo 'location: '. BASE_URL . '/app/' . ' $_SESSION["user_role"]. '/index.php';
       header(location: ' . BASE_URL . '/app/') . $SESSION[user_role'] . '/index.php');
         exit;
    }
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<h1>Sign In</h1>

<?php if ($error): ?>
    <p><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST">

    <label>Username or Email</label>
    <input type="text" name="login" required>

    <br><br>

    <label>Password</label>
    <input type="password" name="password" required>

    <br><br>

    <button type="submit">Sign In</button>

</form>

</body>
</html>