let userMessage = document.getElementById('user-message');
let confirmPassword = document.getElementById('password-confirm');

// funzione per far uscire un messaggio nel caso in cui la password
// e la sua conferma siano diverse tra loro
confirmPassword.addEventListener('focusout', function(){
    let password = document.getElementById('password').value
    let confirm = document.getElementById('password-confirm').value

    if(password != confirm) {
        userMessage.innerHTML = '<i>**Password di conferma errata**</i>';
        confirm = '';
    }

    return userMessage;
})

// funzione che svuota il campo 'conferma password' e toglie il messaggio
confirmPassword.addEventListener('click', function(){
    userMessage.innerHTML = '';
    changePassword.value = '';
})