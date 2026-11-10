<?php
session_start();

require_once(__DIR__ . '/../function/activity.php');
require_once(__DIR__ . '/../function/auth.php');
require_once(__DIR__ . '/../function/redirect.php');
require_once(__DIR__ . '/../function/session.php');
require_once(__DIR__ . '/../function/csrf.php');
require_once(__DIR__ . '/../function/csv.php');
// define('','');
define('BASE_URL', 'http://localhost/IT3B/');
define('DB_HOST','localhost');
define('DB_NAME','B_lab_db');
define('DB_USER','root');
define('DB_PASS','');

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