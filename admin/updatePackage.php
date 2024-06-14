<?php
    include 'db.php';

    if(isset($_GET['packageID'])) {
        $packageID = $_GET['packageID'];

        // Prepare a select statement
        $sql = "SELECT * FROM packages WHERE packageID = ?";

        if($stmt = mysqli_prepare($conn, $sql)) {
            // Set parameters
            $param_packageID = $packageID;

            // Bind variables to the prepared statement
            mysqli_stmt_bind_param($stmt, "s", $param_packageID);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. */
                    if($row = mysqli_fetch_assoc($result)) {
                        // Retrieve individual field value
                        $name = $row["name"];
                        $duration = $row["duration"];
                        $price = $row["price"];
                    }
                } else {
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        header("location: error.php");
        exit();
    }
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate and update the data in database
        
        // Prepare an update statement
        $sql = "UPDATE packages SET name = ?, duration = ?, price = ? WHERE packageID = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Set parameters
            $param_name = $_POST["name"];
            $param_duration = $_POST["duration"];
            $param_price = $_POST["price"];
            $param_packageID = $_POST["packageID"];

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sids", $param_name, $param_duration, $param_price, $param_packageID);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                session_start();
                $_SESSION['alert'] = "Package updated successful!";
                header("Location: package.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
    }
?>
<style>
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .form-actions .btn {
            display: inline-block;
        }
</style>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update Package</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="dashboard.php"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>User</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-user"></i><a href="admin.php">Admin</a></li>
                            <li><i class="fa fa-users"></i><a href="client.php">Clients</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-calendar"></i>Bookings</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-suitcase"></i><a href="tables-basic.html">Incoming Bookings</a></li>
                            <li><i class="fa fa-archive"></i><a href="tables-data.html">Past Bookings</a></li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="package.php"><i class="menu-icon fa fa-file-text"></i>Package</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                <a class="navbar-brand" href="dashboard.php" ><i class="menu-icon fa fa-user"></i> Shafi Admin</a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <style>
                .circle {
                    width: 40px; /* Adjust the size of the circle */
                    height: 40px; /* Adjust the size of the circle */
                    border-radius: 50%; /* This creates a circle */
                    background-color: #f0f0f0; /* Background color of the circle */
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
            </style>
            <div class="top-right">
                <div class="header-menu">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="circle">
                                <span class="ti-user"></span>
                            </div>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#">My Profile</a>

                            <a class="nav-link" href="#" onclick="return confirmLogout();">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <script>
                    function confirmLogout() {
                        // Display the confirmation dialog
                        var confirmed = confirm("Are you sure you want to log out?");
                        
                        if (confirmed) {
                            // Set session alert
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', 'index.php', true);
                            xhr.send();
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    alert("Log out successful!");
                                    window.location.href = 'index.php';
                                }
                            };
                        }
                        // Return false to prevent the default behavior
                        return false;
                    }
        </script>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Update Package</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="package.php">Package</a></li>
                                    <li><a href="#">Update Package</a></li>
                                    <li class="active"><?php echo $name; ?> Package</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                        <form action="<?php $_SERVER['REQUEST_URI']; ?>" method="post" class="form-horizontal">
                            <div class="card-header">
                                <strong><?php echo $name; ?></strong> Package
                            </div>
                            <div class="card-body card-block">
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="packageID" class=" form-control-label">PackageID</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="packageID" name="packageID" value="<?php echo $packageID; ?>" class="form-control" readonly></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="name" class=" form-control-label">Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="name" name="name" value="<?php echo $name; ?>" class="form-control"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="duration" class=" form-control-label">Duration</label></div>
                                        <div class="col-12 col-md-9"><input type="int" id="duration" name="duration" value="<?php echo $duration; ?>" class="form-control"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="price" class=" form-control-label">Price</label></div>
                                        <div class="col-12 col-md-9"><input type="double" id="price" name="price" value="<?php echo $price; ?>" class="form-control"></div>
                                    </div>
                                    <div class="form-actions form-group">
                                        <a href="package.php" class="btn btn-secondary btn-sm">Cancel</a>
                                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        &copy; <a class="border-bottom" href="#">Shafi Travel</a>, All Right Reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
