let loginManagerMainFolder = "../source/";

document.getElementById("login").addEventListener("click", function () {

    let model = {
        username: document.getElementById("login_username").value,
        password: document.getElementById("login_password").value,

    }
    fetch(loginManagerMainFolder + 'login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        body: 'model=' + JSON.stringify(model)
    }).then(
        response => response.json()
    ).then(
        data => updatePageWithUserData(data)
    );
})


document.getElementById("add").addEventListener("click", function () {

    let model = {
        username: document.getElementById("add_username").value,
        password: document.getElementById("add_password").value,
        action: "add",
        role: document.getElementById("role-admin").checked ? "admin" : "guest" 
    }

    fetch(loginManagerMainFolder + 'user_manager.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        body: 'model=' + JSON.stringify(model)
    }).then(
        response => response.json()
    ).then(
        data => console.log(data)
    ).then(getUserList);
})

document.getElementById("remove").addEventListener("click", function () {

    let model = {
        username: document.getElementById("remove_username").value,
        action: "remove",
    }

    fetch(loginManagerMainFolder + 'user_manager.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        body: 'model=' + JSON.stringify(model)
    }).then(
        response => response.json()
    ).then(
        data => console.log(data)
    ).then(getUserList);
})

document.getElementById("change").addEventListener("click", function () {

    let model = {
        username: document.getElementById("change_username").value,
        password: document.getElementById("change_password").value,
        oldpassword: document.getElementById("change_oldpassword").value,
        action: "passwordchange",
    }

    fetch(loginManagerMainFolder + 'user_manager.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        body: 'model=' + JSON.stringify(model)
    }).then(
        response => response.json()
    ).then(
        data => console.log(data)
    ).then(getUserList);
})

document.getElementById("logout").addEventListener("click", function () {


    fetch(loginManagerMainFolder + 'login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        body: false
    }).then(
        response => response.json()
    ).then(
        data => updatePageWithUserData(data)
    );
})

getUserList();
updatePageWithUserData()

function getUserList() {
    document.getElementById("usersbox").innerHTML = ""


    let model = {
        action: "loadall",
    }

    fetch(loginManagerMainFolder + 'user_manager.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        body: 'model=' + JSON.stringify(model)
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
                userRole.innerText = user.role ? user.role: "";
                row.append(username);
                row.append(userRole);
                table.append(row);
            }
            document.getElementById("usersbox").append(table);
        }
    );
}

function updatePageWithUserData(loggedUser){
    document.title =  loggedUser ? "Test User " + (loggedUser.username) : "Test User";
    document.getElementById("role-admin").disabled = !(loggedUser && loggedUser.role == "admin");
    document.getElementById("role-guest").checked |= document.getElementById("role-admin").disabled;

}