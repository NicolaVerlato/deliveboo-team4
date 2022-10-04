let userMessage = document.getElementById('user-message');
let passwordMessage = document.getElementById('password-message');

let iva = document.getElementById('iva');
let ivaMessage = document.getElementById('iva-message');

let password = document.getElementById('password');

let confirmPassword = document.getElementById('password-confirm');

let btn = document.getElementById('btn');
btn.disabled = false

// funzione per far uscire un messaggio nel caso in cui la password
// sia più corta di 8 caratteri
password.addEventListener('focusout', function(){
    if(password.value.length < 8) {
        passwordMessage.innerHTML = '<i>**La password deve essere di almeno 8 caratteri**</i>'
        btn.disabled = true
    }
})

// funzione che toglie il messaggio **La password deve essere di almeno 8 caratteri**
password.addEventListener('click', function(){
    passwordMessage.innerHTML = ''
    btn.disabled = false
})



// funzione per far uscire un messaggio nel caso in cui la password
// e la sua conferma siano diverse tra loro
confirmPassword.addEventListener('focusout', function(){
    let confirm = document.getElementById('password-confirm').value

    if(password.value != confirm) {
        userMessage.innerHTML = '<i>**Password di conferma errata**</i>';
        btn.disabled = true
    }

    return userMessage;
})

// funzione che svuota il campo 'conferma password' e toglie il messaggio
confirmPassword.addEventListener('click', function(){
    userMessage.innerHTML = '';
    confirmPassword.value = '';
    btn.disabled = false
})

// funzione per far uscire un messaggio nel caso in cui l'iva
// sia minore di 11 caratteri
iva.addEventListener('focusout', function(){
    if(iva.value.length < 11) {
        ivaMessage.innerHTML = '<i>**La partita iva deve essere di 11 caratteri**</i>';
        btn.disabled = true
    }
})

// funzione che toglie il messaggio **La partita iva deve essere di 11 caratteri** e abilita di nuovo il bottone
iva.addEventListener('click', function(){
    ivaMessage.innerHTML= '';
    btn.disabled = false
})



