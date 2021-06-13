function populateEvents(events, containerId) {
    const element = document.getElementById(containerId);
    events.forEach((event) => {
        if (element) {
            element.innerHTML += `<li>${event.eventName} on ${event.date}</li>`;
        }
    });
}

function populateUsers(users, containerId) {
    const element = document.getElementById(containerId);
    users.forEach((user) => {
        if (element) {
            element.innerHTML += `<li id="${user.userId}">${user.username}, rating: ${user.rating}  <button class='invite'> Invite!</button></li>`;
        }
    });
}
