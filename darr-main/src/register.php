<?php
session_start();
$title = "Log In";
require("components/header.php");
?>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-10 col-lg-8 col-xxl-6">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-150">
                  <img src="assets/images/logos/dar-logo.png" alt="">
                </a>
                <form id="AddStudent">
                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <label for="firstname" class="form-label">First Name</label>
                      <input type="text" class="form-control" name="firstname" id="firstname">
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="lastname" class="form-label">Last Name</label>
                      <input type="text" class="form-control" name="lastname" id="lastname">
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="email" class="form-label">Email Address</label>
                      <input type="email" class="form-control" name="email" id="email">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4"> 
                      <label for="password" class="form-label">Password</label>
                      <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button type="button" class="btn btn-primary" onclick="togglePasswordVisibility('password', 'eye-icon')">
                          <i class="ti ti-eye" id="eye-icon"></i>
                        </button>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4"> 
                      <label for="confirm_password" class="form-label">Confirm Password</label>
                      <div class="input-group">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <button type="button" class="btn btn-primary" onclick="togglePasswordVisibility('confirm_password', 'eye-icon-confirm')">
                          <i class="ti ti-eye" id="eye-icon-confirm"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-2 fs-3 mb-4 rounded-2">Sign Up</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2 fs-4" href="../src/login.php">Log In</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include('components/scripts.php') ?>

  <script>
    function togglePasswordVisibility(inputId, iconId) {
      var passwordInput = document.getElementById(inputId);
      var eyeIcon = document.getElementById(iconId);

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("ti-eye");
        eyeIcon.classList.add("ti-eye-off");
      } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("ti-eye-off");
        eyeIcon.classList.add("ti-eye");
      }
    }


    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false, 
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    }); 

    $('#AddStudent').submit(function(e) {
    e.preventDefault();

    var password = $('#password').val();
    var confirmPassword = $('#confirm_password').val();
    var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

    if (password !== confirmPassword) {
        Toast.fire({
            icon: 'error',
            title: 'Passwords do not match!'
        });
        return;
    }

    if (!passwordRegex.test(password)) {
        Toast.fire({
            icon: 'error',
            title: 'Password must be at least 8 characters long and contain both letters and numbers.'
        });
        return;
    }

    $.ajax({
        url: 'backend/user-add.php',
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            if (response.trim() === "success") {
                Toast.fire({
                    icon: 'success',
                    title: 'User created successfully!'
                });

                setTimeout(function() {
                    window.location.href = '../src/login.php';
                }, 2000);
            } else {
                Toast.fire({
                    icon: 'error',
                    title: response
                });
            }
        },
        error: function(xhr, status, error) {
            Toast.fire({
                icon: 'error',
                title: 'Failed to create user. Please try again later.'
            });
        }
    });
});

  </script>
</body>

