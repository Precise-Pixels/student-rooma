document.getElementById('login').addEventListener('click', function() {
    FB.login(function(response) {
        checkLoginState();
    },
        {scope: 'public_profile, user_location'}
    );
});

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
        version : 'v2.0'
    });
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
};

function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

function statusChangeCallback(response) {
    if(response.status === 'connected') {
        requestFBData();
    } else if(response.status === 'not_authorized') {
        document.getElementById('status').innerHTML = 'Please log into this app.';
    } else {
        document.getElementById('status').innerHTML = 'Please log into Facebook.';
    }
}

function requestFBData() {
    var fbId,
        name,
        location;

    FB.api('/me', function(response) {
        console.log('Successful login for: ' + response.name + ' (' + response.id + ')' + ' (' + response.location.name + ')');
        fbId     = encodeURI(response.id);
        name     = encodeURI(response.name);
        location = encodeURI(response.location.name);

        proceedLogin();
    });

    FB.api('/me/permissions', function(response) {
        console.log(response);
    });

    function proceedLogin() {
        var data = 'fbId=' + fbId + '&name=' + name + '&location=' + location;
        var request = new XMLHttpRequest();
        request.open('POST', '/php/facebookLogin.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                if(request.responseText == 'new') {
                    window.location.href = '/profile';
                } else if(request.responseText == 'existing') {
                    window.location.href = '/properties';
                } else {
                    console.log('An error has occurred. Please try again.');
                }
            } else if(request.status != 200) {
                console.log('An error has occurred. Please try again.');
            }
        }
    }
}