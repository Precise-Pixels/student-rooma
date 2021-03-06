/*!
  * Precise Pixels | http://precisepixels.co.uk
  * https://github.com/Precise-Pixels/student-rooma
  */

var dialog        = document.getElementById('dialog');
var dialogHeading = document.getElementById('dialog-heading');
var dialogText    = document.getElementById('dialog-text-wrapper');
var dialogButtonY = document.getElementById('dialog-button-y');
var dialogButtonN = document.getElementById('dialog-button-n');
var main          = document.getElementsByTagName('main')[0];
var dialogFunc;
var phoneDialogOpened = false;

function openDialog(heading, text, buttonY, buttonN, func, type) {
    if(func == 'newPhone' && phoneDialogOpened) { return }
    dialogFunc = func;
    dialogHeading.innerHTML = heading;
    dialogText.innerHTML    = '<div id="dialog-text">' + text + '</div>';
    dialogButtonY.innerHTML = buttonY;
    dialogButtonN.innerHTML = buttonN;

    dialogButtonY.addEventListener('click', clickDialogButtonY);
    dialogButtonN.addEventListener('click', clickDialogButtonN);

    dialog.className = 'dialog--show dialog--' + type;
    main.className  += ' dialog--show';
}

function clickDialogButtonY() {
    switch(dialogFunc) {
        case 'newPhone':
            phoneDialogOpened = true;
            document.getElementById('phone').focus();
            closeDialog();
            break;
        case 'profileIncomplete':
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
}

function clickDialogButtonN() {
    switch(dialogFunc) {
        case 'cancelProfileChanges':
        case 'resetNos':
        case 'cancelAdminUpdateRoomAvailabilityChanges':
            closeDialog();
            break;
    }
}

function closeDialog() {
    dialogFunc              = null;
    dialog.className        = '';
    main.className          = main.className.replace(' dialog--show', '');
    dialogHeading.innerHTML = '';
    dialogText.innerHTML    = '';
    dialogButtonY.innerHTML = '';
    dialogButtonN.innerHTML = '';
    dialogButtonY.removeEventListener('click', clickDialogButtonY);
    dialogButtonN.removeEventListener('click', clickDialogButtonN);
}

function cancelProfileChanges() {
    window.location.href = '/app/properties';
}

function resetNos() {
    var request = new XMLHttpRequest();
    request.open('GET', '/php/resetNos.php', true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            window.location.href = '/app/properties';
        } else if(request.status != 200) {
            openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
        }
    }
}

function cancelAdminUpdateRoomAvailabilityChanges() {
    window.location.href = '/app/admin';
}