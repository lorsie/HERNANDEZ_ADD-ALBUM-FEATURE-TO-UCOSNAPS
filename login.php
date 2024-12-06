<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/styles.css">

    <body style="background-color: #ceb5b7;"> </body> 

</head>

    <?php  
    if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

        if ($_SESSION['status'] == "200") {
            echo "<h1 style='color: green;'>{$_SESSION['message']}</h1>";
        } else {
            echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";	
        }

        unset($_SESSION['message']);
        unset($_SESSION['status']);
    }
    ?>
    <h1>Login Now!</h1>
    <form action="core/handleForms.php" method="POST">
        <p>
            <label for="username">Username</label>
            <input type="text" name="username" required>
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </p>
        <div class="form-actions">
            <input type="submit" name="loginUserBtn" value="Login" style="margin-top: 25px;">
            <p>Don't have an account? You may <a href="register.php">register here</a>.</p>
        </div>
    </form>
</body>
</html>