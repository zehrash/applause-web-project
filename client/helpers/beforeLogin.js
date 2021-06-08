function chooseEntranceType() {
    document.getElementById('redirect-to-login').addEventListener('click', (event) => {
        event.preventDefault();
        document.getElementById('login-form').style.display = 'contents';
        document.getElementById('login-form').style.textAlign='center';
        document.getElementById('register-link').style.display = 'contents';
        document.getElementById('login-link').style.display = 'none';
        document.getElementById('register-form').style.display = 'none';
    });

    document.getElementById('redirect-to-register').addEventListener('click', (event) => {
        event.preventDefault();
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('register-link').style.display = 'none';
        document.getElementById('login-link').style.display = 'contents';
        document.getElementById('register-form').style.display = 'contents';
    });
}