<!-- Fixed navbar -->
<?php
session_start();
echo '<header>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
<a class="navbar-brand" href="/Pandemic-stories">
<img src="images/icon.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
Forum
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
<form class="form-inline mr-auto mt-2 mt-md-0" action="search.php">
<input class="form-control mr-sm-2" name="search" type="search" placeholder="What are you looking for?" aria-label="Search" style="width: 22rem;" required>
<button class="btn btn-success my-2 my-sm-0" type="submit" style="width: 5rem;">Search</button>
</form>';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $userid = $_SESSION['u_id'];
  echo '<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle px-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  ' . $_SESSION['useremail'] . '
  </button>
  <div class="dropdown-menu dropdown-menu-right px-3">
  <a class="dropdown-item" href="profile.php">Profile</a>
  <a class="dropdown-item" href="update_profile.php">Edit Profile</a>
  <a class="dropdown-item" href="your_thread.php">Your Threads</a>
  <a class="dropdown-item" href="saved_thread.php">Saved Threads</a>
  <a class="dropdown-item" href="setting.php">Account Setting</a>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="partials/_logout.php">Logout</a>
  </div>
  </div>';
} else {
  echo '<button type="button" class="btn btn-outline-success mr-1" data-toggle="modal" data-target="#loginModal" style="width: 5rem;">Login</button>
  <button type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#signupModal" style="width: 5rem;">Signup</button>';
}
echo '</div>
</nav>
</header>';
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false") {
  $showError = $_GET['error'];
  echo  '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  ' . $showError . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>';
}
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
  echo  '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> Your account is created now you can login and Update your full profile
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>';
} else if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {
  $showError = $_GET['error'];
  echo  '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  ' . $showError . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>';
}
?>