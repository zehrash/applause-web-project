const userNameRegex = /^[a-z]{3,10}$/;
const passRegex = /^[a-z]{6,10}$/;

const userNameInput = document.getElementById('username');
const passInput = document.getElementById('password');
const ageInput = document.getElementById('age');
const genderInput = document.getElementById('gender');

document.getElementById('register-btn').addEventListener('click', (event) => {
    event.preventDefault();
    validate(userNameInput, userNameRegex, 'username-validator');
    validate(passInput, passRegex, 'pass-validator');

    if (validate(userNameInput, userNameRegex, 'username-validator')
        && validate(passInput, passRegex, 'pass-validator')) {
        var formData = new FormData();
        formData.append('username', userNameInput.value);
        formData.append('age', ageInput.value);
        formData.append('gender', genderInput.value);
        formData.append('password', passInput.value);

        postData('../../server/entrypoint.php', formData).then(data => data.json()).then(dataText => {
            document.getElementById('form-container').innerHTML = '';
            console.log(dataText);
            document.getElementById("demo").innerHTML = `<h1> Welcome, ${dataText.username} aged ${dataText.age} </h1>`;
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
    console.log('in');
    
    postData('../../server/entrypoint.php', formData).then(data => data.json()).then(dataText => {
        document.getElementById('form-container').innerHTML = '';
        console.log(dataText);
        document.getElementById("demo").innerHTML = `<h1> Welcome, ${dataText.username} aged ${dataText.age} </h1>`;
    });
});

chooseEntranceType();

