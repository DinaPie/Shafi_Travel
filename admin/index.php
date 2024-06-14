<!DOCTYPE html>
<html>
<?php
    session_start();
?>
<head>
  <title>Login/Sign Up</title>
  <meta charset="utf-8">
    <title>Shafi Travel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="assets/css/form.css" rel="stylesheet">
</head>
<body>
    <div id="container" class="container-authenticate">
        <!-- FORM SECTION -->
        <div class="row">
            <?php
                // Check if alert session variable is set
                if (isset($_SESSION['alert'])) {
                    echo '<script>alert("' . $_SESSION['alert'] . '")</script>';
                    unset($_SESSION['alert']); // Unset the session variable after displaying the alert
                }
            ?>
            <!-- SIGN UP -->
            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-up">
                    <form action="register.php" method="post">
                        <div class="input-group">
                            <i class='bx bxs-user'></i>
                            <input type="text" id="username" name="username" placeholder="Username">
                        </div>
                        <div class="input-group">
                            <i class='bx bx-mail-send'></i>
                            <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" id="password" name="password" placeholder="Password">
                        </div>
                        <button type="submit">
                            Sign up
                        </button>
                    </form>
                    
                        <p>
                            <span>
                                Already have an account?
                            </span>
                            <b onclick="toggle()" class="pointer">
                                Sign in here
                            </b>
                        </p>
                    </div>
                </div>
            
            </div>
            <!-- END SIGN UP -->
            <!-- SIGN IN -->
            <div class="col align-items-center flex-col sign-in">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-in">
                    <form action="authenticate.php" method="post">
                        <div class="input-group">
                            <i class='bx bxs-user'></i>
                            <input type="text" id="username" name="username" placeholder="Username">
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" id="password" name="password" placeholder="Password">
                        </div>
                        <button type="submit" name="login">
                            Sign in
                        </button>
                        </form>
                        <p>
                            <b>
                                Forgot password?
                            </b>
                        </p>
                        <p>
                            <span>
                                Don't have an account?
                            </span>
                            <b onclick="toggle()" class="pointer">
                                Sign up here
                            </b>
                        </p>
                    </div>
                </div>
                <div class="form-wrapper">
        
                </div>
            </div>
            <!-- END SIGN IN -->
        </div>
        <!-- END FORM SECTION -->
        <!-- CONTENT SECTION -->
        <div class="row content-row">
            <!-- SIGN IN CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="text sign-in">
                    <h2>
                        Welcome
                    </h2>
    
                </div>
                <div class="img sign-in">
        
                </div>
            </div>
            <!-- END SIGN IN CONTENT -->
            <!-- SIGN UP CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="img sign-up">
                
                </div>
                <div class="text sign-up">
                    <h2>
                        Join us
                    </h2>
    
                </div>
            </div>
            <!-- END SIGN UP CONTENT -->
        </div>
        <!-- END CONTENT SECTION -->
    </div>
  <script>
    let container = document.getElementById('container')

    toggle = () => {
        container.classList.toggle('sign-in')
        container.classList.toggle('sign-up')
    }

    setTimeout(() => {
        container.classList.add('sign-in')
    }, 200)
  </script>
</body>
</html>