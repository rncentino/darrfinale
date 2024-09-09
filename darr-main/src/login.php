<?php
session_start();
$title = "Log In";
require("components/header.php");
?>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xl-4 col-sm-10 col-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="#" class="text-nowrap logo-img text-center d-block py-3">
                                    <img src="assets/images/logos/dar-logo.png" class="img-fluid" width="auto" alt="dar logo">
                                </a>
                                <form id="login-form" method="POST">
                                    <!-- Remove this alert -->
                                    <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <button type="button" class="btn btn-primary" id="show-password-button" onclick="togglePasswordVisibility()">
                                                <i class="ti ti-eye" id="eye-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4 rounded-2">Log In</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="text-primary fw-bold ms-2" href="./register.php">Create an account</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include('components/scripts.php') ?>

<script>
// Initialize Toast
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

function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var eyeIcon = document.getElementById("eye-icon");

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

$(document).ready(function() {
    $('#login-form').on('submit', function(event) {
        event.preventDefault(); 
        
        var $form = $(this);
        var formData = $form.serialize(); 
        
        console.log(formData); 
        
        $.ajax({
            url: 'auth-login.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                console.log(response); 
                
                var data = JSON.parse(response);
                
                if (data.success) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Login successful!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = '../src/records.php';
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Login failed',
                        text: data.message
                    });
                }
            },
            error: function() {
                Toast.fire({
                    icon: 'error',
                    title: 'An error occurred',
                    text: 'Please try again later.'
                });
            }
        });
    });
});
</script>
