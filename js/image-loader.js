loadImages();

function loadImages() {
    var property = document.getElementsByClassName('property--active');
    var map      = property[0].getElementsByClassName('property-map');

    var img = new Image();
    img.src = map[0].getAttribute('data-src');
    img.className = 'property-map';

    img.addEventListener('load', function() {
        img.className = 'property-map property-map--loaded';
    });

    map[0].parentNode.replaceChild(img, map[0]);
}