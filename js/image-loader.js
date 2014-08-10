var maps = document.getElementsByClassName('property-map');


for(var i = 0, l = maps.length; i < l; i++) {
    var img = new Image();
    img.src = maps[i].getAttribute('data-src');
    img.className = 'property-map';

    maps[i].parentNode.replaceChild(img, maps[i]);
}