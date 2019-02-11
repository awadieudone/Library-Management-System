<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "myLibrary");
if(!$conn) {
    die("Connection Failed".mysqli_error($conn));
}
$firstname = "";
$lastname = "";
$username = "";
$email = "";


// $_SESSION['id'] ='';

$errors = array();

if(isset($_POST['submit-reg'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];


    if (empty($firstname)) { array_push($errors, "Firstname is required"); }
    if (empty($lastname)) { array_push($errors, "Lastname is required"); }
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    if ($password != $passwordConf) {
      array_push($errors, "The two passwords do not match");
    }

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
  
    if ($user) { // if user exists
        if ($user['username'] === $username) {
        array_push($errors, "Username already exists");
        }
        if ($user['email'] === $email) {
        array_push($errors, "Email already exists");
        }
    }

    if (count($errors) == 0) {
        $password = md5($password);//encrypt the password before saving in the database
  
        $query = "INSERT INTO users(firstname, lastname, username,email,password)";
        $query .= " VALUES('$firstname','$lastname','$username','$email','$password')";
        $insert_result = mysqli_query($conn,$query);

        $user_id = $conn->insert_id;

        if(!$insert_result) {
            die("Failed to Register user ".mysqli_error($conn));
        } else {
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['reg-success'] = "Welcome To The Library ";
            header("Location: user_library.php");
            exit(0);
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
    <link rel="stylesheet" href="style.css">
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
            <a class="navbar-brand" id="logo" href="index.php"><img src="images/logo.png"> O'Library</a>
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
              </ul>
            </div>
          </nav>
    </div>


    <div class="header">
        <h2>Registration To Our Library</h2>
    </div>

    

    <div class="container" id="content">
    <?php  if (count($errors) > 0) : ?>
    <div class="error">
        <?php foreach ($errors as $error) : ?>
        <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
    <?php  endif ?>
        <div class="form-head">
            <h2>Registration</h2>
        </div>
        <form action="register.php" method="post">
            <div class="input-group">
                <label for="firstname" required>Enter Firstname: </label>
                <input class="input form-control" value="<?php echo $firstname; ?>" type="text" name="firstname">
            </div>
            <div class="input-group">
                <label for="lastname">Enter Lastname: </label>
                <input class="input form-control" value="<?php echo $lastname; ?>" type="text" name="lastname">
            </div>
            <div class="input-group">
                <label for="username">Enter Username: </label>
                <input class="input form-control" value="<?php echo $username; ?>" type="text" name="username">
            </div>
            <div class="input-group">
                <label for="email">Enter Email: </label>
                <input class="input form-control" value="<?php echo $email; ?>" type="email" name="email">
            </div>
            <div class="input-group">
                <label for="password">Enter Password: </label>
                <input class="input form-control" type="password" name="password">
            </div>
            <div class="input-group">
                <label for="passwordConf">Confirm Password: </label>
                <input class="input form-control" type="password" name="passwordConf">
            </div>

            <input class="btn btn-primary" type="submit" name="submit-reg" value="Sign Up">

            <p>Member already? <a href="login.php">Log In</a></p>
        </form>
    </div>

    <div class="footer">
        <p>This is the footer</p>
    </div>
</body>
</html>