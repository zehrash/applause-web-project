async function postData(url, formData) {
    const response = await fetch(url, { method: 'POST', body: formData });
    return response;
}