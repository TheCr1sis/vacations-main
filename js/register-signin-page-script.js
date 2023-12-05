const forms = document.querySelector(".forms"),
links = document.querySelectorAll(".link");

links.forEach(link => {
    link.addEventListener("click", e => {
       e.preventDefault(); //preventing form submit
       forms.classList.toggle("show-signup");
    })
})

function checkURLParams() {
    const urlParams = new URLSearchParams(window.location.search);
    const registrationUsernameError = urlParams.get('registration_username_error');
    const registrationPasswordError = urlParams.get('registration_password_error');

    const forms = document.querySelector(".forms");
    if (registrationUsernameError || registrationPasswordError) {
        forms.classList.add("show-signup");
    } else {
        forms.classList.remove("show-signup");
    }
}

// Call the function when the page loads
window.addEventListener('DOMContentLoaded', () => {
    checkURLParams();
});