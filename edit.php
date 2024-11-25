<?php
include "config/blog_connect.php";

// Update post
if (isset($_POST["update"])) {
    $title = mysqli_real_escape_string($connect, $_POST['title']);

    $content = mysqli_real_escape_string($connect, $_POST['content']);

    $id = mysqli_real_escape_string($connect, $_POST['id']);

    // Update query
    $query = "UPDATE blog_posts SET title='$title', content='$content' WHERE id='$id'";

    if (mysqli_query($connect, $query)) {
        header("Location: index.php");  
        exit;
    } else {
        echo "Error updating post: " . mysqli_error($connect);
    }
}

// Fetch post details for editing
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    $query = "SELECT * FROM blog_posts WHERE id='$id'";

    $result = mysqli_query($connect, $query);
    
    if ($result) {
        $post = mysqli_fetch_array($result);
        if ($post) {
            $title = $post['title'];
            $content = $post['content'];
        }
        mysqli_free_result($result);
    } else {
        echo "Error fetching post: " . mysqli_error($connect);
    }
    mysqli_close($connect);
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edit Post</title>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container my-5">
        <h2>Edit Post</h2>

        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($title); ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required><?= htmlspecialchars($content); ?></textarea>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update Post</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<?php include 'includes/footer.php'; ?>

</html>
