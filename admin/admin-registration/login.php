<?php
session_start();
$_SESSION['username'] = "";
$conn = mysqli_connect("localhost", "root", "", "myLibrary") or die("Connection failed" . mysqli_error());
$errors = array();
$username = "";
$password = "";

// LOGIN USER
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (empty($username)) {array_push($errors, "Username is required");}
    if (empty($password)) {array_push($errors, "Password is required");}
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($results) > 0) {
            $user = mysqli_fetch_assoc($results);

                if($user['role'] === 'Admin') {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['dashboard_login_success'] = "Welcome To The Dashboard";
                    header("Location: ../index.php");
                    exit(0);
                } else if($user['role'] === 'Subscriber') {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['login-success'] = "Welcome To The Library";
                    header("Location: ../../user_library.php");
                    exit(0);
                } else {
                    die("Failed to register" . mysqli_error($conn));
                }
         }else {
            array_push($errors, "Wrong username/password combination");
        }
        
    }
  }
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>

     <!-- Navigation Bar -->
     <div id="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" id="logo" href="index.php"><img src="../../images/logo.png"> O'Library</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="index.php"><i class="fa fa-home"></i> HOME</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#about">ABOUT US</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#services">SERVICES</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#contact">CONTACT</a>
                </li>
                <a id="username" href="borrowedBooks.php"><?php echo $_SESSION['username']; ?></a>
              </ul>
            </div>
          </nav>
    </div>
    <div class="header">
        <h2>Dashboard Login</h2>
    </div>

    <div class="container" id="content">

    <?php  if (count($errors) > 0) : ?>
        <div class="error">
            <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
            <?php endforeach ?>
        </div>
    <?php  endif ?>

        <div class="form-head">
            <h2>Login</h2>
        </div>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="username">Enter Username: </label>
                <input class="input form-control" value="<?php echo $username; ?>" type="text" name="username">
            </div>
            <div class="input-group">
                <label for="password">Enter Password: </label>
                <input class="input form-control" type="password" name="password">
            </div>

            <input class="btn btn-primary" type="submit" name="submit" value="Login">

            <p>Not yet a member? <a href="register.php">Sign Up</a></p>
        </form>
    </div>

    <?php include "../../includes/footer.php"; ?>