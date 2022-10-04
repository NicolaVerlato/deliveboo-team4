let btnCreate = document.getElementById('btn-create')
let userMessage = document.getElementById('user-message')
const check1 = document.getElementById('type-1')
const check2 = document.getElementById('type-2')
const check3 = document.getElementById('type-3')
const check4 = document.getElementById('type-4')
const check5 = document.getElementById('type-5')

btnCreate.addEventListener('click', checkType)

check1.addEventListener('click', btnCreateDisabled)
check2.addEventListener('click', btnCreateDisabled)
check3.addEventListener('click', btnCreateDisabled)
check4.addEventListener('click', btnCreateDisabled)
check5.addEventListener('click', btnCreateDisabled)

// funzione che controlla re almeno una checkbox è cliccata
function checkType(){
    if(check1.checked 
        || check2.checked
        || check3.checked
        || check4.checked
        || check5.checked){

        btnCreate.disabled = false

    } else{
        userMessage.innerHTML = '<i>**Selezionare almeno una categoria**<i/>'
        btnCreate.disabled = true
    }
}

// funzione abilita di nuovo il bottone e toglie il messaggio di errore
function btnCreateDisabled(){
    btnCreate.disabled = false
    userMessage.innerHTML = ''
}

