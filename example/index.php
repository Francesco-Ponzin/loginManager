<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test User <?= $_SESSION["username"] ?></title>
    <link rel="stylesheet" href="test.css">
</head>

<body>

    <div class="container">

        <div class="forms">
            <div class="formbox">
                <input type="text" name="username" id="add_username">
                <input type="password" name="password" id="add_password">
                <button id="add">Aggiungi</button>
            </div>

            <div class="formbox">
                <input type="text" name="username" id="remove_username">
                <button id="remove">Elimina</button>
            </div>

            <div class="formbox">
                <input type="text" name="username" id="login_username">
                <input type="password" name="password" id="login_password">
                <button id="login">Login</button>
            </div>

            <div class="formbox" id="logout">
                <button id="logout">Logout</button>
            </div>

        </div>

        <div id="usersbox">




        </div>




    </div>

    <script src="test.js"></script>
</body>

</html>