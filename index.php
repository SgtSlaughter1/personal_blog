<?php
include 'config/blog_connect.php';

$sqlQueries = 'SELECT * FROM blog_posts ORDER BY created_at DESC';

$result = mysqli_query($connect, $sqlQueries);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Blog Posts</title>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container my-2 text-end">
        <a href="create.php" class="btn btn-success btn-lg">Create New Post</a>
    </div>

    <div class="container my-5">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                // Loop through each post and display it
                while ($row = $result->fetch_assoc()) {
                    $title = htmlspecialchars($row['title']);
                    $content = htmlspecialchars($row['content']);
                    $created_at = date("F j, Y, g:i a", strtotime($row['created_at']));
                    $post_id = $row['id'];
            ?>
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="./uploads/1102017.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $title; ?></h5>
                                <p class="card-text"><?= substr($content, 0, 150); ?><a href="view.php?id=<?= $post_id; ?>">Read More</a></p>
                                <p class="card-text"><small class="text-muted">Posted on: <?= $created_at; ?></small></p>
                                <div class="d-flex">
                                    <div>

                                        <a href="edit.php?id=<?= $post_id; ?>" class="btn btn-primary btn-sm">Edit</a>
                                    </div>
 
                                    <form method="POST" class="mx-3" action="delete.php" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= $post_id; ?>">
                                        <input type="hidden" name="id_to_delete" value="<?= $post_id; ?>">
                                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal-<?= $post_id; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this post? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form method="POST" action="delete.php">
                                        <input type="hidden" name="id_to_delete" value="<?= $post_id; ?>">
                                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='alert alert-info'>No posts available.</div>";
            }

            mysqli_free_result($result);
            mysqli_close($connect);
            ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

<?php include 'includes/footer.php'; ?>

</html>