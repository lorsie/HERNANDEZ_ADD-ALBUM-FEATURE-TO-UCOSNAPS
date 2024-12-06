<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <title>Home</title>
    <link rel="stylesheet" href="styles/styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ceb5b7;
        padding: 20px;
    }

    h1 {
        color: #333;
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="file"],
    
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"] {
        font-weight: bold;
    }
</style>
<body>
    <?php include 'navbar.php'; ?>

    <div class="createAlbumForm" style="display: flex; justify-content: center;">
        <form action="core/handleForms.php" method="POST">
            <p>
                <label for="#">Album Name</label>
                <input type="text" name="album_name">
            </p>
            <p>
                <input type="submit" name="createAlbumBtn" style="margin-top: 10px;" value="Create Album">
            </p>
        </form>
    </div>

    <div class="insertPhotoForm" style="display: flex; justify-content: center;">
        <form action="core/handleForms.php" method="POST" enctype="multipart/form-data">
            <p>
                <label for="#">Description</label>
                <input type="text" name="photoDescription">
            </p>
            <p>
                <label for="#">Photo Upload</label>
                <input type="file" name="image">
            </p>
            <p>
                <label for="#">Album</label>
                <select name="album_id">
                    <?php
                    $albums = getAlbumsByUser($pdo, $_SESSION['username']);
                    foreach ($albums as $album) {
                        echo "<option value='{$album['album_id']}'>{$album['album_name']}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>
                <input type="submit" name="insertPhotoBtn" style="margin-top: 10px;">
            </p>
        </form>
    </div>

    <?php $albums = getAlbumsByUser($pdo, $_SESSION['username']); ?>
    <?php foreach ($albums as $album) { ?>
        <div class="album">
            <h2><?php echo $album['album_name']; ?></h2>
            <a href="editAlbum.php?album_id=<?php echo $album['album_id']; ?>">Edit</a>
            <a href="deleteAlbum.php?album_id=<?php echo $album['album_id']; ?>">Delete</a>
            <?php
            $photos = getAllPhotos($pdo, $_SESSION['username']);
            foreach ($photos as $photo) {
                if ($photo['album_id'] == $album['album_id']) {
                    echo "<div class='photo'>";
                    echo "<img src='images/{$photo['photo_name']}' alt='{$photo['description']}'>";
                    echo "<p>{$photo['description']}</p>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    <?php } ?>
</body>
</html>
