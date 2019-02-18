<?php
session_start(); 
include "includes/db_conn.php"; 


// ------------ Borrow Book--------------------
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

        $user_id = $_SESSION['id'];
        $b_query  = "INSERT INTO borrowed_books 
                        (user_id, image, title, author, isbn, description, borrow_date, return_date) 
                    VALUES 
                        ($user_id,'$book_image','$book_title','$book_author','$book_isbn','$book_description',CURDATE(),CURDATE()+7)";

        $b_result = mysqli_query($conn, $b_query);
        
        if(!$b_result) {
            die(mysqli_error($conn));
        } else {
            header("Location: ../../borrowedBooks.php");
            exit();
        }

    }
   
}


// ------------------Applied User-----------------------
if(isset($_GET['apply_id'])){
    $apply_id = $_GET['apply_id'];
    $user_id = $_SESSION['id'];

    $b_query  = "INSERT INTO applied_books (user_id, book_id, apply_date) VALUES ($user_id, $apply_id, CURDATE())";
    $b_result = mysqli_query($conn, $b_query);
    
    if(!$b_result) {
        die("Database Error: Failed to apply for book. " . mysqli_error($conn));
    } else {
        header("Location: user_library.php");
        exit();
    }
}
