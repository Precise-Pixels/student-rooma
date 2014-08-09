var availabilities = document.getElementsByClassName('availability');

for(var i = 0, l = availabilities.length; i < l; i++) {
    availabilities[i].addEventListener('change', changeAvailability);
}

function changeAvailability(e) {
    e.target.parentNode.className = 'spinner--show';

    var data = 'roomId=' + e.target.getAttribute('data-room-id') + '&availability=' + +e.target.checked;
    var request = new XMLHttpRequest();
    request.open('POST', '/php/updateRoomAvailability.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            e.target.parentNode.className = '';
        } else if(request.status != 200) {
            openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
        }
    }
}