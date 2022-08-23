// Import our custom CSS
import "../sass/app.scss";
import "../css/home.css";
// Import all of Bootstrap's JS
import * as bootstrap from "bootstrap";

// import.meta.glob([
//     '../images/**',
//     '../fonts/**',
// ]);
// import.meta.glob("../images/**");

const main = document.getElementById("main");
const header = document.getElementsByTagName("header")[0];
const footer = document.getElementsByTagName("footer")[0];

window.addEventListener('click', function () {
    console.log(main.offsetHeight);
    console.log(header.offsetHeight);
    console.log(footer.offsetHeight);
})

/*  */
window.onload = (e) => {
    if (main.offsetHeight + header.offsetHeight + footer.offsetHeight + 48 < window.innerHeight) {
        main.style.height = (window.innerHeight - (header.offsetHeight + footer.offsetHeight)) - 24 + "px"
    }
}

window.addEventListener('resize', function () {
    if (main.offsetHeight + header.offsetHeight + footer.offsetHeight + 48 < window.innerHeight) {
        main.style.height = (window.innerHeight - (header.offsetHeight + footer.offsetHeight)) - 24 + "px"
    }
})
