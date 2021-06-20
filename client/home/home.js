fetch('../../server/userpanel.php', {
    method: 'GET'
})
    .then((response) => {
        if (!response.ok) {
            throw new Error('Error getting user.');
        }
        return response.json();
    })
    .then(response => {
        if (response.success) {
            document.getElementById('welcome-text').innerHTML = response.value;
            console.log(response.value);
        }
    })
    .catch(error => {
        console.log(error)
    });


const record = document.getElementById('record');
const stop = document.getElementById('stop');
const soundClips = document.getElementById('sound-clips');
let audioCtx;
const TIME_LIMIT = 10;

let timePassed = 0;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
let formData = null;
let  fetched = false;
const startTimer = () => {

    timerInterval = setInterval(() => {
        timePassed = timePassed += 1;
        timeLeft = TIME_LIMIT - timePassed;

        document.getElementById("base-timer-label").innerHTML = formatTimeLeft(timeLeft);
        if (timeLeft === 0) {
            clearInterval(timerInterval);
            timePassed = 0;
            timeLeft = TIME_LIMIT;
            timerInterval = null;
            formData = null;
            fetchCommand();
           
            /*const aud = document.getElementById('loadedSound');
            console.log('playing')
            console.log(aud);
            aud.play();
            aud.id='';*/
            
        }
    }, 1000);
}

document.getElementById('base-timer-label').innerHTML = formatTimeLeft(timeLeft);
startTimer();


const closeTimerCycle = () => {
    startTimer();
}


setInterval(closeTimerCycle, 10000);
//main block for doing the audio recording

const audios = document.getElementsByTagName('audio');
let flag = false;


//im sorry.
const waitForTimerToFinish = (event) => {
    
    if(!flag) {
        event.target.id = 'loadedSound';
        document.getElementById('loadedSound').pause();
        console.log('pausing')
        let interval = setInterval(() =>{
            console.log(timeLeft);
            if(timeLeft == 1)
            {
                let aud = document.getElementById('loadedSound');
                aud.play();
                flag = true;
                clearInterval(interval);
                aud.id = '';
            }
        }, 1000);
    }  
   else {
        flag = false;
   }
};


Array.from(audios).forEach(au => {
    au.addEventListener('play', waitForTimerToFinish);
})


if (navigator.mediaDevices.getUserMedia) {
    console.log('getUserMedia supported.');

    const constraints = { audio: true };
    let chunks = [];

    let onSuccess = async function (stream) {
        const mediaRecorder = new MediaRecorder(stream);

        record.onclick = function () {
            mediaRecorder.start();
            console.log(mediaRecorder.state);
            console.log("recorder started");
            record.style.background = "red";

            stop.disabled = false;
            record.disabled = true;
        }

        stop.onclick = function () {            
            document.getElementById("custom-sounds").style.visibility='visible';
            mediaRecorder.stop();
            console.log(mediaRecorder.state);
            console.log("recorder stopped");
            record.style.background = "";
            record.style.color = "";

            stop.disabled = true;
            record.disabled = false;
        }

        mediaRecorder.onstop = function (e) {
            console.log("data available after MediaRecorder.stop() called.");

            const clipName = prompt('Enter a name for your sound clip?', 'My unnamed clip');
            const clipContainer = document.createElement('li');
            const clipLabel = document.createElement('label');
            const audio = document.createElement('audio');
            
            audio.setAttribute('class', "sounds-button");
            clipContainer.classList.add('clip');
            audio.setAttribute('controls', '');

            if (clipName === null) {
                clipLabel.textContent = 'My unnamed clip';
            } else {
                clipLabel.textContent = clipName;
            }
    

            clipLabel.setAttribute('class', 'sound-name');
            audio.setAttribute('class', 'custom-sound');
            clipContainer.appendChild(clipLabel);
            clipContainer.appendChild(audio);
            clipContainer.style.paddingBottom="5px";
            soundClips.appendChild(clipContainer);

            audio.controls = true;
            const blob = new Blob(chunks, { 'type': 'audio/ogg; codecs=opus' });
            chunks = [];
            const audioURL = window.URL.createObjectURL(blob);
            audio.src = audioURL;
            console.log("recorder stopped");
            document.getElementById('custom-sounds').style.display = 'inline-block';
            const formData = new FormData();
            formData.append('userFile', blob, clipName);

            postData("../../server/saveaudio.php", formData).then(data => data.json()).then(text => console.log(text));

            clipLabel.onclick = function () {
                const existingName = clipLabel.textContent;
                const newClipName = prompt('Enter a new name for your sound clip?');
                if (newClipName === null) {
                    clipLabel.textContent = existingName;
                } else {
                    clipLabel.textContent = newClipName;
                }
            }
        }

        mediaRecorder.ondataavailable = function (e) {
            chunks.push(e.data);
        }
    }

    let onError = function (err) {
        console.log('The following error occured: ' + err);
    }

    navigator.mediaDevices.getUserMedia(constraints).then(onSuccess, onError);

} else {
    console.log('getUserMedia not supported on your browser!');
}

const handleFiles = (event) => {
    const files = event.target.files;
    console.log(files);
    document.getElementById('src').setAttribute('src', URL.createObjectURL(files[0]));

    const formData = new FormData();
    formData.append('userFile', files[0]);

    postData("../../server/saveaudio.php", formData).then(data => data.json()).then(text => console.log(text));

    document.getElementById("audio").load();
}

document.getElementById('redirect-to-login').addEventListener('click', (event) => {

    event.preventDefault();


    fetch('../../server/logout.php', {
        method: 'GET'
    })
        .then(response =>
            response.json())
        .then(data => console.log(data));

    location.replace("../registration");
});

const fetchCommand = () => {
    fetch('../../server/getCommand.php', {
        method: 'GET'
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Error getting command.');
            }
            return response.json();
        })
        .then(response => {
            if (response.success) {
                document.getElementById('command-text').innerText = response.value;
                console.log(response.value);
                fetched = true;
            }
        })
    /*
     .catch(error => {
         console.log(error)
     });*/

}

/*
function playH(){

    var audioPlay=document.getElementById("play-happy");
    var isPlaying=false;
    togglePlay();
}
function togglePlay(){
    isPlaying? audioPlay.pause(): audioPlay.play();
};

myAudio.onplaying=function(){
    isPlaying=true;
};

myAudio.onplaying=function(){
    isPlaying=false;
}; */

function togglePlayHappy(){
    var audioHappy=document.getElementById("play-happy");

    if(audioHappy.paused){
        audioHappy.play();
    }
    else {
        audioHappy.pause();
    }
}

function togglePlayNeutral(){
    var audioHappy=document.getElementById("play-neutral");

    if(audioHappy.paused){
        audioHappy.play();
    }
    else {
        audioHappy.pause();
    }
}

function togglePlaySad(){
    var audioHappy=document.getElementById("play-sad");

    if(audioHappy.paused){
        audioHappy.play();
    }
    else {
        audioHappy.pause();
    }
}


function playN(){
    var audioPlay=document.getElementById("play-neutral");
    audioPlay.play();
}
