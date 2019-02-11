<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "myLibrary");
$errors = array();
$image_temp = "";
$title = "";
$description = "";
$author = "";
$isbn = "";

if($conn && isset($_POST['submit'])) {
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    echo $created_at = date('l jS \of F Y h:i:s A');
    move_uploaded_file($image_temp, "../images/$image");

    if(empty($title)) {array_push($errors, "Title is required."); }
    if(empty($author)) {array_push($errors, "Author is required."); }
    if(empty($isbn)) {array_push($errors, "Book ISBN is required"); }
    if(empty($description)) {array_push($errors, "A Description is required"); }

    $book_check_query = "SELECT * FROM books WHERE title='$title' OR isbn='$isbn' LIMIT 1";
    $check_result = mysqli_query($conn,$book_check_query);
    $book = mysqli_fetch_assoc($check_result);

    if ($book) { // if book exists
        if ($book['title'] === $title && $book['isbn'] == $isbn) {
        array_push($errors, "Book already exists");
        }
    }

    if(count($errors) == 0) {
        $query = "INSERT INTO books(image,title, author, isbn, description, created_at, updated_at) 
                VALUE ('$image','$title','$author','$isbn','$description','$created_at',CURDATE())";
        $result = mysqli_query($conn,$query);
        

        $book_id = $conn->insert_id;
        if($result) {
            $_SESSION['image'] = $image;
            $_SESSION['book_id'] = $book_id;
            header("Location: library.php");
        } else {
            die("Failed".mysqli_error($conn));
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
                    <!-- <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row" id="container">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small>Subheading</small>
                        </h1>

                        <div class="col-xs-12">

                            <div>

                            <?php  if (count($errors) > 0) : ?>
                            <div class="error">
                                <?php foreach ($errors as $error) : ?>
                                <p><?php echo $error ?></p>
                                <?php endforeach ?>
                            </div>
                            <?php  endif ?>

                                <div class="form-head">
                                    <h2>Add Book</h2>
                                </div>
                                <form action="addBook.php" method="post" enctype="multipart/form-data">
                                    <div class="input-group">
                                        <label for="image">Book Image: </label>
                                        <input type="file" class="form-control" value="<?php echo $image_temp; ?>" name="image">
                                    </div>
                                    <div class="input-group">
                                        <label for="title">Book Title: </label>
                                        <input type="text" class="form-control" value="<?php echo $title; ?>" name="title">
                                    </div>
                                    <div class="input-group">
                                        <label for="author">Author: </label>
                                        <input type="text" class="form-control" value="<?php echo $author; ?>" name="author">
                                    </div>
                                    <div class="input-group">
                                        <label for="isbn">isbn: </label>
                                        <input type="text" class="form-control" value="<?php echo $isbn; ?>" name="isbn">
                                    </div>
                                    <div class="input-group">
                                        <label for="description">Short Note: </label>
                                        <textarea name="description" class="form-control" value="<?php echo $description; ?>" id="description" cols="40" rows="5"></textarea>
                                    </div>

                                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">

                                    <h5><a href="library.php">View Library. </a></h5>
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