const menu = document.getElementById("menu");
const menuButton = document.getElementById("menuButton");
const closeMenuButton = document.getElementById("closeMenuButton");

// Apri il menu al click del bottone ☰
function apri() {
    menu.classList.add("open");
        menuButton.style = 'display: none;';
    closeMenuButton.style = 'display: ;';
};

// Chiudi il menu al click del bottone ✕
function chiudi(){
    menu.classList.remove("open");
    setTimeout(() => {
        menuButton.style = 'display: ;';
    }, 340);
    setTimeout(() => {
        closeMenuButton.style = 'display: none;';
    }, 300);
};
    
    