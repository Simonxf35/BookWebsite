// Hamburger Menu animation
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", () => {
     hamburger.classlist.toggle("active")
     navMenu.classlist.toggle("active")
})

document.querySelectorAll(".hamburger").forEach(n => n.addEventListener("click", () =>{
    hamburger.classlist.remove("active");
    navMenu.classlist.remove("active");
}))
