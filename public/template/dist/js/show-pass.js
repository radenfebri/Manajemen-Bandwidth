const showPass = document.querySelector("#show-pass");
const showPass2 = document.querySelector("#show-pass2");
const password = document.querySelector("#password");
const password2 = document.querySelector("#password2");

showPass.addEventListener("click", function (e) {
    e.preventDefault();
    if (password.type === "password") {
        password.type = "text";
        showPass.title = "Hide password";
    } else {
        password.type = "password";
        showPass.title = "Show password";
    }
});

showPass2.addEventListener("click", function (e) {
    e.preventDefault();
    if (password2.type === "password") {
        password2.type = "text";
        showPass2.title = "Hide password";
    } else {
        password2.type = "password";
        showPass2.title = "Show password";
    }
});