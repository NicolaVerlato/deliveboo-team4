const btnCreate = document.getElementById('btn-create')
let userMessage = document.getElementById('user-message')

btnCreate.addEventListener('click', function(){
    for (let i = 1; i <= 5; i++) {
        let type = 'type-'
        let typeId = type += [i]
    
        DOMType = document.getElementById(typeId);

        DOMType += 'checked'
        // if(DOMType){
        //     userMessage.innerHTML = ''
        // } else{
        //     userMessage.innerHTML = 'Selezionare almeno una categoria'
        // }
        console.log(DOMType)
    }
})

