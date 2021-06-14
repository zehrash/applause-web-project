document.getElementById('reserve').addEventListener('click', event => {
    const eventId = document.getElementById('event-code').value;
    let formData = new FormData();
    formData.append('eventId', eventId);
    postData('../../server/setEventId.php', formData).then(data => data.json()).then(dataText => {
        console.log(dataText["message"]);
        location.replace("../seatSelection/seatSelection.html");

    })
})