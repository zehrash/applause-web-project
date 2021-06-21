const container = document.querySelector(".container");
let seatId;
attachLogout();
updateReservedSeats();

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

                console.log(savedSeats)

                for (let i in savedSeats) {
                    document.getElementById(savedSeats[i]).classList.toggle('sold');
                }
                seats = document.querySelectorAll(".row  .seat:not(.sold)");
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
            }
        })
        .catch(error => {
            console.log(error.message)
        });
}
document.getElementById('book-btn').addEventListener('click', (event) => {

    let formData = new FormData();
    formData.append("seatId", seatId);

    console.log(seatId);
    postData('../../server/saveseat.php', formData).then(data => data.json()).then(dataText => {
        console.log(dataText);
        location.replace(`../home?eventId=${sessionStorage.eventId}`);
    }).catch(error => console.log(JSON.stringify(error)));


});