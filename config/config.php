<?php
session_start();

require_once(__DIR__ . '/../function/activity.php');
require_once(__DIR__ . '/../function/auth.php');
require_once(__DIR__ . '/../function/redirect.php');
require_once(__DIR__ . '/../function/session.php');
// define('','');
define('BASE_URL', 'http://localhost/IT34_jay/IT34B');
define('DB_HOST','localhost');
define('DB_NAME','b_lab_1');
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