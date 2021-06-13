const eventNameInput = document.getElementById('eventName');
const eventDateInput = document.getElementById('eventDate');

document.getElementById('event-submit').addEventListener('click', (event) => {
  event.preventDefault();
  var formData = new FormData();
  formData.append('eventname', eventNameInput.value);
  formData.append('eventdate', eventDateInput.value);
  console.log('creating event');

  postData('../../server/createEvent.php', formData).then(data => data.json()).then(dataText => {
    console.log(dataText["message"]);
    document.getElementById("created-event-name").innerHTML = dataText["eventName"];
    let link = document.getElementById('created-event-link');
    createEventLink(link, dataText["eventId"]);
    modal.style.display = "block";
  });
});

const modal = document.getElementById("myModal");

const span = document.getElementsByClassName("close")[0];
span.onclick = function () {
  modal.style.display = "none";
}

window.onclick = (event) => {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function createEventLink(parent, eventId) {
  let link = document.createElement('a');
  link.setAttribute('href', `../../home/home/${eventId}`);
  link.setAttribute('target', "_blank");
  parent.value = link;
  console.log(parent.value);
}

document.getElementById("copy-link").addEventListener('click', event => displayCopied());
document.getElementById("copy-link").addEventListener('mouseout', event => outFunc());
function displayCopied() {
  var copyText = document.getElementById("created-event-link");

  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */
  document.execCommand("copy");
  
  let tooltip = document.getElementById("copyTooltip");
  tooltip.innerHTML = "Copied: " + copyText.value;
}
function outFunc() {
  var tooltip = document.getElementById("copyTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}
