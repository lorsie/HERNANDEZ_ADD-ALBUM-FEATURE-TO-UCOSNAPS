<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$getUserByID = getUserByID($pdo, $_GET['username']); 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container" style="display: flex; justify-content: center;">
        <div class="userInfo" style="background-color: ghostwhite; border-style: solid; border-color: gray;width: 50%; text-align: center;">
            <h3>Username: <span style="color: blue"><?php echo $getUserByID['username']; ?></span></h3>
            <h3>First Name: <span style="color: blue"><?php echo $getUserByID['first_name']; ?></span></h3>
            <h3>Last Name: <span style="color: blue"><?php echo $getUserByID['last_name']; ?></span></h3>
            <h3>Date Joined: <span style="color: blue"><?php echo $getUserByID['date_added']; ?></span></h3>
        </div>
    </div>

    <?php $albums = getAlbumsByUser($pdo, $_GET['username']); ?>
    <?php foreach ($albums as $album) { ?>
        <div class="album" style="display: flex; justify-content: center; margin-top: 25px;">
            <div class="albumContainer" style="background-color: ghostwhite; border-style: solid; border-color: gray;width: 50%;">
                <h2><?php echo $album['album_name']; ?></h2>
                <?php
                $photos = getAllPhotos($pdo, $_GET['username']);
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
        </div>
    <?php } ?>
</body>
</html>
