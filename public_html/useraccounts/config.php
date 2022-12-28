<?php

$db_user = "okovalski_owen-kovalski";
$db_pass = "EH#^!7oN#sRy9g*8";
$db_name = "okovalski_owen-kovalski.com";

$db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);