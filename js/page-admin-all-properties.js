/*!
  * Precise Pixels | http://precisepixels.co.uk
  * https://github.com/Precise-Pixels/student-rooma
  */

var actives = document.getElementsByClassName('active');

for(var i = 0, l = actives.length; i < l; i++) {
    actives[i].addEventListener('change', changeActive);
}

function changeActive(e) {
    var data = 'propertyId=' + e.target.getAttribute('data-property-id') + '&active=' + +e.target.checked;
    var request = new XMLHttpRequest();
    request.open('POST', '/php/updatePropertyActive.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onreadystatechange = function() {
        if(request.status != 200) {
            openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
        }
    }
}