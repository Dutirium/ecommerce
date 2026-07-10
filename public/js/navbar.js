console.log("NavBar JS Loaded");

const menuBtn = document.getElementById("menuBtn");
const closeBtn = document.getElementById("closeBtn");
const sideBar = document.getElementById("sideBar");
const overlay = document.getElementById("overlay");

menuBtn.addEventListener("click", () =>{
    sideBar.classList.add("active");
    overlay.classList.add("active");
});

closeBtn.addEventListener("click", closeMenu);
overlay.addEventListener("click", closeMenu);

function closeMenu(){
    sideBar.classList.remove("active");
    overlay.classList.remove("active");
}

function navigateToRoute(url){
    window.location.href = url;
}

