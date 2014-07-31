var decisionButtons = document.getElementsByClassName('decision-buttons');

for(var i = 0, l = decisionButtons.length; i < l; i++) {
    decisionButtons[i].addEventListener('click', function(e) {
        if(e.target.className.match('no|star|book')) {
            if(e.target.parentNode.className.match('decision-buttons--decide')) {
                propertyDecision(e, e.target.className);
            } else if(e.target.parentNode.className.match('decision-buttons--update')) {
                propertyUpdate(e, e.target.className);
            }
        }
    });
}

function propertyDecision(e, status) {
    var propertyId = e.target.parentElement.getAttribute('data-property-id');

    var data = 'propertyId=' + propertyId + '&status=' + status;
    var request = new XMLHttpRequest();
    request.open('POST', '/php/propertyDecision.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            console.log('Done', propertyId, status);
        } else if(request.status != 200) {
            openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
        }
    }
}

function propertyUpdate(e, status) {
    var propertyId = e.target.parentElement.getAttribute('data-property-id');

    var data = 'propertyId=' + propertyId + '&status=' + status;
    var request = new XMLHttpRequest();
    request.open('POST', '/php/updateActivity.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            window.location.href = '/activity';
        } else if(request.status != 200) {
            openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
        }
    }
}