<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "myLibrary");
if(isset($_GET['borrow_id'])){
    $borrow_id = $_GET['borrow_id'];
    
    $query = "SELECT * FROM books WHERE id = $borrow_id";
    $result= mysqli_query($conn, $query);

    
    if($result) {
        $books = mysqli_fetch_assoc($result);
        
        $book_image = $books['image'];
        $book_title = $books['title'];
        $book_author = $books['author'];
        $book_isbn = $books['isbn'];
        $book_description = $books['description'];
        $borrowed_date = "";
        $return_date = "";

       
        // echo "<pre>", print_r($user), "</pre>";
        // die();
        
        $user_id = $_SESSION['id'];
        $b_query  = "INSERT INTO borrowed_books 
                        (user_id, image, title, author, isbn, description, borrow_date, return_date) 
                    VALUES 
                        ($user_id,'$book_image','$book_title','$book_author','$book_isbn','$book_description',CURDATE(),CURDATE()+7)";
        // var_dump($b_query);die();
        $b_result = mysqli_query($conn, $b_query);
        
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
                        
                        <ul id="option">
                            <li id="user">
                                <?php if(isset($_SESSION['username'])): ?>
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

        <section class="header">
            <h1>My Book Library</h1>
        </section>

<div id="content">
    <table>
        <tr>
            <th>Image</th>
            <th>Book Titile</th>
            <th>Book Author</th>
            <th>Book isbn</th>
            <th>Book Description</th>
            <th>Borrowed Date</th>
            <th>Return Date</th>
        </tr>
        
        <?php
        $query = "SELECT * FROM borrowed_books WHERE user_id=" . $_SESSION['id'];
        // var_dump($query); die();
        $result= mysqli_query($conn, $query);
        
        $key = 1;
        while($row = mysqli_fetch_array($result)) {
            $borrow_id = $row['id'];
            $book_image = $row['image'];
            $book_title = $row['title'];
            $book_author = $row['author'];
            $book_isbn = $row['isbn'];
            $book_description = $row['description'];
            $borrowed_date = $row['borrow_date'];
            $return_date = $row['return_date'];
        ?>
            <tr>
            <td><img src="images/<?php echo $book_image; ?>" style="height: 60px; width: 50px; border-radius: 50%; text-align: center;" ></td>
                <td><?php echo $book_title; ?></td>
                <td><?php echo $book_author; ?></td>
                <td><?php echo $book_isbn; ?></td>
                <td><?php
                $strcut = substr($book_description, 0, 150);
                @$book_description = substr($strcut, 0, strrpos($strcut, ' ').'...');
                echo $book_description; 
                ?>
                </td>
                <td><?php echo $borrowed_date; ?></td>
                <td><?php echo $return_date; ?></td>

            </tr>
    <?php } ?>
        
    </table>

    <h2><a href="user_library.php"><i class="fa fa-book"></i> View Library</a></h2>
</div>
    <div class="footer">
        <p>This is the footer</p>
    </div>
</body>
</html>