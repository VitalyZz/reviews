const realFileBtn = document.querySelector(".real-file");
const customBtn = document.querySelector(".custom-button");
const customTxt = document.querySelector(".custom-text");

customBtn.addEventListener("click", function() {
    realFileBtn.click();
});

realFileBtn.addEventListener("change", function() {
    if (realFileBtn.value) {
        customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
        customTxt.style.color = '#07D846';
    } else {
        customTxt.innerHTML = "Постер не выбран";
    }
});