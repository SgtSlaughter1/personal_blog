<?php
include 'config/blog_connect.php';

if (isset($_POST["delete"])) {
    // Sanitize the input
    $id_to_delete = mysqli_real_escape_string($connect, $_POST["id_to_delete"]);

    // Prepare the DELETE query
    $sqlQueries = "DELETE FROM blog_posts WHERE id = $id_to_delete";

    // Execute the query
    if (mysqli_query($connect, $sqlQueries)) {

        header("Location: index.php");
        exit;
    } else {
    
        echo "Error: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
