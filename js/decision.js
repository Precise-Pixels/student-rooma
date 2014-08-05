var decisionButtons = document.getElementsByClassName('decision-buttons');

for(var i = 0, l = decisionButtons.length; i < l; i++) {
    decisionButtons[i].addEventListener('click', function(e) {
        if(e.target.className.match('no|star|book')) {
            if(e.target.parentNode.className.match('decision-buttons--decide')) {
                // Fire off AJAX call
                propertyDecision(e, e.target.className);

                // Get active and next properties
                var propertyActive = document.getElementsByClassName('property--active');
                var propertyNext   = propertyActive[0].nextElementSibling;

                // Setup animationend event listeners
                propertyActive[0].addEventListener('animationend', animationEnd);
                propertyActive[0].addEventListener('webkitAnimationEnd', animationEnd);
                propertyActive[0].addEventListener('oanimationend', animationEnd);
                propertyActive[0].addEventListener('MSAnimationEnd', animationEnd);

                // Resize height of active property and append classes for animations
                propertyActive[0].style.height = (window.innerHeight || document.documentElement.clientHeight) - 60 + 'px';
                propertyNext.className = 'property property--next';
                propertyActive[0].className += ' property--' + e.target.className;

                // Make next property active
                function animationEnd() {
                    propertyActive[0].className = 'property';
                    propertyNext.className      = 'property property--active';
                }
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