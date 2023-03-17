<?php
	include_once 'includes/header.php';
  	require_once('useraccounts/config.php');

  $errors = array();

  if (isset($_POST['create'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];

    // Validate firstname
    if (empty($firstname)) {
      $errors[] = "First name is required";
    } else if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
      $errors[] = "Invalid first name format";
    }

    // Validate lastname
    if (empty($lastname)) {
      $errors[] = "Last name is required";
    } else if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
      $errors[] = "Invalid last name format";
    }

    // Validate email
    if (empty($email)) {
      $errors[] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email format";
    }

    // Validate phonenumber
    if (!empty($phonenumber) && !preg_match("/^[0-9]{10}$/", $phonenumber)) {
      $errors[] = "Invalid phone number format";
    }

    // Validate password
    if (empty($password)) {
      $errors[] = "Password is required";
    } else if (strlen($password) < 8) {
      $errors[] = "Password must be at least 8 characters long";
    }

    if (empty($errors)) {

      // Add user to database
      $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, password) VALUES (?, ?, ?, ?, ?)";
      $stmt = $db->prepare($sql);
      $result = $stmt->execute([$firstname, $lastname, $email, $phonenumber, $password]);

      if ($result) {
        echo "<script>
                Swal.fire({
                  'title': 'Successful',
                  'text': 'User registered successfully',
                  'type': 'success'
                });
              </script>";
      } else {
        $errors[] = "Failed to add user to database";
      }

    }

  }

?>
<body>
<?php
  include_once 'includes/nav.php';
?>
<section>
  <div>
    <form id="registration-form" action="registration.php" method="post">
      <div class="container">
        <div class="row mt-5 mb-5">
          <div class="col-sm-3 mx-auto">
            <h1>Sign Up</h1>
            <p>Please ensure all information is correct before submitting.</p>
            <hr class="mb-3">
            <label for="firstname"><b>First Name</b><b style="color: red;"> *</b></label>
            <input class="form-control" id="firstname" type="text" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>" required>
            <?php if (in_array("First name is required", $errors)) echo "<p class='text-danger'>First name is required</p>"; ?>
            <?php if (in_array("Invalid first name format", $errors)) echo "<p class='text-danger'>Invalid first name format</p>"; ?>

            <label for="lastname"><b>Last Name</b><b style="color: red;"> *</b></label>
			<input class="form-control" id="lastname" type="text" name="lastname" value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>" required>
			<?php if (isset($errors['lastname'])) { ?>
    		<div class="alert alert-danger"><?php echo $errors['lastname']; ?></div>
			<?php } ?>


			<label for="email"><b>Email Address</b><b style="color: red;"> *</b></label>
			<input class="form-control" id="email" type="email" name="email" required>
			<?php if(isset($error['email'])) { ?>
  			<div class="alert alert-danger"><?php echo $error['email']; ?></div>
			<?php } ?>

			<label for="phonenumber"><b>Phone Number</b><b class="text-muted"> (Optional)</b></label>
			<input class="form-control" id="phonenumber" type="text" name="phonenumber">
			<?php
			if (isset($_POST['phonenumber'])) {
  				$phonenumber = $_POST['phonenumber'];
  				if (!preg_match("/^[0-9]{10}$/", $phonenumber)) {
    			$error['phonenumber'] = "Invalid phone number. Please enter a 10-digit phone number.";
  					}
			}
			if (isset($error['phonenumber'])) {
  				echo '<div class="alert alert-danger">' . $error['phonenumber'] . '</div>';
			}
			?>

			<label for="password"><b>Password</b><b style="color: red;"> *</b></label>
			<input class="form-control" id="password" type="password" name="password" required>
			<?php if(isset($error['password'])) { ?>
    			<div class="alert alert-danger"><?php echo $error['password']; ?></div>
			<?php } ?>
			<hr class="mb-3">
			<input class="btn btn-primary" type="submit" id="register" name="create" value="Sign Up" onclick="submitForm()">
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
	$(function(){
		$('#register').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){
			var firstname 	= $('#firstname').val();
			var lastname	  = $('#lastname').val();
			var email 		  = $('#email').val();
			var phonenumber = $('#phonenumber').val();
			var password 	  = $('#password').val();
				
        e.preventDefault();	
				$.ajax({
					type: 'POST',
					url: 'useraccounts/process.php',
					data: {firstname: firstname,lastname: lastname,email: email,phonenumber: phonenumber,password: password},
					success: function(data){
					Swal.fire({
								'title': 'Successful',
								'text': data,
								'type': 'success'
								})							
					},
					error: function(data){
						Swal.fire({
								'title': 'Errors',
								'text': 'There were errors while saving the data.',
								'type': 'error'
								})
					}
				});				
			}else{				
			}
		});		
	});	
</script>
<script type="text/javascript">
  function submitForm() {
    var form = document.getElementById('registration-form');
    form.submit();
  }
</script>
</body> 
<?php
  include_once 'includes/footer.php';
?>