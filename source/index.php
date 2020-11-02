<?php
    session_start();
    var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test User <?= $_SESSION["username"]?></title>
</head>
<body>

<form action="user_manager.php" method="post">
    <input type="text" name="model[username]" id="add_username">
    <input type="password" name="model[password]" id="add_password">
    <input type="hidden" name="model[action]" value="add">
    <input type="submit" value="Aggiungi">
</form>

<form action="login.php" method="post">
    <input type="text" name="model[username]" id="login_username">
    <input type="password" name="model[password]" id="login_password">
    <input type="submit" value="Login">
</form>

<form action="login.php" method="post">
    <input type="submit" value="Logout">
</form>
    
</body>
</html>





