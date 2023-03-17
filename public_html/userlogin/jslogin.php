<?php
session_start();
require_once('config.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
$stmtselect = $db->prepare($sql);
$result = $stmtselect->execute([$username]);

if($result){
    $user = $stmtselect->fetch(PDO::FETCH_ASSOC);
    if($stmtselect->rowCount() > 0){
        if(password_verify($password, $user['password'])){
            $_SESSION['userlogin'] = $user;
            echo '1';
        } else {
            echo 'Incorrect username or password.';
        }
    } else {
        echo 'Incorrect username or password.';
    }
} else {
    echo 'Could not connect to database.';
}