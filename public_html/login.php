<?php
session_start();
include_once 'includes/header.php';
require_once('userlogin/config.php');

// CSRF token generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<body>
<?php include_once 'includes/nav.php'; ?>

<div class="container h-100">
  <div class="d-flex justify-content-center h-100">
    <div class="user_card">
      <div class="d-flex justify-content-center">
        <div class="brand_logo_container">
          <img src="userlogin/img/logo2.png" class="brand_logo" alt="Login Logo">
        </div>
      </div>
      <div class="d-flex justify-content-center form_container">
        <form id="loginForm" method="post" action="">
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

          <div class="input-group mb-3">
            <div class="input-group-append">
              <span class="input-group-text"><i class="bi bi-person-bounding-box"></i></span>
            </div>
            <input type="text" name="username" id="username" class="form-control input_user" required placeholder="Email">
          </div>

          <div class="input-group mb-2">
            <div class="input-group-append">
              <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
            </div>
            <input type="password" name="password" id="password" class="form-control input_pass" required placeholder="Password">
            <div class="input-group-append">
              <button type="button" class="btn btn-outline-secondary toggle-password" tabindex="-1">
                <i class="bi bi-eye-slash" id="toggleIcon"></i>
              </button>
            </div>
          </div>

          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="rememberme" class="custom-control-input" id="customControlInline">
              <label class="custom-control-label" for="customControlInline">Remember Me</label>
            </div>
          </div>

          <div class="g-recaptcha mb-3" data-sitekey="YOUR_RECAPTCHA_SITE_KEY"></div>

          <div class="d-flex justify-content-center mt-3 login_container">
            <button type="submit" class="btn login_btn">Login</button>
          </div>
        </form>
      </div>
      <div class="mt-4">
        <div class="d-flex justify-content-center links">
          Don't have an account? <a href="registration.php" class="ml-2">Sign Up</a>
        </div>
        <div class="d-flex justify-content-center">
          <a href="#">Forgot your password?</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
  $(document).ready(function () {
    // Toggle password visibility
    $('.toggle-password').on('click', function () {
      const passwordInput = $('#password');
      const icon = $('#toggleIcon');
      const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
      passwordInput.attr('type', type);
      icon.toggleClass('bi-eye').toggleClass('bi-eye-slash');
    });

    // Handle login submission
    $('#loginForm').on('submit', function (e) {
      e.preventDefault();

      const form = this;
      const formData = $(form).serialize();

      // Client-side reCAPTCHA check
      if (grecaptcha.getResponse() === '') {
        alert('Please complete the reCAPTCHA.');
        return;
      }

      // Throttling client-side (basic check, real logic should be server-side)
      const loginBtn = $('.login_btn');
      loginBtn.prop('disabled', true).text('Logging in...');

      $.ajax({
        type: 'POST',
        url: 'userlogin/jslogin.php',
        data: formData,
        success: function (data) {
          if (data.trim() === "1") {
            window.location.href = "index.php";
          } else {
            alert(data);
          }
        },
        error: function () {
          alert('Login failed. Please try again.');
        },
        complete: function () {
          loginBtn.prop('disabled', false).text('Login');
        }
      });
    });
  });
</script>

<?php include_once 'includes/footer.php'; ?>
</body>