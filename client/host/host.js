const TIME_LIMIT = 10;

let timePassed = 0;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
let formData = null;
function startTimer() {
  
    timerInterval = setInterval(() => {
        timePassed = timePassed += 1;
        timeLeft = TIME_LIMIT - timePassed;

        document.getElementById("base-timer-label").innerHTML = formatTimeLeft(timeLeft);
        if(timeLeft === 0){
            clearInterval(timerInterval);
            if(formData!=null){
                postData('../../server/sendCommand.php', formData).then(data => data.json()).then(dataText => {
                    console.log(dataText["message"]);
                    formData = null;
                    timePassed=0;
                    timeLeft = TIME_LIMIT;
                    startTimer();
                });
            }
        }
    }, 1000);
}

document.getElementById('base-timer-label').innerHTML = formatTimeLeft(timeLeft);

startTimer();
document.getElementById('send-command').addEventListener('click', event => {
    const commandText = document.getElementById("command").value;
    formData = new FormData();
    formData.append('text', commandText);
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date + ' ' + time;
    // formData.append('execution', dateTime);//todo: fix date format
    formData.append('eventId', sessionStorage.getItem('eventId'));

})