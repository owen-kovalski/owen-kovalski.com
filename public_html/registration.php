<?php
	include_once 'includes/header.php';
  require_once('useraccounts/config.php');
?>
<body>
<?php
  include_once 'includes/nav.php';
?>
<section>
  <div>
    <form action="registration.php" method="post">
      <div class="container">
        <div class="row">
          <div class="col align-self-center">
            <h1>Sign Up</h1>
            <p>Please ensure all information is correct before submitting.</p>
            <hr class="mb-3">
            <label for="firstname"><b>First Name</b><b style="color: red;"> *</b></label>
            <input class="form-control" id="firstname" type="text" name="firstname" required>

            <label for="lastname"><b>Last Name</b><b style="color: red;"> *</b></label>
            <input class="form-control" id="lastname" type="text" name="lastname" required>

            <label for="email"><b>Email Address</b><b style="color: red;"> *</b></label>
            <input class="form-control" id="email" type="email" name="email" required>

            <label for="phonenumber"><b>Phone Number</b><b class="text-muted"> (Optional)</b></label>
            <input class="form-control" id="phonenumber" type="text" name="phonenumber">

            <label for="password"><b>Password</b><b style="color: red;"> *</b></label>
            <input class="form-control" id="password" type="password" name="password" required>
            <hr class="mb-3">
            <input class="btn btn-primary" type="submit" id='register' name="create" value="Sign Up">
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
</body> 
<?php
  include_once 'includes/footer.php';
?>