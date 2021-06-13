const eventNameInput = document.getElementById('eventName').value;
const eventDateInput = document.getElementById('eventDate').value;

document.getElementById('event-submit').addEventListener('click', (event) => {
    event.preventDefault();
    var formData = new FormData();
    formData.append('eventname', eventNameInput);
    formData.append('eventdate', eventDateInput);
    console.log('creating event');

    postData('../../server/createEvent.php', formData).then(data => data.json()).then(dataText => {
      console.log('event created')
        //todo: open modal popup here with event data
    });
});