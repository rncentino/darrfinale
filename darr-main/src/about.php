<?php 
session_start();
$title = "About Us";
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

      <!-- About Us Section-->
      <div class="container-fluid">
        <div class="card bg-secondary-subtle mt-5">
          <div class="card-body">
            <h2 class="fw-bold mb-4 p-3 border-bottom border-success border-3">About</h2>
            
            <div class="row align-items-center">
              <!-- Illustration on the left (mobile responsive) -->
              <div class="col-12 col-md-6 text-center mb-4 mb-md-0">
                <img src="assets/images/logos/illustration.svg" alt="Illustration" class="img-fluid" style="max-width: 100%; height: auto;" data-bs-toggle="modal" data-bs-target="#imageModal">
              </div>

              <!-- Description on the right (mobile responsive) -->
              <div class="col-12 col-md-6">
                <h3>DARPO Northern Samar Survey Team Records</h3>
                <p>This system is designed to store records, ensuring efficient management and retrieval of important data. It provides a centralized platform for storing and accessing survey records, helping the team streamline operations and improve productivity.</p>

                <p>This system has a built-in PDF viewer and supports map integration for KML files. The system can be accessed from anywhere, providing flexibility and convenience to the users.</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel">Credits: NSC Interns</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <img src="assets/images/logos/gg.jpeg" alt="Illustration" class="img-fluid" style="max-width: 100%; height: auto;">
        </div>
      </div>
    </div>
  </div>

  <?php include('footer.php') ?>

</body>

<!-- scripts -->
<?php include('components/scripts.php') ?>
