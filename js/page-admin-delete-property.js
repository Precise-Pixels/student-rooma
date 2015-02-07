/*!
  * Precise Pixels | http://precisepixels.co.uk
  * https://github.com/Precise-Pixels/student-rooma
  */

var buttons = document.getElementsByTagName('button');

for(var i = 0, l = buttons.length; i < l; i++) {
    buttons[i].addEventListener('click', deleteProperty);
}

function deleteProperty(e) {
    var confirm = window.confirm('Are you sure you want to delete this property?');

    if(confirm) {
        e.target.className = 'button--spinner';

        var data = 'propertyId=' + e.target.getAttribute('data-property-id');
        var request = new XMLHttpRequest();
        request.open('POST', '/php/deleteProperty.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                location.reload();
            } else if(request.status != 200) {
                openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
            }
        }
    }
}