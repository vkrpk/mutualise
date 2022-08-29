// Import our custom CSS
import "../sass/app.scss";
import "../css/bootstrap.min.css";
import "../css/app.css";
import "../css/home.css";
import "../css/Footer-Basic.css";
import "../css/dh-header-cover-image-button.css";
// import "../css/profil/billing.css";
// import "../css/profil/common.css";
// Import all of Bootstrap's JS
import * as bootstrap from "bootstrap";

import "./dedikam";
import "./bootstrap.js";
import "./bs-init.js";

// import.meta.glob([
//     '../images/**',
//     '../fonts/**',
// ]);

import.meta.glob(["../images/**"]);
var popoverTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="popover"]')
);
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
});
