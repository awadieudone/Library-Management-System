<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "myLibrary");


    $book_id = 0;
    $book = ""; 
    $author = "";
    $isbn = "";
    $description = "";

    if(isset($_GET['edit_id'])){
        $book_id = $_GET['edit_id'];

        $query = "SELECT * FROM books WHERE id=$book_id";
        $select_book_result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_array($select_book_result)){
            $book_id = $row['id'];
            $image = $row['image'];
            $book = $row['title'];
            $author = $row['author'];
            $isbn = $row['isbn'];
            $description = $row['description'];
        }

        $_SESSION['book_id'] = $book_id;
    }

    if(isset($_POST['update-book'])) {
        $image = $_POST['image'];
        $book = $_POST['title'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $description = $_POST['description'];
        
        $query = "UPDATE books SET image='$image', title=' $book', author='$author', isbn='$isbn', description='$description' 
                    WHERE id=".$_SESSION['book_id'];
        // var_dump($query);die();
        // die();
        $result = mysqli_query($conn, $query);

        if($result) {
            // $_SESSION['book_id'] = $book_id;
            $_SESSION['edit-success'] = "book edited.";
        }
        header("Location: library.php");
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
                        <a href="borrowedBooks.php"><i class="fa fa-fw fa-table"></i> Borrowed Books</a>
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
                <div class="row edit"  id="container">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small>Subheading</small>
                        </h1>

                        <div class="col-xs-12">
                            
                            <div>
                                <div class="form-head">
                                    <h2>Edit Book</h2>
                                </div>
                            <form action="edit.php" method="post">
                                <div class="input-group">
                                    <label for="image">Book Image: </label>
                                    <img style="border-radius: 50%; height: 100px; width: 60px;" src="../images/<?php echo $image?>" alt="">
                                    <input type="file" class="form-control" value="<?php echo $image; ?>" name="image">
                                </div>
                                <div class="input-group">
                                    <label for="title">Book Title: </label>
                                    <input type="text" class="form-control" value="<?php echo $book; ?>" name="title">
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
                                    <label for="description">Description: </label>
                                    <input type="text" class="form-control" value="<?php echo $description; ?>" name="description">
                                </div>

                                <input class="btn btn-primary" type="submit" name="update-book" value="Update">

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