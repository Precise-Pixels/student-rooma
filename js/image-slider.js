/*!
  * Precise Pixels | http://precisepixels.co.uk
  * https://github.com/Precise-Pixels/student-rooma
  */

loadSlider();

function loadSlider() {
    var property = document.getElementsByClassName('property--active');

    if(property.length) {
        var screenWidth  = (window.innerWidth || document.documentElement.clientWidth);
        var slider       = property[0].getElementsByClassName('room-slider');
        var rooms        = property[0].getElementsByClassName('room');
        var totalSlides  = rooms.length;
        var controls     = property[0].getElementsByClassName('room-controls');
        var tabsWrapper  = property[0].getElementsByClassName('tabs');
        var tabs         = property[0].getElementsByClassName('tab');
        var tabWidth     = 70;
        var slideWidth   = controls[0].offsetWidth;
        var left         = controls[0].getElementsByClassName('room-control--left');
        var right        = controls[0].getElementsByClassName('room-control--right');
        var currentSlide = 0;

        // Functions
        var tabsTouchStart,
            tabsTouchMove,
            tabsMoveAmt,
            tabsMoveEnd = 0,
            tabsMoving  = false,
            tabsSmall   = false;

        function tabsStart(e, interaction) {
            tabsMoving     = true;
            tabsTouchStart = (interaction == 'touch' ? e.touches[0].pageX : e.pageX);
        }

        function tabsMove(e, interaction) {
            if(tabsMoving && tabsSmall) {
                var excess    = (totalSlides * tabWidth - screenWidth) * -1;
                tabsTouchMove = (interaction == 'touch' ? e.touches[0].pageX : e.pageX);
                tabsMoveAmt   = tabsMoveEnd + tabsTouchMove - tabsTouchStart;

                tabsWrapper[0].style.transform = tabsWrapper[0].style.webkitTransform = 'translate3d(' + tabsMoveAmt + 'px,0,0)';

                if(tabsMoveAmt > 0) {
                    tabsMoveAmt = 0;
                    tabsWrapper[0].style.transform = tabsWrapper[0].style.webkitTransform = 'translate3d(' + tabsMoveAmt + 'px,0,0)';
                }

                if(tabsMoveAmt < excess) {
                    tabsMoveAmt = excess;
                    tabsWrapper[0].style.transform = tabsWrapper[0].style.webkitTransform = 'translate3d(' + tabsMoveAmt + 'px,0,0)';
                }
            }
        }

        function tabsEnd(e) {
            tabsMoving  = false;
            tabsMoveEnd = tabsMoveAmt;
        }

        var sliderTouchStart,
            sliderTouchMove,
            sliderMoveAmt;

        function sliderStart(e) {
            slider[0].className = 'room-slider room-slider--loaded';
            sliderTouchStart = e.touches[0].pageX;
        }

        function sliderMove(e) {
            sliderTouchMove = e.touches[0].pageX;

            // Don't overscroll if on the last slide
            if(currentSlide !== totalSlides - 1 || sliderTouchStart < sliderTouchMove) {
                sliderMoveAmt = currentSlide * slideWidth + sliderTouchStart - sliderTouchMove;
                slider[0].style.transform = slider[0].style.webkitTransform = 'translate3d(-' + sliderMoveAmt + 'px,0,0)';
            }
        }

        function sliderEnd(e) {
            if((sliderTouchStart - sliderTouchMove) > slideWidth / 4 && currentSlide < totalSlides - 1) {
                currentSlide++;
            }

            if((sliderTouchStart - sliderTouchMove) < ((slideWidth / 4) * -1) && currentSlide > 0) {
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
            slider[0].className = 'room-slider room-slider--loaded room-slider--animate';
            slider[0].style.transform = slider[0].style.webkitTransform = 'translate3d(-' + currentSlide * slideWidth + 'px,0,0)';
        }

        // Init
        tabsWrapper[0].className       = tabsWrapper[0].className.replace(' tabs--small', '');
        tabsWrapper[0].style.width     = '';
        tabsWrapper[0].style.transform = tabsWrapper[0].style.webkitTransform = '';

        if(screenWidth < totalSlides * tabWidth) {
            tabsWrapper[0].className  += ' tabs--small';
            tabsWrapper[0].style.width = totalSlides * tabWidth + 'px';
            tabsSmall = true;
        }

        slider[0].className = 'room-slider room-slider--loaded';

        for(var i = 0; i < totalSlides; i++) {
            rooms[i].style.left = 100 * i + '%';
        }

        updateTabs();

        // Listeners
        for(var i = 0, l = tabs.length; i < l; i++) {
            tabs[i].addEventListener('click', clickTabs);
        }

        tabsWrapper[0].addEventListener('touchstart', function(e) { tabsStart(e, 'touch'); });
        tabsWrapper[0].addEventListener('touchmove', function(e) { tabsMove(e, 'touch'); });
        tabsWrapper[0].addEventListener('touchend', tabsEnd);
        tabsWrapper[0].addEventListener('mousedown', function(e) { tabsStart(e, 'mouse'); });
        tabsWrapper[0].addEventListener('mousemove', function(e) { tabsMove(e, 'mouse'); });
        tabsWrapper[0].addEventListener('mouseup', tabsEnd);

        controls[0].addEventListener('touchstart', sliderStart);
        controls[0].addEventListener('touchmove', sliderMove);
        controls[0].addEventListener('touchend', sliderEnd);
        left[0].addEventListener('click', sliderLeft);
        right[0].addEventListener('click', sliderRight);
    }

    var resizeTimer;

    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            slideWidth = controls[0].offsetWidth;
            slider[0].style.transform = slider[0].style.webkitTransform = 'translate3d(-' + currentSlide * slideWidth + 'px,0,0)';
        }, 100);
    });
}