<?php 
include 'app/books/books.php'; 

include "includes/header.php";

?>

        <section class="header">
            <h1>Book Library</h1>
        </section>

       
        <div class="content" id="content">
        <h3 class="mssge">
            <?php 
                if (isset($_SESSION['reg-success'])) {
                    echo $_SESSION['reg-success'] . $_SESSION['username'];
                    unset($_SESSION['reg-success']);
                } else if(isset($_SESSION['login-success'])) {
                    echo $_SESSION['login-success'] . $_SESSION['username'];
                    unset($_SESSION['login-success']);
                }
                ?>
        </h3>
    <table>
        <tr>
            <th>Image</th>
            <th>Book Titile</th>
            <th>Book Author</th>
            <th>Book isbn</th>
            <th>Created on</th>
            <th>Action</th>
        </tr>
        <?php

        $book_id = $conn->insert_id;
        $query = "SELECT * FROM books ";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $book_id = $row['id'];
            $book_image = $row['image'];
            $book_title = $row['title'];
            $book_author = $row['author'];
            $book_isbn = $row['isbn'];
            $book_description = $row['description'];
            $created_at = $row['created_at'];
            $updated_at = $row['updated_at'];
            ?>
            <tr>
                <td><img style="height: 60px; width: 50px; text-align: center; border-radius: 50%;" src="images/<?php echo $book_image; ?>" alt=""></td>
                <td><a href="details/book_details.php?readmore_id=<?php echo $book_id; ?>"><?php echo $book_title; ?></a></td>
                <td><?php echo $book_author; ?></td>
                <td><?php echo $book_isbn; ?></td>
                <td><?php echo $created_at; ?></td>
                <td>
                    <a name="apply" class="btn btn-info" style="margin: 15px;" href="http://localhost/myLibrary/user_library.php?apply_id=<?php echo $book_id; ?>">Apply</a>
                </td>
               
            </tr>
    <?php

}
?>
    </table>

   
        </div>
        <?php include "includes/footer.php"; ?>