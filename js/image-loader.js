loadImages();

function loadImages() {
    var property = document.getElementsByClassName('property--active');

    if(property.length) {
        var roomsWrapper = property[0].getElementsByClassName('rooms');
        var rooms        = property[0].getElementsByClassName('room-image');
        var map          = property[0].getElementsByClassName('property-map');
        var width        = Math.round((window.innerWidth || document.documentElement.clientWidth));
        var height       = Math.round(width * 0.5625);
        var imagesLoaded = 0;

        // Rooms
        for(var i = 0, l = rooms.length; i < l; i++) {
            var img = new Image();
            img.src = rooms[i].getAttribute('data-src');
            img.className = 'room-image';

            img.addEventListener('load', function() {
                imagesLoaded++;
                if(imagesLoaded === rooms.length) {
                    roomsWrapper[0].className += ' rooms--loaded';
                }
            });

            rooms[i].parentNode.replaceChild(img, rooms[i]);
        }

        // Map
        if(width > 640 || height > 640) {
            width = 640;
            height = 360;
        }

        var img = new Image();
        img.src = map[0].childNodes[0].getAttribute('data-src').replace('WIDTH', width).replace('HEIGHT', height);

        img.addEventListener('load', function() {
            map[0].className = 'property-map property-map--loaded';
        });

        map[0].replaceChild(img, map[0].childNodes[0]);
    }
}