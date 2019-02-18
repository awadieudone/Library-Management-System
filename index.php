<?php session_start(); ?>
<?php include "includes/header.php";?>

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
    

    <div style="text-align: center;" id="content">
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
    <?php include "includes/footer.php"; ?>