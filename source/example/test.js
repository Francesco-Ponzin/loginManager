let loginManagerMainFolder = "../";

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
        data => console.log(data)
    );
})


document.getElementById("add").addEventListener("click", function () {

    let model = {
        username: document.getElementById("add_username").value,
        password: document.getElementById("add_password").value,
        action: "add",
    }

    fetch(loginManagerMainFolder + 'user_manager.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        body: 'model=' + JSON.stringify(model)
    }).then(
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
        data => console.log(data)
    ).then(getUserList);
})

document.getElementById("logout").addEventListener("click", function () {


    fetch(loginManagerMainFolder + 'login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, // this line is important, if this content-type is not set it wont work
        body: false
    }).then(
        data => console.log(data)
    );
})

getUserList();

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
            for (let user of data) {
                let row = document.createElement("tr");
                let username = document.createElement("td");
                username.innerText = user.username;
                let userdata = document.createElement("td");
                userdata.innerText = user.userdata;
                row.append(username);
                row.append(userdata);
                table.append(row);
            }
            document.getElementById("usersbox").append(table);
        }
    );
}