function attachLogout() {
    document.getElementById('logout').addEventListener('click', (event) => {

        event.preventDefault();
    
        fetch('../../server/logout.php', {
            method: 'GET'
        })
            .then(response =>
                response.json())
            .then(data => console.log(data));
    
        location.replace("../registration");
    });
}