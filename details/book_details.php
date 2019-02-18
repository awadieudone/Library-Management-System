<?php session_start(); ?>
<?php 
$conn = mysqli_connect("localhost", "root", "", "myLibrary");

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
            <a class="navbar-brand" id="logo" href="../index.php"><img src="../images/logo.png"> O'Library</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="../index.php"><i class="fa fa-home"></i> HOME</a>
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
                
                <li class="nav-item">
                  <a class="nav-link" href="../admin/admin-registration/login.php">Admin</a>
                </li>
                <ul id="option">
                    <li id="user">
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo "<a id='username' href='borrowedBooks.php'><i class='fa fa-user'></i> " . $_SESSION['username'] . "<i class='fa fa-fw fa-caret-down'></i></a>";
                            ?>
                        <ul>
                            <li><a href="../borrowedBooks.php">My Books</a></li>
                            <li><a href="../logout.php">Log Out</a></li>
                        </ul>
                        <?php 
                    } else { ?>
                    </li>
                </ul>
                <li class="nav-item register">
                    <a href="../register.php">Sign Up  <i class="fa fa-sign-in"></i></a>
                </li>
                <?php 
            } ?>
              </ul>
            </div>
          </nav>
    </div>
<?php 
if (isset($_GET['readmore_id'])) {
    $readmore_id = $_GET['readmore_id'];

    $query = "SELECT * FROM books WHERE id=$readmore_id";
    $result = mysqli_query($conn, $query);

    $book = mysqli_fetch_assoc($result);

    $title = $book['title'];
    $image = $book['image'];
    $author = $book['author'];
    $description = $book['description'];

}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <small><a href="../user_library.php">Book Library</a>><a href="#">Book Details</a></small>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <img src="../images/<?php echo $image; ?>" style="width: 250px; height: 300px; float: right;">
        </div>
        <div class="col-sm-6">
            <h2><?php echo $title . " by " . $author; ?></h2>
            <p style="float: left;"><?php echo $description; ?></p>
            
        </div>
    </div>

    <div class="row" style="text-align: center;">
    <div class="col-lg-12" style="height: 100px;">
        
    </div>
        <h4 >Send A Message</h4>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <form method='post' action="book_details.php">
                <div class="row">
                    <div class="col-xs-6">
                    <div class="input-group">
                        <label for="username">Username  </label><br>
                        <input type="text" name="username" value="" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="input-group">
                        <label for="email">Email    </label><br>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <label for="subject">Subject  </label><br>
                            <input type="text" name="subject" value="" class="form-control">
                        </div>
                        <div class="input-group">
                            <label for="comment">Message  </label><br>
                            <textarea type="text" name="comment" col=13 row=6 class="form-control"></textarea>
                        </div>

                    </div>
                        
                </div>
                
            </form>
        </div>
    </div>
</div>
    
    
<?php include "../includes/footer.php"; ?>