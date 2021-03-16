// $(document).on("change",":file",function(){
let files = document.querySelectorAll("[type=file]");
for (let i = 0; i < files.length; i++) {
    files[i].addEventListener("change", e => treatmentChangeFile(e));
}
function treatmentChangeFile(e) {
    e.target.nextSibling.nextElementSibling.innerHTML = `${e.target.files.length} arq.(s) selecionados`;
}

document
    .getElementById("text-area-description-immobile")
    .addEventListener("input", e => {
        document.getElementById("preview-immobile").innerHTML = e.target.value;
    });
