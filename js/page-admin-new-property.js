/*!
  * Precise Pixels | http://precisepixels.co.uk
  * https://github.com/Precise-Pixels/student-rooma
  */

var rooms          = document.getElementById('rooms');
var roomsDecrement = document.getElementById('rooms-decrement');
var roomsIncrement = document.getElementById('rooms-increment');
var roomFields     = document.getElementById('room-fields');

roomsDecrement.addEventListener('click', roomsStepper);
roomsIncrement.addEventListener('click', roomsStepper);

function roomsStepper(e) {
    if(e.target.id === 'rooms-decrement' && rooms.value <= '1') {
        rooms.value = 1;
        removeRoomFields();
    } else if(e.target.id === 'rooms-decrement') {
        rooms.value = (+rooms.value) - 1;
        removeRoomFields();
    } else if(e.target.id === 'rooms-increment') {
        roomsDecrement.disabled = false;
        rooms.value = (+rooms.value) + 1;
        addRoomFields();
    }
}

function addRoomFields() {
    var div = document.createElement('div');
    div.id  = 'room-' + rooms.value;
    div.innerHTML =    '<label for="room-' + rooms.value + '">Room ' + rooms.value + '</label>\
                        <div class="form-row">\
                            <label for="room-type-' + rooms.value + '">Room type</label>\
                            <select name="room-type-' + rooms.value + '" required>\
                                <option value="single">Single</option>\
                                <option value="double">Double</option>\
                                <option value="single-ensuite">Single Ensuite</option>\
                                <option value="double-ensuite">Double Ensuite</option>\
                            </select>\
                        </div>\
                        <div class="form-row">\
                            <label for="price-' + rooms.value + '">Price (pcm)</label>\
                            <input type="number" name="price-' + rooms.value + '" required/>\
                        </div>\
                        <div class="form-row">\
                            <label for="availability-' + rooms.value + '">Availabile for letting?</label>\
                            <input type="checkbox" id="checkbox-' + rooms.value + '" name="availability-' + rooms.value + '" value="1" checked/>\
                            <label for="checkbox-' + rooms.value + '" class="checkbox-style"></label>\
                        </div>\
                        <div class="form-row">\
                            <label for="room-image-' + rooms.value + '">Room image</label>\
                            <input type="file" name="room-image-' + rooms.value + '" required/>\
                            <span class="hint">Valid file types: .jpg .jpeg .png</span>\
                        </div>\
                        <hr>';
    roomFields.appendChild(div);
}

function removeRoomFields() {
    if(roomFields.childNodes.length > 1) {
        roomFields.removeChild(roomFields.childNodes[roomFields.childNodes.length - 1]);
    }
}

var radios              = document.form.location;
var distancesCanterbury = document.getElementById('distances-canterbury');
var distancesMedway     = document.getElementById('distances-medway');
var chosenLocation;

for(var i = 0, l = radios.length; i < l; i++) {
    radios[i].addEventListener('change', changeLocation);
}

function changeLocation(e) {
    distancesCanterbury.className = distancesMedway.className = 'form-row';

    if(e.target.id === 'canterbury') {
        chosenLocation = 'canterbury';
        distancesMedway.className = 'form-row--hide';
    } else if(e.target.id === 'medway') {
        chosenLocation = 'medway';
        distancesCanterbury.className = 'form-row--hide';
    }
}

var submit = false;

document.getElementById('submit').addEventListener('click', function() {
    submit = true;
});

window.onbeforeunload = function() {
    if(!submit) {
        return 'Unsaved changes will be lost. Click the Submit button at the bottom of the page to finish adding a new property.';
    }
};

var addressNumber = document.getElementById('address-number');
var address       = document.getElementById('address');
var distanceUKC   = document.getElementById('distance-UKC');
var distanceCCCU  = document.getElementById('distance-CCCU');
var distanceUKM   = document.getElementById('distance-UKM');

addressNumber.addEventListener('change', calculateDistances);
address.addEventListener('change', calculateDistances);

function calculateDistances() {
    if(addressNumber.value != '' && address.value != '') {
        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix({
            origins: [addressNumber.value + ' ' + address.value],
            destinations: ['University of Kent Canterbury', 'Canterbury Christ Church University', 'University of Kent Medway'],
            travelMode: google.maps.TravelMode.WALKING
        }, callback);

        function callback(response, status) {
            if(status === 'OK') {
                var secondsToUKC  = response.rows[0].elements[0].duration.value;
                var secondsToCCCU = response.rows[0].elements[1].duration.value;
                var secondsToUKM  = response.rows[0].elements[2].duration.value;

                if(chosenLocation === 'canterbury') {
                    distanceUKC.value  = Math.round(secondsToUKC / 60);
                    distanceCCCU.value = Math.round(secondsToCCCU / 60);
                } else if(chosenLocation === 'medway') {
                    distanceUKM.value = Math.round(secondsToUKM / 60);
                }
            }
        }
    }
}