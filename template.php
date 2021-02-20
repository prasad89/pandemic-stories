<?php include 'partials/_dbconnect.php';?>

<!doctype html>
<html lang="en" class="h-100">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <title>Forum</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sticky-footer-navbar/">

  <!-- Bootstrap core CSS -->
  <link href="bootstrap 4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles -->
  <link href="bootstrap 4.5.2/sticky-footer-navbar.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
  <!-- Header -->
  <?php include 'partials/_header.php';?>

  <!-- Begin page content -->
  <main role="main" class="flex-shrink-0">
    <div class="container">
      <div class="row">
        <!--  -->
        <div class="col-sm-8">

        </div>
        <div class="col-sm-4">
          <!-- Start Thread -->
          <?php include 'partials/_startThread.php';?>
          <!-- All Topics -->
          <?php include 'partials/_topics.php';?>
          <!-- Newsletter -->
          <?php include 'partials/_newsletter.php';?>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <?php include 'partials/_footer.php';?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="bootstrap 4.5.2/js/vendor/jquery.slim.min.js"><\/script>')</script>
  <script src="bootstrap 4.5.2/js/bootstrap.bundle.min.js"></script>
  </html>
