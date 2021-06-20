const eventNameInput = document.getElementById('eventName');
const eventDateInput = document.getElementById('eventDate');

const populateWithEvents = () => {
  fetch('../../server/populateAdminPanel.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('Error loading events.');
      }
      return response.json();
    })
    .then(data => {
      console.log(data)
      populateEvents(data, 'event-list')
    })
    .catch(error => {
      console.log(error.message);
      console.error('Грешка при зареждане на евентите.');
    });
}

const populateWithUsers = () => {

  fetch('../../server/populateWithUsers.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('Error loading users.');
      }
      return response.json();
    })
    .then(data => {
      console.log(data)
      populateUsers(data, 'user-list');
      attachInvites();
      attachHosting();
    })
    .catch(error => {
      console.log(error.message);
    });
}
window.addEventListener('load', (event) => {
  console.log('page is fully loaded');

  populateWithEvents();
  populateWithUsers();

});

attachLogout();

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
  document.getElementById('event-list').innerHTML = '';
  populateWithEvents();

}

window.onclick = (event) => {
  if (event.target == modal) {
    modal.style.display = "none";
    document.getElementById('event-list').innerHTML = '';
    populateWithEvents();
  }
}

const createEventLink = (parent, eventId) => {
  let link = document.createElement('a');
  link.setAttribute('href', `../home?eventId=${eventId}`);
  sessionStorage.setItem('eventId', eventId);
  link.setAttribute('target', "_blank");
  parent.value = link;
  console.log(parent.value);
}

document.getElementById("copy-link").addEventListener('click', event => displayCopied());
document.getElementById("copy-link").addEventListener('mouseout', event => removeDisplayCopied());
document.getElementById('go-to-event').addEventListener('click', event => {
    location.replace( `../host?eventId=${sessionStorage.getItem('eventId')}`);
});

const attachInvites = () => {
  const inviteButtons = document.getElementsByClassName('invite');
  Array.from(inviteButtons).forEach(btn => {
    btn.addEventListener('click', event => {
      const userId = btn.parentNode.id;
      let formData = new FormData();
      formData.append('userId', userId);
      formData.append('lastAddedEvent', sessionStorage.getItem('eventId'));
      postData('../../server/sendInvite.php', formData).then(data => data.json()).then(dataText => {
        console.log(dataText["message"])
        btn.disabled = true;
      });
      console.log(`sending invite to this dude with id: ${userId}`);
    })
  });
}

const attachHosting = () => {
  const inviteButtons = document.getElementsByClassName('admin');
  console.log('attaching hosting')
  Array.from(inviteButtons).forEach(btn => {
    btn.addEventListener('click', event => {
      const userId = btn.parentNode.id;
      let formData = new FormData();
      formData.append('userId', userId);
      formData.append('role', 'host');
      postData('../../server/makeHost.php', formData).then(data => data.json()).then(dataText => {
        console.log(dataText["message"])
        btn.disabled = true;
      });
      console.log(`make this dude with id: ${userId} a host`);
    })
  });
}


