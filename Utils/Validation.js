function emailValidation(email) {
    let emailReg = /^[a-zA-Z0-9_-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/;
    return emailReg.test(email);
}

function onlyNumValidation(num) {
    let numReg = /^\d+$/;
    return numReg.test(num);
}

function onlyCharacterValidation(charValue) {
    let charReg = /[a-zA-Z]+/;
    return charReg.test(charValue);
}