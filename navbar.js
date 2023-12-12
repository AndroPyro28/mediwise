const hamburger = document.querySelector('#hamburger');
const hamburgerContent = document.querySelector('#hamburger-content');
let navbarOnScreen = false
hamburger.addEventListener('click',() => {
    if(!navbarOnScreen) {
        hamburgerContent.style.display = "flex"
        navbarOnScreen = true
    } else {
        hamburgerContent.style.display = "none"
        navbarOnScreen = false
    }
})