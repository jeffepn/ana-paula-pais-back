document.addEventListener('DOMContentLoaded', () => {
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
    console.log("bootstrap", window.bootstrap, dropdownElementList);
    dropdownElementList.map(function (dropdownToggleEl) {
        const dropdownEl = new window.bootstrap.Dropdown(dropdownToggleEl)
        dropdownToggleEl.addEventListener('click', () => {
            dropdownEl.toggle();
        });
    });
});

let files = document.querySelectorAll("[type=file]");
for (let i = 0; i < files.length; i++) {
    files[i].addEventListener("change", (e) => treatmentChangeFile(e));
}
function treatmentChangeFile(e) {
    e.target.nextSibling.nextElementSibling.innerHTML = `${e.target.files.length} arq.(s) selecionados`;
}
