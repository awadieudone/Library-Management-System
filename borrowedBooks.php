<?php 

include "app/books/books.php"; ?>

<?php include "includes/header.php";?>

        <section class="header">
            <h1>My Book Library</h1>
        </section>

<div id="content">
<h2><a href="user_library.php"><i class="fa fa-book"></i> View Library</a></h2>
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

</div>
<?php include "includes/footer.php"; ?>