<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "myLibrary");
if(!$conn) {
    die("Connection Failed".mysqli_error($conn));
}
$firstname = "";
$lastname = "";
$username = "";
$role = "";
$email = "";

// $_SESSION['id'] ='';

 $errors = array();
if(isset($_POST['submit-reg'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];

    $errors = array();

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    // if (empty($role)) { array_push($errors, "Role is required"); }
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
    }

    if (count($errors) == 0) {
        $password = md5($password);//encrypt the password before saving in the database
  
        $query = "INSERT INTO users(firstname, lastname, username,role,email,password)";
        $query .= " VALUES('$firstname','$lastname','$username','$role','$email','$password')";
        $insert_result = mysqli_query($conn,$query);

        $user_id = $conn->insert_id;

        if(!$insert_result) {
            die("Failed to Register user ".mysqli_error($conn));
        } else {
            $_SESSION['role'] = $role;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['reg-success'] = "Welcome To The Library ";
            header("Location: users.php");
            exit(0);
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin</a>
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Home</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Home Site</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class='fa fa-user'></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="addUser.php">Add User</a>
                            </li>
                            <li>
                                <a href="users.php">Users Table</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="borrowedBooks.php"><i class="fa fa-book"></i> Borrowed Books</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#book"><i class="fa fa-fw fa-arrows-v"></i> Manage Books <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="book" class="collapse">
                            <li>
                                <a href="library.php"><i class="fa fa-book"></i> Available Books</a>
                            </li>
                            <li>
                                <a href="applied.php"><i class="fa fa-book"></i> Applied Books</a>
                            </li>
                            <li>
                                <a href="approve.php"><i class="fa fa-check-square-o" aria-hidden="true"></i> Approved Books</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small>Subheading</small>
                        </h1>

                        <div class="col-xs-12" id="container">

                            <div>
                                    
                                        <div class="form-head">
                                            <h2>User Registration</h2>
                                        </div>
                                        
                                        <form action="addUser.php" method="post">
                                        <?php  if (count($errors) > 0) : ?>
                                        <div class="error">
                                            <?php foreach ($errors as $error) : ?>
                                            <p><?php echo $error ?></p>
                                            <?php endforeach ?>
                                        </div>
                                        <?php  endif ?>
                                            <div class="input-group">
                                                <label for="firstname" required>Enter Firstname: </label>
                                                <input class="input form-control" type="text" value="<?php echo $firstname; ?>" name="firstname">
                                            </div>
                                            <div class="input-group">
                                                <label for="lastname">Enter Lastname: </label>
                                                <input class="input form-control" type="text" value="<?php echo $lastname; ?>" name="lastname">
                                            </div>
                                            <div class="input-group">
                                                <label for="username">Enter Username: </label>
                                                <input class="input form-control" type="text" value="<?php echo $username; ?>" name="username">
                                            </div>
                                            <div class="input-group">
                                                <label for="email">Enter Email: </label>
                                                <input class="input form-control" type="email" value="<?php echo $email; ?>" name="email">
                                            </div>
                                            <div class="input-group">
                                                <select class="input form-control" name="role">
                                                    <option value="<?php echo $role; ?>">User Role</option>
                                                    <option name="admin">Admin</option>
                                                    <option name="subscriber">Subscriber</option>
                                                </select>
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

                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    

</body>
</html>