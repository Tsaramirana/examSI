function pay(id){
    var form = document.getElementById("heure-formulaire");
    var back = document.getElementById("back-button-container");
    var table = document.getElementById("long-table");
    var inputId = document.getElementById("id-input");

    inputId.setAttribute('value', id);
    form.classList.remove('hidden');
    back.classList.remove('hidden');
    table.classList.add('hidden');
}

var button = document.getElementById("back-button");
var back = document.getElementById("back-button-container");
button.addEventListener("click", function(){
    var form = document.getElementById("heure-formulaire");
    var table = document.getElementById("long-table");
    form.classList.add('hidden');
    back.classList.add('hidden');
    table.classList.remove('hidden');
});