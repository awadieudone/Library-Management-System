<?php session_start(); ?>

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
                  <a class="nav-link" href="admin/addUser.php">Admin</a>
                </li>
                
                <ul id="option">
                    <li id="user">
                        <?php 
                        if((isset($_SESSION['username']) && isset($_SESSION['user_id'])) || isset($_SESSION['id'])): ?>
                            <a id='username' href='borrowedBooks.php'>
                                <i class='fa fa-user'></i><?php echo  $_SESSION['username']; ?>
                                <i class='fa fa-fw fa-caret-down'></i>
                            </a>

                            <ul>
                                <li><a href="borrowedBooks.php">My Books</a></li>
                                <li><a href="logout.php">Log Out</a></li>
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

    <!-- Slider -->
    <div id="slider">
        <div id="#headerSlider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#headerSlider" data-slide-to="0" class="active"></li>
                    <li data-target="#headerSlider" data-slide-to="1"></li>
                    <li data-target="#headerSlider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/home1.jpg" class="d-block img-fluid">
                        <div class="carousel-caption">
                            <h5>Welcome to our library</h5>
                            <blockquote><i class="fa fa-quote-left"></i>Reading is an act of civilization; it’s one of the greatest acts of civilization because it takes the free raw material of the mind 
                            and builds castles of possibilities.<i class="fa fa-quote-right"></i> —Ben Okri</blockquote>
                            <?php if((isset($_SESSION['username']) && isset($_SESSION['user_id'])) || isset($_SESSION['id'])): ?>
                                <a href="user_library.php"><input type="submit" class="btn btn-info" value="Explore Library"></a>
                            <?php else: ?>  
                                <a href="library.php"><input type="submit" class="btn btn-info" value="Explore Library"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/home2.jpg" class="d-block img-fluid">
                        <div class="carousel-caption">
                            <h5>Register To Access Our Library</h5>
                            <blockquote><i class="fa fa-quote-left"></i>Anyone who says they have only one life to live must not know how to read a book.<i class="fa fa-quote-right"></i></blockquote>
                            <?php if((isset($_SESSION['username']) && isset($_SESSION['user_id'])) || isset($_SESSION['id'])): ?>
                                <a href="user_library.php"><input type="submit" class="btn btn-info" value="Explore Library"></a>
                            <?php else: ?>  
                                <a href="library.php"><input type="submit" class="btn btn-info" value="Explore Library"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/home3.jpg" class="d-block img-fluid">
                        <div class="carousel-caption">
                            <h5>Borrow A Book</h5>
                            <blockquote><i class="fa fa-quote-left"></i>Whenever you read a good book, somewhere in the world a door opens to allow in more light.<i class="fa fa-quote-right"></i>
                            –Vera Nazarian</blockquote>
                            <?php if((isset($_SESSION['username']) && isset($_SESSION['user_id'])) || isset($_SESSION['id'])): ?>
                                <a href="user_library.php"><input type="submit" class="btn btn-info" value="Explore Library"></a>
                            <?php else: ?>  
                                <a href="library.php"><input type="submit" class="btn btn-info" value="Explore Library"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#headerSlider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#headerSlider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>
    </div>
    



    <div style="text-align: center;" class="container" id="content">
       <h3>Welcome to our library. Checkout our available Books <a href="library.php">here</a></h3>

 <!-- Team Members -->

 <section id="team">
        <div class="container">
            <h1>Team In Charge</h1>
            <div class="row">
                <div class="col-md-4 profile-pic text-center">
                    <div class="img-box">
                        <img src="images/me.jpg" class="img-responsive" alt="">
                        <ul>
                            <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                            <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                            <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                        </ul>
                    </div>
                    <h2>Awa Dieudonne</h2>
                    <h3>CEO at O'Library</h3>
                    <p>So now we're going to just talk a bit more about how we do images, colors, 
                            and fonts and then</p>
                </div>

                <div class="col-md-4 profile-pic text-center">
                    <div class="img-box">
                        <img src="images/ciara.jpg" class="img-responsive" alt="">
                        <ul>
                            <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                            <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                            <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                        </ul>
                    </div>
                    <h2>Ciara</h2>
                    <h3>Attentant at O'Library</h3>
                    <p>So now we're going to just talk a bit more about how we do images, colors, 
                            and fonts and then</p>
                </div>
                <div class="col-md-4 profile-pic text-center">
                    <div class="img-box">
                        <img src="images/me3.jpg" class="img-responsive" alt="">
                        <ul>
                            <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                            <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                            <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                        </ul>
                    </div>
                    <h2>Alan Mbukson</h2>
                    <h3>Book Scheduler at O'Library</h3>
                    <p>So now we're going to just talk a bit more about how we do images, colors, 
                            and fonts and then</p>
                </div>
                
            </div>
        </div>
    </section>


    </div>
    <div class="footer">
        <p>This is the footer</p>
    </div>
</body>
</html>