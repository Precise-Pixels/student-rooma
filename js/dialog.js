var dialog        = document.getElementById('dialog');
var dialogHeading = document.getElementById('dialog--heading');
var dialogText    = document.getElementById('dialog--text');
var dialogButton  = document.getElementById('dialog--button');

function openDialog(heading, text, button, type) {
    dialogHeading.innerHTML = heading;
    dialogText.innerHTML    = text;
    dialogButton.innerHTML  = button;

    dialogButton.addEventListener('click', function() {
        switch(type) {
            case 'alert':
                closeDialog();
                break;
        }
    });

    dialog.className = 'dialog--show';
}

function closeDialog() {
    dialog.className = '';
}