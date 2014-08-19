var tabBooked  = document.getElementById('tab--booked');
var tabStarred = document.getElementById('tab--starred');
var tabNos     = document.getElementById('tab--nos');
var slider     = document.getElementById('content-slider');

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
            slider.className = 'content-slider--booked';
            tabBooked.className = 'tab tab--active';
            changeHash('booked');
            break;
        case 'starred':
            slider.className = 'content-slider--starred';
            tabStarred.className = 'tab tab--active';
            changeHash('starred');
            break;
        case 'nos':
            slider.className = 'content-slider--nos';
            tabNos.className = 'tab tab--active';
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