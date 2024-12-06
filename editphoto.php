<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$getPhotoByID = getPhotoByID($pdo, $_GET['photo_id']); 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Photo</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="editPhotoForm" style="display: flex; justify-content: center;">
        <form action="core/handleForms.php" method="POST" enctype="multipart/form-data">
            <p>
                <label for="#">Description</label>
                <input type="hidden" name="photo_id" value="<?php echo $_GET['photo_id']; ?>">
                <input type="text" name="photoDescription" value="<?php echo $getPhotoByID['description']; ?>">
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
                        $selected = $album['album_id'] == $getPhotoByID['album_id'] ? 'selected' : '';
                        echo "<option value='{$album['album_id']}' {$selected}>{$album['album_name']}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>
                <input type="submit" name="insertPhotoBtn" style="margin-top: 10px;">
            </p>
        </form>
    </div>
</body>
</html>
