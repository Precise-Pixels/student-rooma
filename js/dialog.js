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
            case 'cancelChanges':
                cancelChanges();
                break;
            case 'resetNos':
                resetNos();
                break;
        }
    });

    dialogButtonN.addEventListener('click', function() {
        switch(event) {
            case 'cancelChanges':
            case 'resetNos':
                closeDialog();
                break;
        }
    });

    dialog.className = 'dialog--show dialog--' + type;
}

function closeDialog() {
    dialog.className = '';
}

function cancelChanges() {
    window.location.href = 'properties';
}

function resetNos() {
    var request = new XMLHttpRequest();
    request.open('GET', '/php/resetNos.php', true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            window.location.href = 'properties';
        } else if(request.status != 200) {
            console.log('An error has occurred. Please try again.');
        }
    }
}