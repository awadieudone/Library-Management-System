<?php
// ------------Add book-------------
if($conn && isset($_POST['submit'])) {
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    echo $created_at = date('l jS \of F Y h:i:s A');
    move_uploaded_file($image_temp, "images/$image");

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

// ------------Add User---------------
if(isset($_POST['submit-reg'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];

    $errors = array();

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    // if (empty($role)) { array_push($errors, "Role is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    if ($password != $passwordConf) {
      array_push($errors, "The two passwords do not match");
    }

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
  
    if ($user) { // if user exists
        if ($user['username'] === $username) {
        array_push($errors, "Username already exists");
        }
    }

    if (count($errors) == 0) {
        $password = md5($password);//encrypt the password before saving in the database
  
        $query = "INSERT INTO users(firstname, lastname, username,role,email,password)";
        $query .= " VALUES('$firstname','$lastname','$username','$role','$email','$password')";
        $insert_result = mysqli_query($conn,$query);

        $user_id = $conn->insert_id;
        
        if(!$insert_result) {
            die("Failed to Register user ".mysqli_error($conn));
        } else {
            $_SESSION['role'] = $role;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['reg-success'] = "Welcome To The Library ";
            header("Location: index.php");
            exit(0);
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
        header("Location: ../user_library.php");
        exit();
    }
}

// -----------Approve-----------------
if(isset($_GET['approve_id'])) {

    $approve_id = $_GET['approve_id'];

    $query = "SELECT * FROM books WHERE id = $approve_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $books = mysqli_fetch_assoc($result);
        // echo "<pre>", print_r($books), "</pre>"; die();
        $book_image = $books['image'];
        $book_title = $books['title'];
        $book_author = $books['author'];
        $book_isbn = $books['isbn'];
        $book_description = mysqli_real_escape_string($conn, $books['description']);
        $borrowed_date = "";
        $return_date = "";

        $user_id = $_SESSION['id'];
        $b_query = "INSERT INTO borrowed_books 
                        (user_id, title, image, author, isbn, description, borrow_date, return_date) 
                    VALUES 
                        ($user_id,'$book_title','$book_image','$book_author','$book_isbn','$book_description',CURDATE(),CURDATE()+7)";
        $b_result = mysqli_query($conn, $b_query);

        if (!$b_result) {
            die(mysqli_error($conn));
        } else {
            header("Location: applied.php");
            exit();
        }
    }
}
if(isset($_GET['disapprove_id'])) {
    $book_id = $_GET['disapprove_id'];
    
    $query = "DELETE FROM borrowed_books WHERE id=$book_id ";
    $delete_result = mysqli_query($conn, $query);
    
    if(!$delete_result) {
        die("Database Error: Failed to delete book" . mysqli_error($conn));
    } else {   
        header("Location: applied.php");
        exit(0);
    }
}

// ----------Borrowed Books---------
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
        $b_result = mysqli_query($conn,$b_query);
        
        if(!$b_result) {
            die(mysqli_error($conn));
        } else {
            header("Location: borrowedBooks.php");
            exit();
        }

    }
   
}

// ---------------Edit--------------
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
    $result = mysqli_query($conn, $query);

    if($result) {
        $_SESSION['book_id'] = $book_id;
        $_SESSION['edit-success'] = "book edited.";
    }
    header("Location: library.php");
}

// --------------------Library---------------
if(isset($_GET['delete_id'])) {
    $book_id = $_GET['delete_id'];
    
    $query = "DELETE FROM books WHERE id=$book_id ";
    $delete_result = mysqli_query($conn, $query);
    
    if(!$delete_result) {
        die("Database Error: Failed to delete book" . mysqli_error($conn));
    } else {   
        $_SESSION['del-success'] = "Task Deleted";
        header("Location: library.php");
        exit(0);
    }
}


// ------------Users----------------
if(isset($_GET['delete_id'])) {
    $user_id = $_GET['delete_id'];
    
    $query = "DELETE FROM users WHERE id=$user_id ";
    $delete_result = mysqli_query($conn, $query);
    
    
    if(!$delete_result) {
        die("Nothing!".mysqli_error($conn));
    } else {   
        $_SESSION['delete'] = "User Deleted";
        header("Location: users.php");
        exit(0);
    }
    
}


?>