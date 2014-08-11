loadSlider();

function loadSlider() {
    var property     = document.getElementsByClassName('property--active');
    var slider       = property[0].getElementsByClassName('room-slider');
    var totalSlides  = property[0].getElementsByClassName('room').length;
    var controls     = property[0].getElementsByClassName('room-controls');
    var slideWidth   = controls[0].offsetWidth;
    var left         = controls[0].getElementsByClassName('room-control--left');
    var right        = controls[0].getElementsByClassName('room-control--right');
    var tabs         = document.getElementsByClassName('tab');
    var currentSlide = 0;

    controls[0].addEventListener('touchstart', sliderStart);
    controls[0].addEventListener('touchmove', sliderMove);
    controls[0].addEventListener('touchend', sliderEnd);
    left[0].addEventListener('click', sliderLeft);
    right[0].addEventListener('click', sliderRight);

    for(var i = 0, l = tabs.length; i < l; i++) {
        tabs[i].addEventListener('click', clickTabs);
    }

    var touchStart,
        touchMove,
        move,
        pan;

    slider[0].style.width = totalSlides * 100 + '%';

    updateTabs();

    function sliderStart(e) {
        slider[0].className = 'room-slider';
        touchStart = e.touches[0].pageX;
    }

    function sliderMove(e) {
        touchMove = e.touches[0].pageX;

        // Don't overscroll if on the last slide
        if(currentSlide !== totalSlides - 1 || touchStart < touchMove) {
            move = currentSlide * slideWidth + touchStart - touchMove;
            slider[0].style.transform = 'translate3d(-' + move + 'px,0,0)';
        }
    }

    function sliderEnd(e) {
        if((touchStart - touchMove) > slideWidth / 4 && currentSlide < totalSlides - 1) {
            currentSlide++;
        }

        if((touchStart - touchMove) < ((slideWidth / 4) * -1) && currentSlide > 0) {
            currentSlide--;
        }

        animateSlide();
        updateTabs();
    }

    function sliderLeft() {
        if(currentSlide > 0) {
            currentSlide--;
            animateSlide();
            updateTabs();
        }
    }

    function sliderRight() {
        if(currentSlide < totalSlides - 1) {
            currentSlide++;
            animateSlide();
            updateTabs();
        }
    }

    function clickTabs(e) {
        currentSlide = +e.target.className.match(/\d+/)[0];
        animateSlide();
        updateTabs();
    }

    function updateTabs() {
        for(var i = 0, l = tabs.length; i < l; i++) {
            tabs[i].className = tabs[i].className.replace(' tab--active', '');
        }
        tabs[currentSlide].className += ' tab--active';
    }

    function animateSlide() {
        slider[0].className = 'room-slider room-slider--animate';
        slider[0].style.transform = 'translate3d(-' + currentSlide * slideWidth + 'px,0,0)';
    }
}