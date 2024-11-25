<?php
include 'config/blog_connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (empty($title) || empty($content)) {
        $error = "Please fill in all fields";
    } elseif (strlen($title) < 5) {
        $error = "Title must be at least 5 characters long";
    } else {
        $title = mysqli_real_escape_string($connect, $title);
        $content = mysqli_real_escape_string($connect, $content);

        $sql = "INSERT INTO blog_posts (title, content) VALUES ('$title', '$content')";

        if (mysqli_query($connect, $sql)) {
            
            header("Location: index.php");
            exit();
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="mb-4">Create New Blog Post</h1>

                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <!-- Title field -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>"
                            required>
                    </div>

                    <!-- Content field -->
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control"
                            id="content"
                            name="content"
                            rows="6"
                            required><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save Post</button>
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Close database connection
mysqli_close($connect);
?>