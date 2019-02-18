<?php

// if(isset($_GET['return_id'])) {
//     echo $book_id = $_GET['return_id'];
    
//     $query = "DELETE FROM borrowed_books WHERE id=$book_id ";
//     $delete_result = mysqli_query($conn, $query);
    
    
//     if(!$delete_result) {
//         die("Nothing!".mysqli_error($conn));
//     } else {   
//         $_SESSION['delete'] = "Task Deleted";
//         header("Location: borrow.php");
//         exit(0);
//     }
    
// }


// -------------Library-------------------
if (isset($_GET['delete_id'])) {
    $book_id = $_GET['delete_id'];

    $query = "DELETE FROM books WHERE id=$book_id ";
    $delete_result = mysqli_query($conn, $query);


    if (!$delete_result) {
        die("Nothing!" . mysqli_error($conn));
    } else {
        $_SESSION['del-success'] = "Task Deleted";
        header("Location: library.php");
        exit(0);
    }

}


