document.getElementById('header-btn-l').addEventListener('click', function() {
    if(anyChanges()) {
        openDialog("Cancel Changes", "<p>There are unsaved changes. Are you sure you want to cancel?</p>", 'Yes', 'No', 'cancelAdminUpdateRoomStatusChanges', prompt);
    } else {
        window.location.href= '/admin';
    }
});

document.getElementById('header-btn-r').addEventListener('click', function() {
    if(anyChanges()) {
        var data = 'updateQuery=' + updateQuery;
        var request = new XMLHttpRequest();
        request.open('POST', '/php/updateRoomStatus.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                window.location.href = '/admin/update-room-status?status=success';
            } else if(request.status != 200) {
                console.log('An error has occurred. Please try again.');
            }
        }
    } else {
        window.location.href= '/admin/update-room-status?status=unchanged';
    }
});

// Compare before and after states of all drop-downs to check for any changes
var statusesBefore      = document.getElementsByClassName('status');
var l                   = statusesBefore.length;
var statusesBeforeArray = [];
var statusesAfterArray  = [];
var updateQuery;

for(var i = 0; i < l; i++) {
    statusesBeforeArray.push(statusesBefore[i].options.selectedIndex);
}

function anyChanges() {
    var statusesAfter  = document.getElementsByClassName('status');
    statusesAfterArray = [];

    for(var i = 0; i < l; i++) {
        statusesAfterArray.push(statusesAfter[i].options.selectedIndex);
    }

    // Generate SQL query string in the format: (roomId,newStatus), ...
    updateQuery = '';

    for(var i = 0; i < l; i++) {
        if(statusesBeforeArray[i] !== statusesAfterArray[i]) {
            updateQuery += '(' + statusesBefore[i].getAttribute('data-room-id') + ',' + (statusesAfterArray[i]^1) + '),';
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