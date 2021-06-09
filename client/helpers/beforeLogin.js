function chooseEntranceType() {
    document.getElementById('redirect-to-login').addEventListener('click', (event) => {
        document.getElementById('login-form').style.visibility='visible';
        document.getElementById('register-link').style.visibility='visible';
        document.getElementById('login-link').style.visibility='hidden';
        document.getElementById('register-form').style.visibility='hidden';

        document.getElementById('login-form').style.textAlign='center';
        document.getElementById('register-form').style.display = 'none'; 
    });

    document.getElementById('redirect-to-register').addEventListener('click', (event) => {
        event.preventDefault();
        document.getElementById('register-form').style.visibility = 'visible';
        document.getElementById('register-form').style.display='contents';

        document.getElementById('login-form').style.visibility = 'hidden';
        document.getElementById('register-link').style.visibility = 'hidden';
        document.getElementById('login-link').style.visibility = 'visible';
    });
}