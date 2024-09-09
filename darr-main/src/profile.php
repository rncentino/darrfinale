<?php 
session_start();
$title = "Profile";
require("components/auth.php");
require('components/header.php'); 
?>

<body>
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper">
    <!-- Main wrapper -->
    <div class="body-wrapper">

      <!-- Header Start -->
      <?php include('components/nav.php') ?>
      <!-- Header End -->

      <!-- Profile Section-->
      <div class="container-fluid">
      <div class="card bg-secondary-subtle mt-5">
        <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="fw-bold p-3 border-bottom border-success border-3">My Profile</h2>
          
          <div class="d-flex">
            <button type="button" class="btn btn-warning ms-md-3" data-bs-toggle='modal' data-bs-target='#editProfileModal'>
              <i class="ti ti-edit"></i> Edit Profile
            </button>
          </div>
        </div>

          <div class="row">
            <!-- Profile Image -->
            <div class="col-12 col-md-4 text-center mb-3 mb-md-0">
              <img src="assets/images/profile/user-1.jpg" alt="Profile Image" class="rounded" style="width: 150px; height: 150px;">
            </div>

            <!-- Profile Details -->
            <div class="col-12 col-md-8">
              <table class="table table-border-primary">
                <tr>
                  <td><strong>Fullname</strong></td>
                  <td><?php echo $_SESSION['firstname']. ' ' .$_SESSION['lastname'];; ?></td>
                </tr>
                <tr>
                  <td><strong>Email</strong></td>
                  <td><?php echo $_SESSION['email']; ?></td>
                </tr>
                <tr>
                  <td><strong>Signed up on</strong></td>
                  <td><?php echo date("F d, Y", strtotime($_SESSION['regdate'])); ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      </div>

      <!-- Edit Profile Modal -->
      <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form id="editProfileForm" class="row g-3">
                          <div class="col-md-12">
                              <div class="mb-3">
                                  <label for="edit_firstname" class="form-label">Firstname</label>
                                  <input type="text" class="form-control" id="edit_firstname" name="firstname" value="<?php echo $_SESSION['firstname']; ?>" required>
                              </div>
                              <div class="mb-3">
                                  <label for="edit_lastname" class="form-label">Lastname</label>
                                  <input type="text" class="form-control" id="edit_lastname" name="lastname" value="<?php echo $_SESSION['lastname']; ?>" required>
                              </div>
                              <div class="mb-3">
                                  <label for="edit_email" class="form-label">Email</label>
                                  <input type="email" class="form-control" id="edit_email" name="email" value="<?php echo $_SESSION['email']; ?>" required>
                              </div>
                          </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning">Update Profile</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>


    </div>
  </div>
</body>

<!-- Scripts -->
<?php include('components/scripts.php') ?>

<script>
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

    //edit profile
    $(document).ready(function() {
    $('#editProfileForm').submit(function(e) {
        e.preventDefault(); 

        $.ajax({
            url: 'backend/user-edit.php',
            type: 'POST',
            data: $(this).serialize(), 
            success: function(response) {
                response = response.trim(); 
                
                if (response === "success") {
                    $('#editProfileForm').modal('hide');
              
                    Toast.fire({
                        icon: 'success',
                        title: 'Profile updated successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload(); 
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response
                    });
                }
            },
            error: function(xhr, status, error) {
                Toast.fire({
                    icon: 'error',
                    title: 'Failed to update profile. Please try again later.'
                });
            }
        });
    });
});



</script>
