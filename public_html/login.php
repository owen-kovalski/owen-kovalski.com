<?php
	include_once 'includes/header.php';
    require_once('userlogin/config.php');
?>
<link rel="stylesheet" type="text/css" href="userlogin/css/styles.css">
<body>
<?php
  include_once 'includes/nav.php';
?>

<div class="dcontainer h-100">
  <div class="d-flex justify-content-center h-100">
      <div class="user_card">
        <div class="d-flex justify-content-center">
          <div class="brand_logo_container">
            <img src="userlogin/img/logo2.png" class="brand_logo" alt="Login Logo">
          </div>
        </div>
        <div class="d-flex justify-content-center form_container">
          <form>
            <div class="input-group mb-3">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fi fi-sr-mode-portrait"></i></span>
              </div>
              <input type="text" name="username" id="username" class="form-control input_user" required>
            </div>
            <div class="input-group mb-2">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fi fi-sr-mode-portrait"></i></span>
              </div>
              <input type="text" name="password" id="password" class="form-control input_pass" required>
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="rememberme" class="custom-control-input" id="customControlInline">
                <label class="custom-control-label" for="customControlInline">Remember Me</label>
              </div>
            </div>
          </form>
        </div>
        <div class="d-flex justify-content-center mt-3 login-container">
          <button type="button" name="button" id="login" class="btn login_btn">Login</button>
        </div>
        <div class="mt-4">
          <div class="d-flex justify-content-center links">
            Don't have an account? <a href="registration.php" class="ml-2">Sign Up</a>
          </div>
          <div class="d-flex justify-content-center">
            <a href="">Forgot your password?</a>
          </div>
        </div>
      </div>
  </div>
</div>
</body>
<?php
  include_once 'includes/footer.php';
?>