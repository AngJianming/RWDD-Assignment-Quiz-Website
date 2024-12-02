'use strict';
const navbar = document.querySelector("[data-navbar]");
const navbarLinks = document.querySelectorAll("[data-nav-link]");
const navbarToggler = document.querySelector("[data-nav-toggler]");
navbarToggler.addEventListener("click", function() {
    navbar.classList.toggle("active");
    this.classList.toggle("active")
})
for(let i = 0; i< navbarLinks.length; i++){
    navbarLinks[i].addEventListener("click", function(){
        navbar.classList.remove("active");
        navbarToggler.classList.remove("active");
    });
}

// let btn = document.querySelector("#btn");
// let sidebar = document.querySelector(".sidebar");
// let searchBtn = document.querySelector(".ms-Icon--Search");

// btn.onclick = function() {
//     sidebar.classList.toggle("active");
// }

// searchBtn.onclick = function() {
//     sidebar.classList.toggle("active");
// }