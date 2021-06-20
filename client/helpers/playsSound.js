const addSound = (elementId, audioLink) => {

    document.getElementById(elementId).addEventListener('click', (event) => {

        console.log(`in sound for ${elementId}`);
        const audio = new Audio(audioLink);
        audio.setAttribute('controls', '');
        audio.controls = true;
        audio.play();
        setTimeout(() => {
            audio.pause();
            console.log("Audio Stop Successfully");
        },
            10000);
    });
}

const playSound = (elementId, audioLink) => {

    document.getElementById(elementId).addEventListener('click', (event) => {
        console.log(`in sound for ${elementId}`);
        audio.play();
        setTimeout(() => {
            audio.pause();
            console.log("Audio Stop Successfully");
        },
            10000);
    });
}