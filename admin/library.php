<?php session_start(); ?>
<?php 
$conn = mysqli_connect("localhost", "root", "", "myLibrary");

if(isset($_GET['delete_id'])) {
    $book_id = $_GET['delete_id'];
    
    $query = "DELETE FROM books WHERE id=$book_id ";
    // var_dump($query);die();
    $delete_result = mysqli_query($conn, $query);
    
    if(!$delete_result) {
        die("Database Error: Failed to delete book" . mysqli_error($conn));
    } else {   
        $_SESSION['del-success'] = "Task Deleted";
        header("Location: library.php");
        exit(0);
    }
}

    $query = "SELECT * FROM books ";
    $result= mysqli_query($conn, $query);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                <div class="row" id="user-table">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Manage Books
                            <small>Subheading</small>
                        </h1>
                        
                        <div class="col-xs-12">
                        <div class="content">
                            <h3 class="mssge"><?php 
                                if(isset($_SESSION['reg-success'])) {
                                    echo  $_SESSION['reg-success'] . $_SESSION['username'];
                                    unset($_SESSION['reg-success']);
                                }
                            ?></h3>
                            <h3 class="mssge">
                                <?php
                                if(isset($_SESSION['edit-success'])) {
                                    echo $_SESSION['edit-success'];
                                    unset($_SESSION['edit-success']);
                                }
                                ?>
                            </h3>

                            <div class="addbook">
                                <h4><a href="addBook.php"><i class="fa fa-plus-circle"></i> Add Book</a></h4>
                            </div>

                        <table>
                            <tr>
                                <th>Image</th>
                                <th>Book Titile</th>
                                <th>Book Author</th>
                                <th>Book isbn</th>
                                <th>Book Description</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>

                                <?php foreach($books as $book): ?>
                                <tr>
                                    <td>
                                        <img style="height: 60px; border-radius: 50%; width: 50px; text-align: center;" src="../images/<?php echo $book['image']; ?>" >
                                    </td>
                                    <td><?php echo $book['title']; ?></td>
                                    <td><?php echo $book['author']; ?></td>
                                    <td><?php echo $book['isbn']; ?></td>
                                    <td style="width: 200px; max-height: 100px"><?php
                                    $strcut = substr($book['description'], 0, 150);
                                    @$book['description'] = substr($strcut, 0, strrpos($strcut, ' ').'...');
                                    echo $book['description']; 
                                    ?>
                                    </td>
                                    <td><?php echo $book['created_at']; ?></td>
                                    <td><?php echo $book['updated_at'] ?></td>
                                    <td>
                                        <a name="edit" class="btn btn-primary" href="edit.php?edit_id=<?php echo $book['id']; ?>">Edit         </a>
                                        <a class="btn btn-danger" name="delete" href='library.php?delete_id=<?php  echo $book['id']; ?>'>X</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>


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