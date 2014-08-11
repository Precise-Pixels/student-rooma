loadImages();

function loadImages() {
    var property = document.getElementsByClassName('property--active');
    var map      = property[0].getElementsByClassName('property-map');
    var width    = Math.round((window.innerWidth || document.documentElement.clientWidth));
    var height   = Math.round(width * 0.5625);

    var img = new Image();
    img.src = map[0].getAttribute('data-src').replace('WIDTH', width).replace('HEIGHT', height);
    img.className = 'property-map';

    img.addEventListener('load', function() {
        img.className = 'property-map property-map--loaded';
    });

    map[0].parentNode.replaceChild(img, map[0]);
}