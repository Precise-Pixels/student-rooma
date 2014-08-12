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

document.getElementById('login').addEventListener('click', function() {
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
    }
}

function requestFBData() {
    var fbId,
        name,
        location;

    FB.api('/me', function(response) {
        fbId     = encodeURI(response.id);
        name     = encodeURI(response.name);
        location = encodeURI(response.location.name);

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
                if(request.responseText == 'new') {
                    window.location.href = '/profile';
                } else if(request.responseText == 'existing') {
                    window.location.href = '/properties';
                } else {
                    openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
                }
            } else if(request.status != 200) {
                openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
            }
        }
    }
}

var youtube = document.getElementById('youtube');

var iframe = document.createElement('iframe');
iframe.src = youtube.getAttribute('data-src');
iframe.frameBorder = '0';
iframe.setAttribute('allowfullscreen', '');

youtube.parentNode.replaceChild(iframe, youtube);