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
                            <label for="room-type">Room type</label>\
                            <input type="radio" id="single-' + rooms.value + '" name="room-type-' + rooms.value + '" value="single" required/> <label for="single-' + rooms.value + '" class="radio-style">Single</label>\
                            <input type="radio" id="double-' + rooms.value + '" name="room-type-' + rooms.value + '" value="double"/> <label for="double-' + rooms.value + '" class="radio-style">Double</label>\
                            <input type="radio" id="single-ensuite-' + rooms.value + '" name="room-type-' + rooms.value + '" value="single-ensuite"/> <label for="single-ensuite-' + rooms.value + '" class="radio-style">Single Ensuite</label>\
                            <input type="radio" id="double-ensuite-' + rooms.value + '" name="room-type-' + rooms.value + '" value="double-ensuite"/> <label for="double-ensuite-' + rooms.value + '" class="radio-style">Double Ensuite</label>\
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