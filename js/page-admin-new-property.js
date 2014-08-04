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
    var e = document.createElement('div');
    e.innerHTML = '<div id="room-' + rooms.value + '">\
                       <label for="room-' + rooms.value + '">Room ' + rooms.value + '</label>\
                       <br>\
                       <label for="room-type">Room type</label>\
                       <input type="radio" name="room-type-' + rooms.value + '" value="single" required/> <label for="single">Single</label>\
                       <input type="radio" name="room-type-' + rooms.value + '" value="double"/> <label for="double">Double</label>\
                       <input type="radio" name="room-type-' + rooms.value + '" value="single-ensuite"/> <label for="single-ensuite">Single Ensuite</label>\
                       <input type="radio" name="room-type-' + rooms.value + '" value="double-ensuite"/> <label for="double-ensuite">Double Ensuite</label>\
                       <br>\
                       <label for="price-' + rooms.value + '">Price (pcm)</label>\
                       <input type="number" name="price-' + rooms.value + '" required/>\
                       <span class="hint">Prices must contain two decimal places: £££.pp</span>\
                       <br>\
                       <label for="availability-' + rooms.value + '">Availabile for letting?</label>\
                       <select name="availability-' + rooms.value + '" required>\
                           <option value="1" selected>Available</option>\
                           <option value="0">Unavailable</option>\
                       </select>\
                       <br>\
                       <label for="room-image-' + rooms.value + '">Room image</label>\
                       <input type="file" name="room-image-' + rooms.value + '" required/>\
                   </div><br>';

    roomFields.appendChild(e);
}

function removeRoomFields() {
    if(roomFields.childNodes.length > 1) {
        roomFields.removeChild(roomFields.childNodes[roomFields.childNodes.length - 1]);
    }
}