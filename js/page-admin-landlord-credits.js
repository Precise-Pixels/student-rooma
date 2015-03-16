/*!
  * Precise Pixels | http://precisepixels.co.uk
  * https://github.com/Precise-Pixels/student-rooma
  */

var credits = document.getElementsByClassName('credits');

for(var i = 0, l = credits.length; i < l; i++) {
    credits[i].addEventListener('change', changeCredits);
}

function changeCredits(e) {
    var data = 'landlordId=' + e.target.getAttribute('data-landlord-id') + '&credits=' + e.target.value;
    var request = new XMLHttpRequest();
    request.open('POST', '/php/updateLandlordCredits.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onreadystatechange = function() {
        if(request.status != 200) {
            openDialog('Error', '<p>An error has occurred. Please try again.</p>', 'Close', '', 'error', 'alert');
        }
    }
}