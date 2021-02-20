<?php include 'partials/_dbconnect.php'; ?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Pandemic Stories</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="./assets/css/blk-design-system.css?v=1.0.0" rel="stylesheet" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.3/plyr.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.0/basic/ckeditor.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <script type='text/javascript' src="js/_handleThread-y.js"></script>
</head>

<body class="d-flex flex-column h-100">
    <!-- Header -->
    <?php include 'partials/_header.php'; ?>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <br><br><br>
        <div class="container">
            <!-- User profile -->
            <h3 class="text-center text-muted my-3">Profile</h3>
            <ul class="list-group list-group-flush">
                <?php
                $sql = "SELECT * FROM `profile` WHERE `u_id` = $userid";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) == 0) {
                        $fname = null;
                        $lname = null;
                        $location = null;
                        $bio = null;
                        $sfp = null;
                    } else {
                        $row = mysqli_fetch_assoc($result);
                        $fname = $row['f_name'];
                        $lname = $row['l_name'];
                        $location = $row['location'];
                        $bio = $row['bio'];
                        $sfp = $row['sfp'];
                    }
                }
                ?>
                <li class="list-group-item">
                    <h5 class="text-primary"> First Name</h5>
                    <h7 class="text-muted">
                        <?php echo $fname ?>
                    </h7>
                </li>
                <li class="list-group-item">
                    <h5 class="text-primary"> Last Name</h5>
                    <h7 class="text-muted">
                        <?php echo $lname ?>
                    </h7>
                </li>
                <li class="list-group-item">
                    <h5 class="text-primary"> Bio</h5>
                    <h7 class="text-muted">
                        <?php echo $bio ?>
                    </h7>
                </li>
                <li class="list-group-item">
                    <h5 class="text-primary"> Location</h5>
                    <h7 class="text-muted">
                        <?php echo $location ?>
                    </h7>
                </li>
                <li class="list-group-item">
                    <h5 class="text-primary"> You are...</h5>
                    <h7 class="text-muted">
                        <?php echo $sfp ?>
                    </h7>
                </li>
            </ul>
            <div class="ml-3">
                <a type="button" class="btn btn-outline-primary" href="update_profile.php">Update Profile</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'partials/_footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <!--   Core JS Files   -->
    <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="./assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!-- Chart JS -->
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="./assets/js/plugins/moment.min.js"></script>
    <script src="./assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <!-- Black Dashboard DEMO methods, don't include it in your project! -->
    <script src="./assets/demo/demo.js"></script>
    <!-- Control Center for Black UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/blk-design-system.min.js?v=1.0.0" type="text/javascript"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
    </script>
    <!--plyr video player-->
    <script src="https://cdn.plyr.io/3.6.3/plyr.js"></script>
    <script>
        const player = new Plyr('#player');
    </script>

</html>