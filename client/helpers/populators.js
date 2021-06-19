const populateEvents = (events, containerId) => {
    const element = document.getElementById(containerId);
    events.forEach((event) => {
        if (element) {
            element.innerHTML += `<li class="list">${event.eventName} on ${event.date}</li>`;
        }
    });
}

const populateUsers = (users, containerId) => {
    const element = document.getElementById(containerId);
    users.forEach((user) => {
        if (element) {
            element.innerHTML += `<li id="${user.userId}" class="list">${user.username}, rating: ${user.rating}  <button class='invite'> Invite!</button> <button class='admin' id='admin'> Make host!</button></li>`;
        }
    });
}
