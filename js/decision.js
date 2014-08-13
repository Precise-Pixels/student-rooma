var decisionButtons = document.getElementsByClassName('decision-buttons');
var bookButton      = document.getElementsByClassName('book');
var starButton      = document.getElementsByClassName('star');
var noButton        = document.getElementsByClassName('no');

for(var i = 0, l = decisionButtons.length; i < l; i++) {
    decisionButtons[i].addEventListener('click', function(e) {
        if(e.target.className.match('no|star|book')) {
            if(e.target.parentNode.parentNode.className.match('decide')) {
                propertyDecision(e.target.className);
            } else if(e.target.parentNode.parentNode.parentNode.className.match('decide')) {
                propertyDecision('star');
            } else if(e.target.parentNode.parentNode.className.match('update')) {
                propertyUpdate(this, e.target.className, e.target.parentNode.parentNode.getAttribute('data-property-id'));
            } else if(e.target.parentNode.parentNode.parentNode.className.match('update')) {
                propertyUpdate(this, 'star', e.target.parentNode.parentNode.parentNode.getAttribute('data-property-id'));
            }
        }
    });
}

function propertyDecision(status) {
    // Disable decision buttons
    bookButton[0].disabled = true;
    starButton[0].disabled = true;
    noButton[0].disabled   = true;

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
    propertyActive[0].className += ' property--' + status;
    if(propertyNext !== null) {
        propertyNext.className = 'property property--next';
    }

    // Pulse the Activity icon
    var activityIcon = document.getElementById('header-btn-l');
    activityIcon.className = 'header-btn-l--pulse';

    // Make next property active
    function animationEnd() {
        activityIcon.className = '';
        propertyActive[0].className = 'property';
        if(propertyNext !== null) {
            propertyNext.className = 'property property--active';
            loadImages();
            loadSlider();
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
        bookButton[0].disabled = false;
        starButton[0].disabled = false;
        noButton[0].disabled   = false;
    }
}

function propertyUpdate(wrapper, status, propertyId) {
    wrapper.className += ' decision-buttons--spinner';

    var data = 'propertyId=' + propertyId + '&status=' + status;
    var request = new XMLHttpRequest();
    request.open('POST', '/php/updateActivity.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            window.location.reload();
        } else if(request.status != 200) {
            openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
            wrapper.className = wrapper.className.replace(' decision-buttons--spinner', '');
        }
    }
}