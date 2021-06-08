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
        //console.error('yok');
    });

//USE THIS FOR SOUNDS
//https://developers.google.com/assistant/tools/sound-library

addSound('applause', "https://www.free-stock-music.com/music/sound-effects-library-applauding.mp3");
addSound('cheer', "https://actions.google.com/sounds/v1/crowds/team_cheer.ogg");
addSound('boo', "https://www.fesliyanstudios.com/play-mp3/4220");
addSound('slow-clap',"https://assets.mixkit.co/sfx/preview/mixkit-clapping-slowly-479.mp3" );
addSound('applause', );



