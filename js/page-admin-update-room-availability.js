document.getElementById('header-btn-l').addEventListener('click', function() {
    if(anyChanges()) {
        openDialog("Cancel Changes", "<p>There are unsaved changes. Are you sure you want to cancel?</p>", 'Yes', 'No', 'cancelAdminUpdateRoomAvailabilityChanges', prompt);
    } else {
        window.location.href= '/admin';
    }
});

document.getElementById('header-btn-r').addEventListener('click', function() {
    if(anyChanges()) {
        var data = 'updateQuery=' + updateQuery;
        var request = new XMLHttpRequest();
        request.open('POST', '/php/updateRoomAvailability.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                window.location.href = '/admin/update-room-availability?status=success';
            } else if(request.status != 200) {
                console.log('An error has occurred. Please try again.');
            }
        }
    } else {
        window.location.href= '/admin/update-room-availability?status=unchanged';
    }
});

// Compare before and after states of all drop-downs to check for any changes
var availabilitiesBefore      = document.getElementsByClassName('availability');
var l                         = availabilitiesBefore.length;
var availabilitiesBeforeArray = [];
var availabilitiesAfterArray  = [];
var updateQuery;

for(var i = 0; i < l; i++) {
    availabilitiesBeforeArray.push(availabilitiesBefore[i].options.selectedIndex);
}

function anyChanges() {
    var availabilitiesAfter  = document.getElementsByClassName('availability');
    availabilitiesAfterArray = [];

    for(var i = 0; i < l; i++) {
        availabilitiesAfterArray.push(availabilitiesAfter[i].options.selectedIndex);
    }

    // Generate SQL query string in the format: (roomId,newAvailability), ...
    updateQuery = '';

    for(var i = 0; i < l; i++) {
        if(availabilitiesBeforeArray[i] !== availabilitiesAfterArray[i]) {
            updateQuery += '(' + availabilitiesBefore[i].getAttribute('data-room-id') + ',' + (availabilitiesAfterArray[i]^1) + '),';
        }
    }

    // Remove trailing comma
    updateQuery = updateQuery.slice(0, -1);

    if(updateQuery === '') {
        return false;
    } else {
        return true;
    }
}