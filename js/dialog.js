var dialog        = document.getElementById('dialog');
var dialogHeading = document.getElementById('dialog-heading');
var dialogText    = document.getElementById('dialog-text');
var dialogButtonY = document.getElementById('dialog-button-y');
var dialogButtonN = document.getElementById('dialog-button-n');

function openDialog(heading, text, buttonY, buttonN, event, type) {
    dialogHeading.innerHTML = heading;
    dialogText.innerHTML    = text;
    dialogButtonY.innerHTML = buttonY;
    dialogButtonN.innerHTML = buttonN;

    dialogButtonY.addEventListener('click', function() {
        switch(event) {
            case 'newPhone':
                closeDialog();
                break;
            case 'cancelProfileChanges':
                cancelProfileChanges();
                break;
            case 'resetNos':
                resetNos();
                break;
            case 'cancelAdminUpdateRoomAvailabilityChanges':
                cancelAdminUpdateRoomAvailabilityChanges();
                break;
            case 'error':
                closeDialog();
                break;
        }
    });

    dialogButtonN.addEventListener('click', function() {
        switch(event) {
            case 'cancelProfileChanges':
            case 'resetNos':
            case 'cancelAdminUpdateRoomAvailabilityChanges':
                closeDialog();
                break;
        }
    });

    dialog.className = 'dialog--show dialog--' + type;
}

function closeDialog() {
    dialog.className = '';
}

function cancelProfileChanges() {
    window.location.href = '/properties';
}

function resetNos() {
    var request = new XMLHttpRequest();
    request.open('GET', '/php/resetNos.php', true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            window.location.href = '/properties';
        } else if(request.status != 200) {
            openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
        }
    }
}

function cancelAdminUpdateRoomAvailabilityChanges() {
    window.location.href = '/admin';
}