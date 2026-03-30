/**
 * Forget Password Validations
 * Author: JS Coder
 */
function validateResetForm() {
    let mobile = document.getElementsByName("mobile")[0].value;
    let newPass = document.getElementsByName("new_password")[0].value;

    if (mobile.length !== 10 || isNaN(mobile)) {
        alert("Bhai, sahi 10 digit ka mobile number dalo!");
        return false;
    }

    if (newPass.length < 6) {
        alert("Password kam se kam 6 characters ka hona chahiye.");
        return false;
    }

    return true;
}
