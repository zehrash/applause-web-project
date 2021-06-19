console.log('opa');

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

addDefaultSounds();

const record = document.getElementById('record');
const stop = document.getElementById('stop');
const soundClips = document.getElementById('sound-clips');
let audioCtx;

//main block for doing the audio recording

if (navigator.mediaDevices.getUserMedia) {
    console.log('getUserMedia supported.');

    const constraints = { audio: true };
    let chunks = [];

    let onSuccess = function (stream) {
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
            const clipLabel = document.createElement('p');
            const audio = document.createElement('audio');

            audio.setAttribute('class', "sounds-button");
            clipContainer.classList.add('clip');
            audio.setAttribute('controls', '');

            if (clipName === null) {
                clipLabel.textContent = 'My unnamed clip';
            } else {
                clipLabel.textContent = clipName;
            }

            clipContainer.appendChild(audio);
            clipContainer.appendChild(clipLabel);
            soundClips.appendChild(clipContainer);

            audio.controls = true;
            const blob = new Blob(chunks, { 'type': 'audio/ogg; codecs=opus' });
            chunks = [];
            const audioURL = window.URL.createObjectURL(blob);
            audio.src = audioURL;
            console.log("recorder stopped");

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


    fetch('../helpers/logout.php', {
        method: 'GET'
    })
    .then(response =>
        response.json())
    .then(data => console.log(data));

    location.replace("../registration");

   /* var formData = new FormData();
    formData.append('username', userNameInputLog.value);
    formData.append('password', passInputLog.value);
    console.log('in'); */
});


