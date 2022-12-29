<?php
require_once('config.php');

echo 'hello from jslogin.php';

$sql = "SELECT * FROM users";
$stmtselect = $db->prepare($sql);
$result = $stmtselect->execute([]);

if($result){
    echo 'Success';
}
else{
    echo 'Could not connect to database.';
}