var lookingInBefore     = document.querySelector('input[name="looking-in"]:checked').value;
var roomTypeBefore      = document.getElementById('room-type').value;
var availableFromBefore = document.getElementById('available-from').value;
var minPriceBefore      = document.getElementById('min-price').value;
var maxPriceBefore      = document.getElementById('max-price').value;
var phoneBefore         = document.getElementById('phone').value;

var lookingInAfter,
    roomTypeAfter,
    availableFromAfter,
    minPriceAfter,
    maxPriceAfter,
    phoneAfter;

document.getElementById('header-btn-l').addEventListener('click', function() {
    if(anyChanges()) {
        if(confirm('There are unsaved changes. Are you sure you want to cancel?')) {
            window.location.href = 'listing';
        }
    } else {
        window.location.href = 'listing';
    }
});

document.getElementById('header-btn-r').addEventListener('click', function() {
    if(anyChanges()) {
        var data = 'lookingIn=' + lookingInAfter + '&roomType=' + roomTypeAfter + '&availableFrom=' + availableFromAfter + '&minPrice=' + minPriceAfter + '&maxPrice=' + maxPriceAfter + '&phone=' + phoneAfter;
        var request = new XMLHttpRequest();
        request.open('POST', '/php/saveProfile.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                window.location.href = 'listing';
            } else if(request.status != 200) {
                console.log('An error has occurred. Please try again.');
            }
        }
    } else {
        window.location.href = 'listing';
    }
});

function anyChanges() {
    lookingInAfter     = document.querySelector('input[name="looking-in"]:checked').value;
    roomTypeAfter      = document.getElementById('room-type').value;
    availableFromAfter = document.getElementById('available-from').value;
    minPriceAfter      = document.getElementById('min-price').value;
    maxPriceAfter      = document.getElementById('max-price').value;
    phoneAfter         = document.getElementById('phone').value;

    if(lookingInBefore     != lookingInAfter     ||
       roomTypeBefore      != roomTypeAfter      ||
       availableFromBefore != availableFromAfter ||
       minPriceBefore      != minPriceAfter      ||
       maxPriceBefore      != maxPriceAfter      ||
       phoneBefore         != phoneAfter) {
        return true;
    } else {
        return false;
    }
}