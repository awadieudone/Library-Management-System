<?php

session_start();
include "includes/db_conn.php";

$firstname = "";
$lastname = "";
$username = "";
$email = "";

$errors = array();


// -------------------Register--------------------
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


// ------------------Login--------------------
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

            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['login-success'] = "Welcome To The Library";
            header('location: user_library.php');
          exit(0);
         }else {
            array_push($errors, "Wrong username/password combination");
        }
        
    }
  }


//  LOGOUT USER
if (isset($_GET['logout'])) {
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    session_destroy();
    header("Location: ../../login.php");
    exit();
}