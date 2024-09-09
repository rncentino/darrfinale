<header class="app-header mt-3">
  <nav class="navbar navbar-expand-lg position-sticky">
    <div class="container-fluid">
      <!-- Logo Section -->
      <div class="brand-logo d-flex align-items-center">
        <!-- Logo Image -->
        <a href="./index.php" class="text-nowrap logo-img">
          <img src="assets/images/logos/logo.png" width="70" alt="Logo" />
        </a>
      </div>

      <!-- Full Navbar (Visible on desktop and tablets) -->
      <div class="collapse navbar-collapse d-none d-lg-flex" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <!-- <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="records.php">Records</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
        </ul>
      </div>

      <!-- Profile Picture and Dropdown (Visible on both PC and mobile) -->
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
            <!-- User Profile Image -->
            <img src="assets/images/profile/user-1.jpg" alt="User" width="35" height="35" class="rounded-circle">
          </a>

          <!-- Dropdown Menu (Visible on all screen sizes) -->
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
            <div class="message-body">
              <!-- Navigation Items for Mobile -->
              <!-- <a href="index.php" class="d-flex align-items-center gap-2 dropdown-item d-lg-none">
                <i class="ti ti-home fs-6"></i>
                <p class="mb-0 fs-4">Home</p>
              </a> -->
              <a href="records.php" class="d-flex align-items-center gap-2 dropdown-item d-lg-none">
              <i class="ti ti-files fs-6"></i>
                <p class="mb-0 fs-4">Records</p>
              </a>
              <a href="about.php" class="d-flex align-items-center gap-2 dropdown-item d-lg-none">
              <i class="ti ti-highlight fs-6"></i>
                <p class="mb-0 fs-4">About</p>
              </a>
              <!-- Profile and Logout for All Screens -->
              <a href="profile.php" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-user fs-6"></i>
                <p class="mb-0 fs-4">My Profile</p>
              </a>
              <a href="logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>