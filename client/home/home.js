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

//document.getElementById("demo").innerHTML = `<h1> Welcome, ${dataText.username} aged ${dataText.age} </h1>`;


document.getElementById('applause').addEventListener('click', (event) => {
    //https://developer.mozilla.org/en-US/docs/Web/API/BaseAudioContext/createChannelMerger
    //
    //const audio = new Audio("https://audio-previews.elements.envatousercontent.com/files/293983985/preview.mp3");
    //https://www.sitepoint.com/php-authorization-jwt-json-web-tokens/
    //audio.play();
    console.log('applauding');
});