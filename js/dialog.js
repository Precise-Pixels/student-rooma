var dialog        = document.getElementById('dialog');
var dialogHeading = document.getElementById('dialog-heading');
var dialogText    = document.getElementById('dialog-text');
var dialogButtonY = document.getElementById('dialog-button-y');
var dialogButtonN = document.getElementById('dialog-button-n');

function openDialog(heading, text, buttonY, buttonN, type) {
    dialogHeading.innerHTML = heading;
    dialogText.innerHTML    = text;
    dialogButtonY.innerHTML = buttonY;
    dialogButtonN.innerHTML = buttonN;

    dialogButtonY.addEventListener('click', function() {
        switch(type) {
            case 'alert':
                closeDialog();
                break;
            case 'prompt':
                resetNos();
                break;
        }
    });

    dialogButtonN.addEventListener('click', function() {
        switch(type) {
            case 'prompt':
                closeDialog();
                break;
        }
    });

    dialog.className = 'dialog--show dialog--' + type;
}

function closeDialog() {
    dialog.className = '';
}

function resetNos() {
    var request = new XMLHttpRequest();
    request.open('GET', '/php/resetNos.php', true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            console.log('Success');
        } else if(request.status != 200) {
            console.log('An error has occurred. Please try again.');
        }
    }
}