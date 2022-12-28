<?php
	include_once 'includes/header.php';
	include_once 'css/style.css';
?>
<body>
<?php
    include_once 'includes/nav.php';
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
        <div class="row">
          <div class="col-sm-3">
            <h1>Registration</h1>
            <p>Please ensure all information is correct before submitting.</p>
            <label for="firstname"><b>First Name</b></label>
            <input class="form-control" type="text" name="firstname" required>

            <label for="lastname"><b>Last Name</b></label>
            <input class="form-control" type="text" name="lastname" required>

            <label for="email"><b>Email Address</b></label>
            <input class="form-control" type="email" name="email" required>

            <label for="phonenumber"><b>Phone Number</b></label>
            <input class="form-control" type="text" name="phonenumber" required>

            <label for="password"><b>Password</b></label>
            <input class="form-control" type="password" name="password" required>

            <input class="form-control" type="submit" name="create" value="Sign Up">
          </div>
        </div>
      </div>
    </form>
  </div>
</body> 
<?php
  include_once 'includes/footer.php';
?>