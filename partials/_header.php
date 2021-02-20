<!-- Fixed navbar -->
<?php
session_start();
print <<<HTML
<header>
<nav class="navbar navbar-expand-md navbar-dark fixed-top " style="
background-color: #0f0f0f;padding:0.5rem;">
<a class="navbar-brand" href="index.php">
<img src="images/icon.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
Pandemic Stories
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
<form class="search-box form-inline mx-auto mt-2 mt-md-0" action="search.php">
<input class="form-control mr-sm-2" name="search" type="search" placeholder="What are you looking for?" autocomplete="off" aria-label="Search" style="width: 22rem;" required>
<div class="result" style="width: 22rem;"></div>
<button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
</form>
HTML;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $userid = $_SESSION['u_id'];
  print <<<HTML
  <div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle px-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  $_SESSION[useremail]
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
  </div>
HTML;
} else {
  print <<<HTML
  <button type="button" class="btn btn-outline-success mr-1" data-toggle="modal" data-target="#loginModal" >Login</button>
  <button type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#signupModal" >Signup</button>
  HTML;
}
print <<<HTML
</div>
</nav>
HTML;

print <<<HTML
</header>
HTML;

if (isset($_GET['posting']) && $_GET['posting'] == "sucess") {
  print <<<HTML
  <br><br><br><br><div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sucess!</strong> Your thread has been added! Please wait for community to respond.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  HTML;
  unset($_GET['posting']);
}

if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false") {
  $showError = $_GET['error'];
  echo  '<br><br><div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  ' . $showError . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>';
}
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
  echo  '<br><br><div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> Your account is created now you can login and Update your full profile
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>';
} else if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {
  $showError = $_GET['error'];
  echo  '<br><br><div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  ' . $showError . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>';
}
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';

?>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.search-box input[type="search"]').on("keyup input", function() {
      /* Get input value on change */
      var inputVal = $(this).val();
      var resultDropdown = $(this).siblings(".result");
      if (inputVal.length) {
        $.get("partials/_handleSearch.php", {
          term: inputVal
        }).done(function(data) {
          // Display the returned data in browser
          console.log(data);
          resultDropdown.html(data);
        });
      } else {
        resultDropdown.empty();
      }
    });
    // Set search input value on click of result item
    $(document).on("click", ".result p", function() {
      $(this).parents(".search-box").find('input[type="search"]').val($(this).text());
      $(this).parent(".result").empty();
    });
  });
</script>


<style type="text/css">
  /* Formatting search box */
  .search-box {
    position: relative;
    display: inline-block;
  }

  .result {
    position: absolute;
    z-index: 99;
    top: 100%;
    left: 0;
  }

  .search-box input[type="text"] {
    width: 100%;
  }

  /* Formatting result items */
  .result p {
    margin: 0;
    padding: 7px 10px;
    border: 1px solid #CCCCCC;
    border-top: none;
    cursor: pointer;
    background: #ffff;
    color: black;
  }

  .result p:hover {
    background: #f2f2f2;
  }
</style>