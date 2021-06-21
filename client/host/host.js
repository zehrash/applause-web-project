const TIME_LIMIT = 10;

let timePassed = 0;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
let formData = null;
const groups = document.getElementById('groups');
const rows = document.getElementById('rows');


const params = new URLSearchParams(window.location.search); //to get the query string params

window.addEventListener('load', event => {
    console.log(params);
    if (sessionStorage.getItem('eventId') == null) {
        console.log('opa');
        if (params.has('eventId'))
            sessionStorage.setItem('eventId', params.get('eventId'));
    }
})

attachLogout();

const startTimer = () => {

    timerInterval = setInterval(() => {

        timePassed = timePassed += 1;
        timeLeft = TIME_LIMIT - timePassed;
        document.getElementById("base-timer-label").innerHTML = formatTimeLeft(timeLeft);
        if (timeLeft === 0) {
            if (formData != null) {
                postData('../../server/sendCommand.php', formData).then(data => data.json()).then(dataText => {
                    console.log(dataText["message"]);
                    formData = null;
                    timePassed = 0;
                    timeLeft = TIME_LIMIT;
                });
            }
            clearInterval(timerInterval);

            timePassed = 0;
            timeLeft = TIME_LIMIT;
            timerInterval = null;
            formData = null;
        }
    }, 1000);
}

document.getElementById('base-timer-label').innerHTML = formatTimeLeft(timeLeft);
startTimer();

const closeTimerCycle = () => {
    startTimer();
}
setInterval(closeTimerCycle, 10000);


document.getElementById('send-command').addEventListener('click', event => {
    const commandText = document.getElementById("command").value;
    formData = new FormData();
    formData.append('text', commandText);
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    formData.append('eventId', sessionStorage.getItem('eventId'));
    formData.append('group', groups.value);
    formData.append('row', rows.value);
})
