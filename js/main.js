console.log("javascript file is linked");

// VARIABLES

// Header
const toggleButton = document.querySelector("#burger-button")
const navbarLinks = document.querySelector(".links-header")
toggleButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
})