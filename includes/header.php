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
                <li class="nav-item">
                  <a class="nav-link" href="admin/admin-registration/login.php">Admin</a>
                </li>
                
                <ul id="option">
                    <li id="user">
                        <?php if((isset($_SESSION['username']) && isset($_SESSION['user_id'])) || isset($_SESSION['id'])): ?>
                            <a id='username' href='borrowedBooks.php'>
                                <i class='fa fa-user'></i><?php echo  $_SESSION['username']; ?>
                                <i class='fa fa-fw fa-caret-down'></i>
                            </a>

                            <ul>
                                <li><a href="borrowedBooks.php">My Books</a></li>
                                <li><a href="app/auth/authentication.php?logout=1">Log Out</a></li>
                            </ul>
                        <?php else: ?>
                    </li>
                    </ul>
                        <li class="nav-item register">
                            <a href="register.php">Sign Up  <i class="fa fa-sign-in"></i></a>
                        </li>
                        </ul>
                        <?php endif; ?>


              </ul>
            </div>
          </nav>
    </div>