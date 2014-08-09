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

for(var i = 0, l = radios.length; i < l; i++) {
    radios[i].addEventListener('change', changeLocation);
}

function changeLocation(e) {
    distancesCanterbury.className = distancesMedway.className = 'form-row';

    if(e.target.id === 'canterbury') {
        distancesMedway.className = 'form-row--hide';
    } else if(e.target.id === 'medway') {
        distancesCanterbury.className = 'form-row--hide';
    }
}

window.onbeforeunload = function() {
    return 'Unsaved changes will be lost. Click the Submit button at the bottom of the page to finish adding a new property.';
};