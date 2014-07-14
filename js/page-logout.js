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
        if(response && response.status === 'connected') {
            FB.logout(function(response) {
                window.location.href = '/';
            });
        }
    });
};