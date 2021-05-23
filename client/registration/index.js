const userNameRegex = /^[a-z]{3,10}$/;

//const mailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
const passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,10}$/;

const userNameInput = document.getElementById('username');
const passInput = document.getElementById('password');

document.getElementById('register-btn').addEventListener('click', (event) => {
    event.preventDefault();
    validate(userNameInput, userNameRegex, 'username-validator');
    //TODO: UNCOMMENT LATER WHEN PASSWORD REGULATIONS ARE SET
    //validate(passInput, passRegex, 'pass-validator'); 

    if (validate(userNameInput, userNameRegex, 'username-validator')) {
        //&& validate(passInput, passRegex, 'pass-validator')) {
        callApi();
    }
});

function validate(input, regex, warningDivId) {
    if (regex.test(input.value)) {
        //console.log(input.value);
        //console.log('success');
        document.getElementById(warningDivId).style.display = 'none';
        document.getElementById(warningDivId).innerHTML = '';
        input.style.outline = '1px solid #79a06b';
        input.style.border = '1px solid #79a06b';
        return true;
    } else {
        switch (warningDivId) {
            case 'username-validator':
                document.getElementById(warningDivId).innerHTML = 'Невалидно потребителско име'; break;
            case 'pass-validator':
                document.getElementById(warningDivId).innerHTML = 'Невалидна парола'; break;
            default: break;
        }

        document.getElementById(warningDivId).style.display = 'block';
        input.style.outline = '1px solid #b0706d';
        input.style.border = '1px solid #b0706d';
        return false;
    }
}

function callApi() {
   // console.log('calling api')
     var jqxhr = $.post("../../server/entrypoint.php", (data) => {
           console.log(data);
        if ($('#already-exists').css("display") == "block") {
            $('#already-exists').css("display", "none");
        }
        /*data.forEach(element => {
            console.log(element.username);
            if (userNameInput.value === element.username) {
                $('#already-exists').html('There is already a user with this username');
                $('#already-exists').css("display", 'block');
            }
        });*/
    })
        .done(() => {
            if ($('#already-exists').css("display") !== "block") {
               // $('#success').html('You registered.');
                console.log('all good')
            }
        })
        .fail((ex) => {
            console.log(ex);
        })
}

