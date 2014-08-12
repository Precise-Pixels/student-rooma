// Rooms stepper
var rooms          = document.getElementById('rooms');
var roomsDecrement = document.getElementById('rooms-decrement');
var roomsIncrement = document.getElementById('rooms-increment');

roomsDecrement.addEventListener('click', roomsStepper);
roomsIncrement.addEventListener('click', roomsStepper);

function roomsStepper(e) {
    if(e.target.id == 'rooms-increment' && rooms.value == 'ANY') {
        rooms.value = 1;
        roomsDecrement.disabled = false;
    } else if(e.target.id == 'rooms-increment') {
        rooms.value = (+rooms.value) + 1;
    } else if(e.target.id == 'rooms-decrement' && rooms.value == 1) {
        rooms.value = 'ANY';
        roomsDecrement.disabled = true;
    } else if(e.target.id == 'rooms-decrement' && rooms.value == 'ANY') {
        rooms.value = 'ANY';
    } else if(e.target.id == 'rooms-decrement') {
        rooms.value = (+rooms.value) - 1;
    }
}

// Phone dialog
var phone = document.getElementById('phone');

phone.addEventListener('focus', function() {
    if(phone.value == '') {
        openDialog('Your phone number', '<p>Your phone number is used to contact you to arrange a booking for any properties you choose to view.</p><p>You can change your phone number at any time from your Profile.</p>', 'Understood', '', 'newPhone', 'alert');
    }
});

// Form submission
var lookingInBefore     = document.querySelector('input[name="looking-in"]:checked').value;
var roomsBefore         = document.getElementById('rooms').value;
var availableFromBefore = document.getElementById('available-from').value;
var minPriceBefore      = document.getElementById('min-price').value;
var maxPriceBefore      = document.getElementById('max-price').value;
var phoneBefore         = document.getElementById('phone').value;

var lookingInAfter,
    roomsAfter,
    availableFromAfter,
    minPriceAfter,
    maxPriceAfter,
    phoneAfter;

document.getElementById('header-btn-l').addEventListener('click', function() {
    if(anyChanges()) {
        openDialog("Cancel Changes", "<p>There are unsaved changes. Are you sure you want to cancel?</p>", 'Yes', 'No', 'cancelProfileChanges', 'prompt');
    } else {
        window.location.href = '/properties';
    }
});

document.getElementById('header-btn-r').addEventListener('click', function() {
    if(anyChanges()) {
        var tick = document.getElementsByClassName('ico-tick');
        tick[0].className = 'ico-spinner ico--centre';

        var data = 'lookingIn=' + lookingInAfter + '&rooms=' + roomsAfter + '&availableFrom=' + availableFromAfter + '&minPrice=' + minPriceAfter + '&maxPrice=' + maxPriceAfter + '&phone=' + phoneAfter;
        var request = new XMLHttpRequest();
        request.open('POST', '/php/saveProfile.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                window.location.href = '/properties';
            } else if(request.status != 200) {
                openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
                tick[0].className = 'ico-tick ico--centre';
            }
        }
    } else {
        window.location.href = '/properties';
    }
});

function anyChanges() {
    lookingInAfter     = document.querySelector('input[name="looking-in"]:checked').value;
    roomsAfter         = document.getElementById('rooms').value;
    availableFromAfter = document.getElementById('available-from').value;
    minPriceAfter      = document.getElementById('min-price').value;
    maxPriceAfter      = document.getElementById('max-price').value;
    phoneAfter         = document.getElementById('phone').value;

    if(lookingInBefore     != lookingInAfter     ||
       roomsBefore         != roomsAfter         ||
       availableFromBefore != availableFromAfter ||
       minPriceBefore      != minPriceAfter      ||
       maxPriceBefore      != maxPriceAfter      ||
       phoneBefore         != phoneAfter) {
        return true;
    } else {
        return false;
    }
}

// Reset no's
document.getElementById('reset').addEventListener('click', function() {
    openDialog("Reset No's", "<p>All properties that you previously decided 'no' on will be reset and will appear in the property listings again. Are you sure you want to reset no's?</p>", 'Reset', 'Cancel', 'resetNos', 'prompt');
});