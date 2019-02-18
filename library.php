<?php session_start(); ?>
<?php include "includes/db_conn.php"; ?>
<?php include "includes/authentications.php";?>
<?php include "includes/header.php";?>

        <section class="header">
            <h1>Book Library</h1>
        </section>

        <div class="content" id="content">
        
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
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $book_id = $row['id'];
            $book_image = $row['image'];
            $book_title = $row['title'];
            $book_author = $row['author'];
            $book_isbn = $row['isbn'];
            $book_description = $row['description'];
            ?>
            <tr>
                <td><img style="height: 60px; width: 50px; text-align: center; border-radius: 50%;" src="images/<?php echo $book_image; ?>" alt=""></td>
                <td> <a href=""> <?php echo $book_title; ?></a></td>
                <td><?php echo $book_author; ?></td>
                <td><?php echo $book_isbn; ?></td>
                <td style="width: 150px; height: 50px">
                <?php
                    $strcut = substr($book_description, 0, 50);
                    @$book_description = substr($strcut, 0, strrpos($strcut, ' ') . '...');
                    echo $book_description;
                ?>
                <button type="button" class="btn btn-danger">Read More</button>
                </td>
            </tr>
    <?php

}
?>
    </table>

</div>
<?php include "includes/footer.php"; ?>