var activityButtons = document.getElementsByClassName('activity--buttons');

for(var i = 0, l = activityButtons.length; i < l; i++) {
    activityButtons[i].addEventListener('click', function(e) {
        if(e.target.className.match('no|star|book')) {
            propertyDecision(e, e.target.className);
        }
    });
}

function propertyDecision(e, status) {
    var propertyId = e.target.parentElement.getAttribute('data-property-id');

    var data = 'propertyId=' + propertyId + '&status=' + status;
    var request = new XMLHttpRequest();
    request.open('POST', '/php/updateActivity.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            console.log('Done', propertyId, status);
        } else if(request.status != 200) {
            console.log('An error has occurred. Please try again.');
        }
    }
}