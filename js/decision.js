var decisionButtons = document.getElementsByClassName('decision-buttons');

for(var i = 0, l = decisionButtons.length; i < l; i++) {
    decisionButtons[i].addEventListener('click', function(e) {
        if(e.target.className.match('no|star|book')) {
            if(e.target.parentNode.parentNode.className.match('decision-buttons--decide')) {
                propertyDecision(e, e.target.className);
            } else if(e.target.parentNode.parentNode.className.match('decision-buttons--update')) {
                propertyUpdate(e, e.target.className);
            }
        }
    });
}

function propertyDecision(e, status) {
    // Disable decision buttons
    decisionButtons[0].children[0].disabled = true;
    decisionButtons[0].children[1].disabled = true;
    decisionButtons[0].children[2].disabled = true;

    // Get active and next properties
    var propertyActive = document.getElementsByClassName('property--active');
    var propertyNext   = propertyActive[0].nextElementSibling;
    var end            = false;

    // If viewing the last property
    if(propertyNext === null) {
        end = true;
    }

    // Setup animationend event listeners
    propertyActive[0].addEventListener('animationend', animationEnd);
    propertyActive[0].addEventListener('webkitAnimationEnd', animationEnd);
    propertyActive[0].addEventListener('oanimationend', animationEnd);
    propertyActive[0].addEventListener('MSAnimationEnd', animationEnd);

    // Resize height of active property and append classes for animations
    propertyActive[0].className += ' property--' + e.target.className;
    if(propertyNext !== null) {
        propertyNext.className = 'property property--next';
    }

    // Make next property active
    function animationEnd() {
        propertyActive[0].className = 'property';
        if(propertyNext !== null) {
            propertyNext.className = 'property property--active';
        }
        enableDecisionButtons();
    }

    var propertyId = propertyActive[0].getAttribute('data-property-id');

    var data = 'propertyId=' + propertyId + '&status=' + status;
    var request = new XMLHttpRequest();
    request.open('POST', '/php/propertyDecision.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            // If last property has been decided on
            if(end === true) {
                setTimeout(function() {
                    window.location.reload();
                }, 600);
            }
        } else if(request.status != 200) {
            openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
            propertyActive[0].className = 'property property--active';
            propertyNext.className      = 'property';
        }
    }

    function enableDecisionButtons() {
        decisionButtons[0].children[0].disabled = false;
        decisionButtons[0].children[1].disabled = false;
        decisionButtons[0].children[2].disabled = false;
    }
}

function propertyUpdate(e, status) {
    var propertyId = e.target.parentElement.parentElement.getAttribute('data-property-id');

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