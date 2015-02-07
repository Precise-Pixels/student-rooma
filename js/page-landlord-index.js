/*!
  * Precise Pixels | http://precisepixels.co.uk
  * https://github.com/Precise-Pixels/student-rooma
  */

var loginEmailForm         = document.getElementById('login-email-form');
var loginEmail             = document.getElementById('login-email');
var createAccountForm      = document.getElementById('create-account-form');
var createAccountEmail     = document.getElementById('create-account-email');
var forgottenPasswordForm  = document.getElementById('forgotten-password-form');
var forgottenPasswordEmail = document.getElementById('forgotten-password-email');

function toggleForms() {
    loginEmailForm.className = createAccountForm.className = forgottenPasswordForm.className = '';

    switch(location.hash) {
        case '':
            loginEmailForm.className = 'login-email-form--show';
            loginEmail.focus();
            break;
        case '#create-an-account':
            createAccountForm.className = 'create-account-form--show';
            createAccountEmail.focus();
            break;
        case '#forgotten-your-password':
            forgottenPasswordForm.className = 'forgotten-password-form--show';
            forgottenPasswordEmail.focus();
            break;
    }
}

toggleForms();

window.addEventListener('hashchange', function() {
    toggleForms();
});