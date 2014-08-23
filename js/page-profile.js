/*!
  * Precise Pixels | http://precisepixels.co.uk
  * https://github.com/Precise-Pixels/student-rooma
  */

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

// Double range input
loadDoubleRangeInput();

function loadDoubleRangeInput() {
    var main            = document.getElementsByTagName('main');
    var container       = document.getElementById('double-range-input');
    var handleL         = document.getElementById('double-range-input-handle-l');
    var handleR         = document.getElementById('double-range-input-handle-r');
    var minPriceField   = document.getElementById('min-price');
    var maxPriceField   = document.getElementById('max-price');
    var width           = container.offsetWidth;
    var min             = +container.getAttribute('data-min');
    var max             = +container.getAttribute('data-max');
    var range           = max - min;
    var handleLDragging = false;
    var handleRDragging = false;
    var startL          = 0;
    var startR          = 0;
    var move            = 0;
    var endL            = 0;
    var endR            = 0;

    setHandleLPos();
    setHandleRPos();

    function setHandleLPos() {
        var handleLPos = endL = ((minPriceField.value - min) / range) * (width - 24);

        if(handleLPos < 0) {
            handleL.style.transform = handleL.style.webkitTransform = 'translate3d(0,0,0)';
        } else {
            handleL.style.transform = handleL.style.webkitTransform = 'translate3d(' + handleLPos + 'px,0,0)';
        }
    }

    function setHandleRPos() {
        var handleRPos = endR = ((maxPriceField.value - min) / range) * (width - 24);

        if(handleRPos > width) {
            handleR.style.transform = handleR.style.webkitTransform = 'translate3d(' + (width - 24) + 'px,0,0)';
        } else {
            handleR.style.transform = handleR.style.webkitTransform = 'translate3d(' + handleRPos + 'px,0,0)';
        }
    }

    // Field events
    minPriceField.addEventListener('change', setHandleLPos);
    maxPriceField.addEventListener('change', setHandleRPos);

    // Handle events
    handleL.addEventListener('touchstart', function(e) { handleLStart(e, 'touch'); });
    handleR.addEventListener('touchstart', function(e) { handleRStart(e, 'touch'); });
    main[0].addEventListener('touchmove', function(e) { handleMove(e, 'touch'); });
    window.addEventListener('touchend', handleEnd);
    handleL.addEventListener('mousedown', function(e) { handleLStart(e, 'mouse'); });
    handleR.addEventListener('mousedown', function(e) { handleRStart(e, 'mouse'); });
    main[0].addEventListener('mousemove', function(e) { handleMove(e, 'mouse'); });
    window.addEventListener('mouseup', handleEnd);

    function handleLStart(e, interaction) {
        var pageX = (interaction == 'touch' ? e.touches[0].pageX : e.pageX);
        startL = (e.pageX || e.touches[0].pageX) - 24;
        handleLDragging = true;
    }

    function handleRStart(e, interaction) {
        var pageX = (interaction == 'touch' ? e.touches[0].pageX : e.pageX);
        startR = (e.pageX || e.touches[0].pageX) - 24;
        handleRDragging = true;
    }

    function handleMove(e, interaction) {
        if(handleLDragging) {
            var pageX = (interaction == 'touch' ? e.touches[0].pageX : e.pageX);
            move = endL + pageX - startL - 24;

            if(move <= 0) {
                endL = 0;
            }

            if(move >= 0 && move <= endR) {
                handleL.style.transform = handleL.style.webkitTransform = 'translate3d(' + move + 'px,0,0)';

                var perc = move / (width - 24);
                minPriceField.value = Math.round(perc * range + min);
            }
        }

        if(handleRDragging) {
            var pageX = (interaction == 'touch' ? e.touches[0].pageX : e.pageX);
            move = endR + pageX - startR - 24;

            if(move >= width - 24) {
                endR = width - 24;
            }

            if(move <= width - 24 && move >= endL) {
                handleR.style.transform = handleR.style.webkitTransform = 'translate3d(' + move + 'px,0,0)';

                var perc = move / (width - 24);
                maxPriceField.value = Math.round(perc * range + min);
            }
        }
    }

    function handleEnd() {
        if(handleLDragging) {
            handleLDragging = false;
            endL = move;
        }

        if(handleRDragging) {
            handleRDragging = false;
            endR = move;
        }
    }
}

var resizeTimer;

window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(loadDoubleRangeInput, 100);
});

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

var cross = document.getElementById('header-btn-l');

if(cross) {
    cross.addEventListener('click', function() {
        if(anyChanges()) {
            openDialog("Cancel Changes", "<p>There are unsaved changes. Are you sure you want to cancel?</p>", 'Yes', 'No', 'cancelProfileChanges', 'prompt');
        } else {
            window.location.href = '/properties';
        }
    });
}

document.getElementById('header-btn-r').addEventListener('click', function() {
    if(formComplete()) {
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
    } else {
        openDialog("Profile Incomplete", "<p>Please ensure all the fields are filled out correctly.</p>", 'Okay', '', 'profileIncomplete', 'alert');
    }
});

function formComplete() {
    lookingInAfter     = document.querySelector('input[name="looking-in"]:checked');
    roomsAfter         = document.getElementById('rooms').value;
    availableFromAfter = document.getElementById('available-from').value;
    minPriceAfter      = document.getElementById('min-price').value;
    maxPriceAfter      = document.getElementById('max-price').value;
    phoneAfter         = document.getElementById('phone').value;

    if(lookingInAfter     != null &&
       roomsAfter         != ''   &&
       availableFromAfter != ''   && availableFromAfter.match(/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/) &&
       minPriceAfter      != ''   && !isNaN(minPriceAfter) && minPriceAfter >= 0 && minPriceAfter <= maxPriceAfter &&
       maxPriceAfter      != ''   && !isNaN(maxPriceAfter) && maxPriceAfter >= 0 &&
       phoneAfter         != '') {
        return true;
    } else {
        return false;
    }
}

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