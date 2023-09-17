<?php
require_once '/home/okovalski/web/owen-kovalski.com/vendor/autoload.php';

use ParagonIE\Argon2Refiner\Hash;

function hashPassword($password) {
    $hasher = Hash::argon2id();
    $password_hash = $hasher->hash($password);
    $salt = $hasher->getSalt();
    
    return array('password_hash' => $password_hash, 'salt' => $salt);
}
?>
