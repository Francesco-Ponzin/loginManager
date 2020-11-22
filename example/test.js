let loginManagerMainFolder = "../source/";

document.getElementById("login").addEventListener("click", login)
document.getElementById("add").addEventListener("click", function () { add(document.getElementById("add_username").value, document.getElementById("add_password").value, document.getElementById("role-admin").checked ? "admin" : "guest") })

document.getElementById("remove").addEventListener("click", function () { remove(document.getElementById("remove_username").value,) })
document.getElementById("change").addEventListener("click", function () { changePassword(document.getElementById("change_username").value, document.getElementById("change_password").value, document.getElementById("change_oldpassword").value) })
document.getElementById("logout").addEventListener("click", logout)

getUserList();
loadUserData()

function add(username, password, role) {
    let model = {
        "action": "add",
        "username": username,
        "password": password,
        "role": role
    }

    fetch(loginManagerMainFolder + 'user_manager.php', {
        "method": 'POST',
        "headers": { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        "body": 'model=' + JSON.stringify(model)
    }).then(
        response => response.json()
    ).then(
        data => console.log(data)
    ).then(getUserList);
}

function remove(username) {
    let model = {
        "action": "remove",
        "username": username
    }

    fetch(loginManagerMainFolder + 'user_manager.php', {
        "method": 'POST',
        "headers": { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        "body": 'model=' + JSON.stringify(model)
    }).then(
        response => response.json()
    ).then(
        data => console.log(data)
    ).then(getUserList);
}

function changePassword(username, password, oldpassword) {
    let model = {
        "action": "passwordchange",
        "username": username,
        "password": password,
        "oldpassword": oldpassword,
    }

    fetch(loginManagerMainFolder + 'user_manager.php', {
        "method": 'POST',
        "headers": { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        "body": 'model=' + JSON.stringify(model)
    }).then(
        response => response.json()
    ).then(
        data => console.log(data)
    ).then(getUserList);
}

function login() {
    let model = {
        "username": document.getElementById("login_username").value,
        "password": document.getElementById("login_password").value,
        "action": "login"
    }
    fetch(loginManagerMainFolder + 'login.php', {
        "method": 'POST',
        "headers": { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        "body": 'model=' + JSON.stringify(model)
    }).then(
        response => response.json()
    ).then(
        data => loadUserData()
    );
}

function logout() {
    let model = {
        "action": "logout",
    }

    fetch(loginManagerMainFolder + 'login.php', {
        "method": 'POST',
        "headers": { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        "body": 'model=' + JSON.stringify(model)
    }).then(
        response => response.json()
    ).then(
        data => loadUserData()
    );
}

function getUserList() {
    document.getElementById("usersbox").innerHTML = ""

    let model = {
        "action": "loadall",
    }

    fetch(loginManagerMainFolder + 'user_manager.php', {
        "method": 'POST',
        "headers": { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        "body": 'model=' + JSON.stringify(model)
    }).then(
        response => response.json()
    ).then(
        (data) => {
            console.log(data)
            let table = document.createElement("table");
            table.classList.add("usersTable");
            let headrow = document.createElement("tr");
            let usernameH = document.createElement("th");
            let userRoleH = document.createElement("th");
            usernameH.innerText = "Username";
            userRoleH.innerText = "User role";
            headrow.append(usernameH);
            headrow.append(userRoleH);
            table.append(headrow);

            for (let user of data) {
                let row = document.createElement("tr");
                let username = document.createElement("td");
                username.innerText = user.username;
                let userRole = document.createElement("td");
                userRole.innerText = user.role ? user.role : "";
                row.append(username);
                row.append(userRole);
                table.append(row);
            }
            document.getElementById("usersbox").append(table);
        }
    );
}

function loadUserData() {
    let model = {
        "action": "load",
    }

    fetch(loginManagerMainFolder + 'login.php', {
        "method": 'POST',
        "headers": { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        "body": 'model=' + JSON.stringify(model)
    }).then(
        response => response.json()
    ).then(
        data => updatePageWithUserData(data)
    );
}

function updatePageWithUserData(loggedUser) {
    document.title = loggedUser ? "Test User " + (loggedUser.username) : "Test User";
    document.getElementById("role-admin").disabled = !(loggedUser && loggedUser.role == "admin");
    document.getElementById("role-guest").checked |= document.getElementById("role-admin").disabled;
}