// navbar-toggler animation

function ready(callback) {
    // in case the document is already rendered
    if (document.readyState != 'loading') callback();
    // modern browsers
    else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
    // IE <= 8
    else document.attachEvent('onreadystatechange', function () {
        if (document.readyState == 'complete') callback();
    });
}

ready(function () {
    if (document.querySelector(".navbar-toggler")) {
        document.querySelector(".navbar-toggler").addEventListener('click', () => {
            let el = document.getElementById('nav-icon');
            el.className == 'open';
            if (el.classList.contains('open')) {
                el.classList.remove('open');
            } else {
                el.classList.add('open');
            }
        })
    }
});

