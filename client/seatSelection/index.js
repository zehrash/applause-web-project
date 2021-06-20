const container = document.querySelector(".container");
let seatId;
attachLogout();
updateReservedSeats();

const seats = document.querySelectorAll(".row .seat:not(.sold)");

for (let i = 0; i < seats.length; i++) {
    seats[i].addEventListener('click', function() {
        for (let j = 0; j < seats.length; j++) {
            seats[j].style.background = '#444451';
        }
        this.style.background = '#86D9A5';
        seatId = this.attributes['id'].value;
        console.log(seatId);
        return false;
    });
}

function updateReservedSeats() {

    fetch('../../server/populateseats.php', {
            method: 'GET'
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Error getting saved seats.');
            }
            console.log(response);
            return response.json();
        })
        .then(response => {
            if (response.success) {
                let savedSeats = response.value;

                for (let i in savedSeats) {
                    document.getElementById(savedSeats).classList.toggle('sold');
                }
            }
        })
        .catch(error => {
            console.log(error.message)
        });
}

// Seat click event
container.addEventListener("click", (e) => {
    if (
        e.target.classList.contains("seat") &&
        !e.target.classList.contains("sold")
    ) {
        e.target.classList.toggle("selected");
    }
});


document.getElementById('book-btn').addEventListener('click', (event) => {

    let formData = new FormData();
    formData.append("seatId", seatId);


    postData('../../server/saveseat.php', formData).then(data => data.json()).then(dataText => {
        console.log(dataText);
    }).catch(error => console.log(JSON.stringify(error)));

    location.replace(`../home?eventId=${sessionStorage.eventId}`);
});