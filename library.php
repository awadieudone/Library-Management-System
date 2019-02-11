<?php session_start(); ?>
<?php 
$conn = mysqli_connect("localhost", "root", "", "myLibrary");

if(isset($_GET['delete_id'])) {
    $book_id = $_GET['delete_id'];
    
    $query = "DELETE FROM books WHERE id=$book_id ";
    $delete_result = mysqli_query($conn, $query);
    
    
    if(!$delete_result) {
        die("Nothing!".mysqli_error($conn));
    } else {   
        $_SESSION['del-success'] = "Task Deleted";
        header("Location: library.php");
        exit(0);
    }
    
}


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
                        if((isset($_SESSION['username']) && isset($_SESSION['user_id'])) || isset($_SESSION['id'])) {
                            echo "<a id='username' href='borrowedBooks.php'><i class='fa fa-user'></i> " . $_SESSION['username']. "<i class='fa fa-fw fa-caret-down'></i></a>"; 
                         ?>
                        <ul>
                            <li><a href="borrowedBooks.php">My Books</a></li>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul>
                                <?php }else { ?>
                            </li>
                        </ul>
                    <li class="nav-item register">
                        <a href="register.php">Sign Up  <i class="fa fa-sign-in"></i></a>
                    </li>
                </ul>
                <?php } ?>
              
            </div>
          </nav>
    </div>

        <section class="header">
            <h1>Book Library</h1>
        </section>

       
        <div class="content" id="content">
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
    <table>
        <tr>
            <th>Image</th>
            <th>Book Titile</th>
            <th>Book Author</th>
            <th>Book isbn</th>
            <th>Book Description</th>
            <!-- <th></th> -->
            
        </tr>
        <?php

$book_id = $conn->insert_id;
        $query = "SELECT * FROM books ";
        $result= mysqli_query($conn, $query);

        while($row = mysqli_fetch_array($result)) {
            $book_id = $row['id'];
            $book_image = $row['image'];
            $book_title = $row['title'];
            $book_author = $row['author'];
            $book_isbn = $row['isbn'];
            $book_description = $row['description'];
?>
            <tr>
                <td><img style="height: 60px; width: 50px; text-align: center; border-radius: 50%;" src="images/<?php echo $book_image; ?>" alt=""></td>
                <td><?php echo $book_title; ?></td>
                <td><?php echo $book_author; ?></td>
                <td><?php echo $book_isbn; ?></td>
                <td style="width: 150px; height: 50px"><?php
                $strcut = substr($book_description, 0, 50);
                @$book_description = substr($strcut, 0, strrpos($strcut, ' ').'...');
                echo $book_description; 
                ?>
                <button type="button" class="btn btn-danger">Read More</button>
                </td>
                <!-- <td><a name="borrow" href="borrowedBooks.php?borrow_id=<?php echo $book_id; ?>">Borrow Book</a></td> -->
                
                

            </tr>
    <?php
        }
    ?>
    </table>

   
        </div>
        <div class="footer">
            <p>This page was created by Dieudonne Awa.</p>
        </div>
    
</body>
</html>