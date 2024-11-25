<?php

include 'config/blog_connect.php';


if (isset($_GET['id'])) {
    $post_id = mysqli_real_escape_string($connect, $_GET['id']);


    $query = "SELECT * FROM blog_posts WHERE id = '$post_id'";

    $result = mysqli_query($connect, $query);

    if ($result->num_rows > 0) {
        $post = mysqli_fetch_assoc($result);

        $title = htmlspecialchars($post['title']);

        $content = htmlspecialchars($post['content']);

        $created_at = date("F j, Y, g:i a", strtotime($post['created_at']));
    } else {
        echo "Post not found.";
    }

    mysqli_free_result($result);

    mysqli_close($connect);

} else {
    echo "No post ID provided.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title><?= $title; ?></title>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container my-5">
        <h1><?= $title; ?></h1>
        <p><small class="text-muted">Posted on: <?= $created_at; ?></small></p>
        <p><?= $content; ?></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>

