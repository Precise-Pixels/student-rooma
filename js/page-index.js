/*!
  * Precise Pixels | http://precisepixels.co.uk
  * https://github.com/Precise-Pixels/student-rooma
  */

var loginFbBtn     = document.getElementById('login-fb-btn');
var loginFbBtnText = document.getElementById('login-fb-btn-text');

// Facebook SDK
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

window.fbAsyncInit = function() {
    FB.init({
        appId   : '590931871026100',
        cookie  : true,
        version : 'v2.7'
    });
    FB.getLoginStatus(function(response) {
        loginFbBtn.className += ' login--loading';
        loginFbBtnText.innerHTML = 'Logging in...';
        statusChangeCallback(response);
    });
};

loginFbBtn.addEventListener('click', function() {
    loginFbBtn.className += ' login--loading';
    loginFbBtnText.innerHTML = 'Logging in...';
    FB.login(function(response) {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    },
        {scope: 'public_profile, user_location'}
    );
});

function statusChangeCallback(response) {
    if(response.status === 'connected') {
        requestFBData();
    } else {
        resetLoginButton();
    }
}

function requestFBData() {
    var fbId,
        name,
        location;

    FB.api('/me', function(response) {
        fbId = encodeURI(response.id);
        name = encodeURI(response.name);

        if(response.location != undefined) {
            location = encodeURI(response.location.name);
        }

        proceedLogin();
    });

    function proceedLogin() {
        var data = 'fbId=' + fbId + '&name=' + name + '&location=' + location;
        var request = new XMLHttpRequest();
        request.open('POST', '/php/facebookLogin.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                window.location.href = '/app/properties';
            } else if(request.status != 200) {
                openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
                resetLoginButton();
            }
        }
    }
}

function resetLoginButton() {
    loginFbBtn.className = loginFbBtn.className.replace(' login--loading', '');
    loginFbBtnText.innerHTML = 'Continue with Facebook';
}

// Email Login

var loginEmailBtn          = document.getElementById('login-email-btn');
var loginEmailForm         = document.getElementById('login-email-form');
var loginEmail             = document.getElementById('login-email');
var createAccount          = document.getElementById('create-account');
var createAccountForm      = document.getElementById('create-account-form');
var createAccountEmail     = document.getElementById('create-account-email');
var forgottenPassword      = document.getElementById('forgotten-password');
var forgottenPasswordForm  = document.getElementById('forgotten-password-form');
var forgottenPasswordEmail = document.getElementById('forgotten-password-email');

loginEmailBtn.addEventListener('click', function() {
    loginEmailForm.className = 'login-email-form--show';
    createAccountForm.className = forgottenPasswordForm.className = '';
    loginEmail.focus();
    location.hash = 'continue-with-email';
});

switch(location.hash) {
    case '#continue-with-email':
        loginEmailForm.className = 'login-email-form--show';
        break;
    case '#create-an-account':
        createAccountForm.className = 'create-account-form--show';
        break;
    case '#forgotten-your-password':
        forgottenPasswordForm.className = 'forgotten-password-form--show';
        break;
}

createAccount.addEventListener('click', function() {
    createAccountForm.className = 'create-account-form--show';
    loginEmailForm.className = forgottenPasswordForm.className = '';
    createAccountEmail.focus();
});

forgottenPassword.addEventListener('click', function() {
    forgottenPasswordForm.className = 'forgotten-password-form--show';
    loginEmailForm.className = createAccountForm.className = '';
    forgottenPasswordEmail.focus();
});