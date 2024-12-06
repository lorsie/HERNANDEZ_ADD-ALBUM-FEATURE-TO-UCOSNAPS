<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$album_id = $_GET['album_id'];
$album = getAlbumByID($pdo, $album_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Album</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="updateAlbumForm" style="display: flex; justify-content: center;">
        <form action="core/handleForms.php" method="POST">
            <p>
                <label for="#">Album Name</label>
                <input type="hidden" name="album_id" value="<?php echo $album_id; ?>">
                <input type="text" name="album_name" value="<?php echo $album['album_name']; ?>">
            </p>
            <p>
                <input type="submit" name="updateAlbumBtn" style="margin-top: 10px;" value="Update Album">
            </p>
        </form>
    </div>
</body>
</html>
