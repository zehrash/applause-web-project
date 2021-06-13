const createDb = () => {
    fetch('../../server/DAL/createDb.php')
        .then(response =>
            response.json())
        .then(data => console.log(data));
}
