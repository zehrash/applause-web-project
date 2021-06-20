const container = document.querySelector(".container");
let seatId;

updateReservedSeats();

const seats = document.querySelectorAll(".row .seat:not(.sold)");

for (var i = 0; i < seats.length; i++) {
    seats[i].addEventListener('click', function() {
        for (var j = 0; j < seats.length; j++) {
            seats[j].style.background = '#444451';
        }
        this.style.background = '#86D9A5';
        seatId = this.attributes['id'].value;
        //this.classList.toggle("selected");
        console.log(seatId);
        return false;
    });
}

populateUI();

// Get data from localstorage and populate UI
function populateUI() {
    const selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));

    if (selectedSeats !== null && selectedSeats.length > 0) {
        seats.forEach((seat, index) => {
            if (selectedSeats.indexOf(index) > -1) {
                seat.classList.add("selected");
            }
        });
    }
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
                //get all saved seats, loop through them and toggle 'sold' class for each

                let savedSeats = response.value;

                for (let i in savedSeats) {
                    document.getElementById(savedSeats).classList.toggle('sold');
                }
                console.log(response.value);
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

    //TODO: check if postData is successful or not 

});