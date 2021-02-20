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

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h3 class="text-center text-muted my-3">Account Setting</h3>
            <!-- Change Account Password -->
            <form method="post" action="">
                <?php
                $id = $_SESSION['u_id'];
                $sql = "SELECT * FROM `users` WHERE `u_id`= '$id'";
                $result = mysqli_query($conn, $sql);
                $numRows = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
                $flag = 0;
                if (isset($_POST['btnChangePassword'])) {
                    $current = $_POST['current_password'];
                    $new = $_POST['new_password'];
                    $confirm = $_POST['confirm_new_password'];
                    if (password_verify($current, $row["u_pass"])) {
                        if ($current == $new) {
                            $flag = 1;
                        } elseif ($new != $confirm) {
                            $flag = 2;
                        } else {
                            $hash = password_hash($new, PASSWORD_DEFAULT);
                            $sql = "UPDATE `users` SET  `u_pass` = '$hash'";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Your password has been successfully changed!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
                            }
                        }
                    } else {
                        $flag = 3;
                    }
                    if ($flag == 1)
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Old and new passsword can not be the same
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
                    elseif ($flag == 2)
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          New password and confirm password does not match!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
                    elseif ($flag == 3)
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Current password is invalid!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
                }
                ?>
                <h5 class="text-primary my-3">Change Account Password</h5>
                <div class="form-group">
                    <label class="text-muted" for="exampleInputPassword1">Current Password</label>
                    <input type="password" name="current_password" class="form-control" id="exampleInputPassword1" placeholder="Current Password" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="text-muted" for="inputPassword4">New Password</label>
                        <input type="password" name="new_password" class="form-control" id="inputPassword4" placeholder="New Password" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-muted" for="inputPassword4">Confirm New Password</label>
                        <input type="password" name="confirm_new_password" class="form-control" id="inputPassword4" placeholder="Confirm New Password" required>
                    </div>
                </div>
                <button type="submit" name="btnChangePassword" class="btn btn-primary">Change Password</button>
            </form>
            <!-- Delete Your Account -->
            <h5 class="mt-4 text-danger my-3">Delete Your Account</h5>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-danger mb-3" data-toggle="modal" data-target="#exampleModalCenter">Delete Account</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="exampleModalLongTitle">Delete Account Confirmation
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">By deleting your account, Your all threads and comments will be
                            deleted.<br>
                            <strong class="text-muted">We are sorry to see you go!</strong>
                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-outline-danger" href="partials/_delete.php?id=<?php echo $id ?>">Confirm</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'partials/_footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

</html>