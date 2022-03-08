'use stricts';

let id_url_copy = document.getElementById("url_copy");
let url = window.location.href;



id_url_copy.addEventListener("click", copy);

function copy() {
    navigator.clipboard.writeText(url);
    alert("Kopieren erfolgreich :)");
}