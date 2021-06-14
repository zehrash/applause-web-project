const linkContainer = document.getElementById('links');
window.addEventListener('load', event => {
    refreshLinks();
});

setInterval(refreshLinks, 20000);//just call function every 20 seconds to check for new invites
function refreshLinks() {
    linkContainer.innerHTML = '';
    fetch('../../server/getLinks.php').then(data => data.json())
    .then(response => {
        if (response.success) {
            let events = response.value;
            events.forEach(e => constructEventLink(linkContainer, e));
            console.log(response.value);
        }
    })
    .catch(error => {
        console.log(error.message)
    });
}


function constructEventLink(container, eventId) {
    container.innerHTML += `<li><a href="../../home/home?eventId=${eventId}" target="_blank">link to event number ${eventId}</a> </li>`
}

document.getElementById('reserve').addEventListener('click', event => {
    const eventId = document.getElementById('event-code').value;
    let formData = new FormData();
    formData.append('eventId', eventId);
    postData('../../server/setEventId.php', formData).then(data => data.json()).then(dataText => {
        console.log(dataText["message"]);
        location.replace("../seatSelection/seatSelection.html");

    })
})