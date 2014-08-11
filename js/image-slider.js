loadSlider();

function loadSlider() {
    var property     = document.getElementsByClassName('property--active');
    var controls     = property[0].getElementsByClassName('room-controls');
    var slider       = property[0].getElementsByClassName('room-slider');
    var totalSlides  = property[0].getElementsByClassName('room').length;
    var slideWidth   = controls[0].offsetWidth;
    var tabs         = document.getElementsByClassName('tab');
    var currentSlide = 0;

    controls[0].addEventListener('touchstart', sliderStart);
    controls[0].addEventListener('touchmove', sliderMove);
    controls[0].addEventListener('touchend', slideEnd);

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

    function slideEnd(e) {
        slider[0].className = 'room-slider room-slider--animate';
        if((touchStart - touchMove) > slideWidth / 2 && currentSlide < totalSlides - 1) {
            currentSlide++;
        }

        if((touchStart - touchMove) < ((slideWidth / 2) * -1) && currentSlide > 0) {
            currentSlide--;
        }

        slider[0].style.transform = 'translate3d(-' + currentSlide * slideWidth + 'px,0,0)';
        updateTabs();
    }

    function updateTabs() {
        for(var i = 0, l = tabs.length; i < l; i++) {
            tabs[i].className = 'tab';
        }
        tabs[currentSlide].className += ' tab--active';
    }
}