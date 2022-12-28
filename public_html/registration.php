<?php
  include_once '/includes/header.php';
	include_once '/includes/css/style.css';
?>
  
  <div>
    <?php
    if(isset($_POST['create'])){
      echo 'User submitted';
    }
    ?>
  </div>

  <div>
    <form action="registration.php" method="post">
      <div class="container">
        <h1>Registration</h1>
        <p>Please ensure all information is correct before submitting.</p>
        <label for="firstname"><b>First Name</b></label>
        <input type="text" name="firstname" required>

        <label for="lastname"><b>Last Name</b></label>
        <input type="text" name="lastname" required>

        <label for="email"><b>Email Address</b></label>
        <input type="email" name="email" required>

        <label for="phonenumber"><b>Phone Number</b></label>
        <input type="text" name="phonenumber" required>

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" required>

        <input type="submit" name="create" value="Sign Up">
  </div>
  
<?php
  include_once 'footer.php';
?>