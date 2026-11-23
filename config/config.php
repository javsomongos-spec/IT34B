<?php
session_start();

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../function/activity.php');
require_once(__DIR__ . '/../function/auth.php');
require_once(__DIR__ . '/../function/redirect.php');
require_once(__DIR__ . '/../function/session.php');
require_once(__DIR__ . '/../function/csrf.php');
require_once(__DIR__ . '/../function/csv.php');

require_once(__DIR__ . '/../vendor/autoload.php');
$dotenV = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenV->load();

define('DB_HOST', $_ENV['DB_HOST'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? '');
define('DB_USER', $_ENV['DB_USER'] ?? '');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');

// define('','');
define('BASE_URL', 'http://localhost/IT34B-1/');



try{
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
   
}catch(PDOException $e){
    die("Connection failed: " . $e->getMessage());
    
}
?>