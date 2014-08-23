/*!
  * Precise Pixels | http://precisepixels.co.uk
  * https://github.com/Precise-Pixels/student-rooma
  */

var tabBooked    = document.getElementById('tab--booked');
var tabStarred   = document.getElementById('tab--starred');
var tabNos       = document.getElementById('tab--nos');
var slider       = document.getElementById('content-slider');
var wrapperWidth = document.getElementById('content-wrapper').offsetWidth;
var currentSlide;

tabBooked.addEventListener('click', function() {
    changeTab('booked');
});

tabStarred.addEventListener('click', function() {
    changeTab('starred');
});

tabNos.addEventListener('click', function() {
    changeTab('nos');
});

window.addEventListener('hashchange', function() {
    changeTab(location.hash.substring(1));
});

changeTab(location.hash.substring(1));

function changeTab(which) {
    resetTabs();

    switch(which) {
        case 'booked':
            slider.className = 'content-slider--booked content-slider--animate';
            tabBooked.className = 'tab tab--active';
            currentSlide = 0;
            changeHash('booked');
            break;
        case 'starred':
            slider.className = 'content-slider--starred content-slider--animate';
            tabStarred.className = 'tab tab--active';
            currentSlide = 1;
            changeHash('starred');
            break;
        case 'nos':
            slider.className = 'content-slider--nos content-slider--animate';
            tabNos.className = 'tab tab--active';
            currentSlide = 2;
            changeHash('nos');
            break;
    }
}

function changeHash(hash) {
    if('replaceState' in history) {
        history.replaceState({}, '', '#' + hash);
    } else {
        location.hash = hash;
    }
}

function resetTabs() {
    tabBooked.className  = 'tab';
    tabStarred.className = 'tab';
    tabNos.className     = 'tab';
}

window.addEventListener('touchstart', sliderStart);
window.addEventListener('touchmove', sliderMove);
window.addEventListener('touchend', sliderEnd);

var sliderTouchStart,
    sliderTouchMove,
    sliderMoveAmt,
    sliderMoveEnd = 0;

function sliderStart(e) {
    slider.className = slider.className.replace(' content-slider--animate', '');
    sliderTouchStart = e.touches[0].pageX;
    sliderTouchMove  = 0;
}

function sliderMove(e) {
    sliderTouchMove = e.touches[0].pageX;

    // Don't overscroll if on the last slide
    if(currentSlide !== 2 || sliderTouchStart < sliderTouchMove) {
        sliderMoveAmt = currentSlide * wrapperWidth + sliderTouchStart - sliderTouchMove;
        slider.style.transform = slider.style.webkitTransform = 'translate3d(-' + sliderMoveAmt + 'px,0,0)';
    }
}

function sliderEnd(e) {
    sliderMoveEnd = sliderMoveAmt;

    if(sliderTouchMove != 0) {
        if(sliderTouchMove - sliderTouchStart < wrapperWidth / 4 && currentSlide != 2) {
            currentSlide++;
        }

        if(sliderTouchMove - sliderTouchStart > wrapperWidth / 4 && currentSlide != 0) {
            currentSlide--;
        }
    }

    switch(currentSlide) {
        case 0:
            changeTab('booked');
            break;
        case 1:
            changeTab('starred');
            break;
        case 2:
            changeTab('nos');
            break;
    }

    slider.style.transform = slider.style.webkitTransform = '';
}