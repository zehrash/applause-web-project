const userNameRegex = /^[a-z]{3,10}$/;
const passRegex = /^[a-z]{6,10}$/;
const ageRegex = /^[1-9][0-9]?$|^100$/;

const userNameInput = document.getElementById('username');
const passInput = document.getElementById('password');
const ageInput = document.getElementById('age');
const genderInput = document.getElementById('gender');
let isAdmin = false;


window.addEventListener('load', (event) => {
    console.log('page is fully loaded new');

    fetch('../../server/DAL/checkDbExistance.php')
        .then(response =>
            response.json()).then(data => {
            if (data["message"] === "no db, we creating one now") {
                createDb();
            }
        })
});

document.addEventListener('keyup', (event) => {
    if (event.key == "Alt") {
        isAdmin = true;
        document.getElementById('admin-registration').style.display = "contents";
    }
});

document.getElementById('register-btn').addEventListener('click', (event) => {
    event.preventDefault();
    validate(userNameInput, userNameRegex, 'username-validator');
    validate(passInput, passRegex, 'pass-validator');
    validate(ageInput, ageRegex, 'age-validator');

    if (validate(userNameInput, userNameRegex, 'username-validator') &&
        validate(passInput, passRegex, 'pass-validator') && validate(ageInput, ageRegex, 'age-validator')) {
        var formData = new FormData();
        formData.append('username', userNameInput.value);
        formData.append('age', ageInput.value);
        formData.append('gender', genderInput.value);
        if (isAdmin == true) {
            formData.append('role', 'admin');
        } else {
            formData.append('role', 'user');
        }
        formData.append('password', passInput.value);

        postData('../../server/entrypoint.php', formData).then(data => data.json()).then(dataText => {

            document.getElementById('form-container').innerHTML = '';
            console.log(dataText);
            if (isAdmin == true) {
                location.replace("../admin");
            } else {
                location.replace("../waitingRoom");
            }
        });
    }
});

const userNameInputLog = document.getElementById('username-log');
const passInputLog = document.getElementById('password-log');
document.getElementById('login-btn').addEventListener('click', (event) => {

    event.preventDefault();
    var formData = new FormData();
    formData.append('username', userNameInputLog.value);
    formData.append('password', passInputLog.value);

    postData('../../server/entrypoint.php', formData)
        .then(data => data.json())
        .then(dataText => {
            document.getElementById('form-container').innerHTML = '';

            if (dataText.value == 'admin') {
                location.replace("../admin");
            } else {
                location.replace("../waitingRoom");
            }
        });
});

chooseEntranceType();