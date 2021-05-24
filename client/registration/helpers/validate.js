function validate(input, regex, warningDivId) {
    if (regex.test(input.value)) {
        document.getElementById(warningDivId).style.display = 'none';
        document.getElementById(warningDivId).innerHTML = '';
        input.style.outline = '1px solid #79a06b';
        input.style.border = '1px solid #79a06b';
        return true;
    } else {
        switch (warningDivId) {
            case 'username-validator':
                document.getElementById(warningDivId).innerHTML = 'Невалидно потребителско име'; break;
            case 'pass-validator':
                document.getElementById(warningDivId).innerHTML = 'Невалидна парола'; break;
            default: break;
        }

        document.getElementById(warningDivId).style.display = 'block';
        input.style.outline = '1px solid #b0706d';
        input.style.border = '1px solid #b0706d';
        return false;
    }
}