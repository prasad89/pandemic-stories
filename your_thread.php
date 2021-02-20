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

<body id="body101" class="d-flex flex-column h-100">
    <!-- Header -->
    <?php include 'partials/_header.php'; ?>

    <!-- Start Thread -->
    <?php include 'partials/_startThread.php'; ?>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <div class="row">
                <!-- Users thread -->
                <div class="col-sm-8">
                    <h3 class="text-center text-muted mt-3">List of threads, Posted by you!</h3>
                    <?php
                    $sql = "SELECT `th_id`,`th_title`,`th_description` FROM `threads` WHERE `th_u_id` = $userid";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) == 0) {
                        // If no threads posted
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>No result!</strong>
            No threads post by you!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
                    } else {
                        // If threads posted
                        echo '<ul class="list-group list-group-flush">';
                        $i = 0;
                        while ($i < mysqli_num_rows($result)) {
                            $i++;
                            $row = mysqli_fetch_assoc($result);
                            $th_id = $row['th_id'];
                            $th_title = $row['th_title'];
                            $th_description = $row['th_description'];
                            $t_name = fetch_topic($th_id);
                            echo '<li class="list-group-item text-primary" id="posts101">
              <span class="badge badge-primary badge-pill">
              ' . $t_name . '
              </span>
              ' . $th_title . '
              <p class=text-muted>
              ' . $th_description . '
              </p>
              </li>';
                        }
                        echo '</ul>';
                        // Pagination
                        include 'partials/_pagination.php';
                    }
                    ?>
                </div>
                <div class="col-sm-4">
                    <!-- Start Thread -->
                    <?php start_thread(); ?>
                    <!-- All Topics -->
                    <?php include 'partials/_topics.php'; ?>
                    <!-- Newsletter -->
                    <?php include 'partials/_newsletter.php'; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'partials/_footer.php'; ?>
    <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

</html>

<?php
function fetch_topic($th_id)
{
    global $conn;
    $sql = "SELECT `t_name` FROM `topics` WHERE `t_id` IN (SELECT `th_t_id` FROM `threads` WHERE `th_id`=$th_id)";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['t_name'];
}
?>