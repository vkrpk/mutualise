window.onload = function () {
    // import {Modal} from "bootstrap";
    let href = "{{ route('user.email-change') }}";
    let form = document.getElementById("changeEmailForm");
    let button = document.getElementById("submitButtonEmailChangeForm");
    console.log(href);
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        let request = {
            method: "POST",
            body: JSON.stringify({
                password: document.getElementById("passwordConfirmation").value,
                email: document.getElementById("emailChange").value,
            }),
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
                "Content-Type": "application/json",
            },
        };
        fetch(href, request)
            .then((response) => response.json())
            .then((response) => {
                if (response.status === true) {
                    myModal.hide();
                    alert("tout est ok");
                } else {
                    alert("Problème lors de l'insertion en BDD");
                }
            })
            .catch((error) => {
                alert(error);
            });
    });
};
