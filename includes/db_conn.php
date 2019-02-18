<?php
$conn = mysqli_connect("localhost", "root", "", "myLibrary");
if(!$conn) {
    die("Connection Failed".mysqli_error($conn));
}
?>