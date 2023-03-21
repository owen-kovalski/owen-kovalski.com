<?php
include_once 'includes/header.php';
require_once 'useraccounts/config.php';
// require_once 'vendor/autoload.php';

use ParagonIE\PasswordLib\PasswordLib;

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
    $passwordlib = new PasswordLib();
    $password_hash = $passwordlib->createPasswordHash($password, PASSWORD_ARGON2ID);

    // Add user to database
    $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('sssss', $firstname, $lastname, $email, $phonenumber, $password_hash);
    $result = $stmt->execute();

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
            <?php if (in_array("Last name is required", $errors)) echo "<p class='text-danger'>Last name is required</p>"; ?>
            <?php if (in_array("Invalid last name format", $errors)) echo "<p class='text-danger'>Invalid last name format</p>"; ?>

            <label for="email"><b>Email Address</b><b style="color: red;"> *</b></label>
            <input class="form-control" id="email" type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
            <?php if (in_array("Email is required", $errors)) echo "<p class='text-danger'>Email is required</p>"; ?>
            <?php if (in_array("Invalid email format", $errors)) echo "<p class='text-danger'>Invalid email format</p>"; ?>

            <label for="phonenumber"><b>Phone Number</b><b class="text-muted"> (Optional)</b></label>
            <input class="form-control" id="phonenumber" type="tel" name="phonenumber" value="<?php echo isset($_POST['phonenumber']) ? $_POST['phonenumber'] : ''; ?>">
            <?php if (in_array("Invalid phone number format", $errors)) echo "<p class='text-danger'>Invalid phone number format</p>"; ?>

            <label for="password"><b>Password</b><b style="color: red;"> *</b></label>
            <input class="form-control" id="password" type="password" name="password" required>
            <?php if (in_array("Password is required", $errors)) echo "<p class='text-danger'>Password is required</p>"; ?>
            <?php if (in_array("Password must be at least 8 characters long", $errors)) echo "<p class='text-danger'>Password must be at least 8 characters long</p>"; ?>

            <button type="submit" class="btn btn-primary" name="create">Create Account</button>
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
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: 'useraccounts/process.php',
					data: $('#registration-form').serialize(),
					success: function(data){
            console.log(data); // Add this line to log the response from the server
						Swal.fire({
							title: 'Successful',
							text: data,
							type: 'success'
						});
						document.getElementById("registration-form").reset();
					},
					error: function(data){
            console.log(data); // Add this line to log the response from the server
						Swal.fire({
							title: 'Errors',
							text: 'There were errors while saving the data.',
							type: 'error'
						});
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