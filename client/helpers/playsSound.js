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


function addDefaultSounds(){
    addSound('applause', "https://www.free-stock-music.com/music/sound-effects-library-applauding.mp3");
    addSound('cheer', "https://actions.google.com/sounds/v1/crowds/team_cheer.ogg");
    addSound('boo', "https://www.fesliyanstudios.com/play-mp3/4220");
    addSound('slow-clap', "https://assets.mixkit.co/sfx/preview/mixkit-clapping-slowly-479.mp3");
    addSound('haha', "https://www.shockwave-sound.com/sound-effects/laugh-sounds/cannedlaugh.mp3");
    addSound('wow', "https://www.soundsnap.com/murmursurprise_largecrwd");
    addSound('yawn', "https://www.fesliyanstudios.com/play-mp3/4052");
}
