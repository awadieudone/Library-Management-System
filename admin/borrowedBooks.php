<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "myLibrary");

if(isset($_GET['approve_id'])){
    $approve_id = $_GET['approve_id'];

    $query = "SELECT * FROM books WHERE id = $approve_id";
    $result= mysqli_query($conn, $query);

    if($result) {
        $books = mysqli_fetch_assoc($result);
        $book_image = $books['image'];
        $book_title = $books['title'];
        $book_author = $books['author'];
        $book_isbn = $books['isbn'];
        $book_description = $books['description'];
        $approve_date = $_SESSION['apply_date'];

        $b_query  = "INSERT INTO borrowed_books 
            (image,title,author,isbn,description,borrow_date,return_date) 
                    VALUES
            ('$book_image','$book_title','$book_author','$book_isbn','$book_description',$approve_date,$approve_date+7)";
        // var_dump($b_query);die();
        $b_result = mysqli_query($conn,$b_query);
        
        if(!$b_result) {
            die(mysqli_error($conn));
        } else {
            header("Location: borrowedBooks.php");
            exit();
        }

    }
   
}
    
if(isset($_GET['return_id'])) {
    echo $book_id = $_GET['return_id'];
    
    $query = "DELETE FROM borrowed_books WHERE id=$book_id ";
    $delete_result = mysqli_query($conn, $query);
    
    
    if(!$delete_result) {
        die("Nothing!".mysqli_error($conn));
    } else {   
        $_SESSION['delete'] = "Task Deleted";
        header("Location: borrow.php");
        exit(0);
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
                <div class="row">
                    <div class="col-lg-12" id="user-table">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small>Subheading</small>
                        </h1>

                        <div class="col-xs-12">
                            <div>
                                <h1 id="t_head">Borrowed Books</h1>
                                <h3 style="float: right;"><a href="library.php"><i class="fa fa-book"></i> View Library</a></h3>
                                <table>
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Book Titile</th>
                                        <th>Book Author</th>
                                        <th>Book isbn</th>
                                        <th>Book Description</th>
                                        <th>Borrowed Date</th>
                                        <th>Return Date</th>
                                    </tr>
                                    
                                    <?php
                                    $query = "SELECT * FROM borrowed_books";
                                    $result= mysqli_query($conn, $query);
                                    
                                    $key = 1;
                                    while($row = mysqli_fetch_array($result)) {
                                        $approve_id = $row['id'];
                                        $book_image = $row['image'];
                                        $book_title = $row['title'];
                                        $book_author = $row['author'];
                                        $book_isbn = $row['isbn'];
                                        $book_description = $row['description'];
                                        $borrowed_date = $row['borrow_date'];
                                        $return_date = $row['return_date'];
                                    ?>
                                    <tr>
                                        <td><?php echo ++$key; ?></td>
                                        <td><img style="height: 60px; border-radius: 50%; width: 50px; text-align: center;" src="../images/<?php echo $book_image; ?>" ></td>
                                        <td><?php echo $book_title; ?></td>
                                        <td><?php echo $book_author; ?></td>
                                        <td><?php echo $book_isbn; ?></td>
                                        <td style="width: 250px; height: 60px;"><?php echo $book_description; ?></td>
                                        <td><?php echo $borrowed_date; ?></td>
                                        <td><?php echo $return_date; ?></td>

                                    </tr>
                                <?php } ?>
                                    
                                </table>

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