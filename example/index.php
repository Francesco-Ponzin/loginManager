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
                <label for="add_username">Username</label>
                <input type="text" name="username" id="add_username"><br>
                <label for="add_password">Password</label>
                <input type="password" name="password" id="add_password"><br>
                <label for="role-admin" >admin</label>
                <input type="radio" name="role" id="role-admin" ><br>
                <label for="role-guest">guest</label>
                <input type="radio" name="role" id="role-guest" checked><br>
                <label></label>
                <button id="add">Aggiungi</button>
            </div>

            <div class="formbox">
                <label for="remove_username">Username</label>
                <input type="text" name="username" id="remove_username"><br>
                <label></label>
                <button id="remove">Elimina</button>
            </div>

            <div class="formbox">
                <label for="login_username">Username</label>
                <input type="text" name="username" id="login_username"><br>
                <label for="login_password">Password</label>
                <input type="password" name="password" id="login_password"><br>
                <label></label>
                <button id="login">Login</button>
            </div>

            <div class="formbox">
                <label for="change_username">Username</label>
                <input type="text" name="username" id="change_username"><br>
                <label for="change_oldpassword">old Password</label>
                <input type="password" name="oldpassword" id="change_oldpassword"><br>
                <label for="change_password">new Password</label>
                <input type="password" name="password" id="change_password"><br>
                <label></label>
                <button id="change">Change</button>
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