<?php
require_once('config.php');

if(isset($_POST)){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];

    // Perform server-side validation
    $errors = array();

    if(empty($firstname)){
        $errors[] = "First name is required";
    }

    if(empty($lastname)){
        $errors[] = "Last name is required";
    }

    if(empty($email)){
        $errors[] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if(empty($phonenumber)){
        $errors[] = "Phone number is required";
    } else if (!preg_match("/^[0-9]{10}$/", $phonenumber)) {
        $errors[] = "Invalid phone number format";
    }

    if(empty($password)){
        $errors[] = "Password is required";
    } else if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    if (count($errors) > 0) {
        // If there are errors, display them to the user
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    } else {
        // Hash the password using Argon2
        $hashed_password = password_hash($password, PASSWORD_ARGON2I);

        // Insert the user into the database
        $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, password ) VALUES(?,?,?,?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$firstname, $lastname, $email, $phonenumber, $hashed_password]);
        if($result){
            echo 'Thank you for signing up!.';
        }else{
            echo 'There was an error while registering.';
        }
    }
} else {
    echo 'No data';
}

function validateInput($input){
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}