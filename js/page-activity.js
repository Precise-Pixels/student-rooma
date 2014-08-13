var tabBooked  = document.getElementById('tab--booked');
var tabStarred = document.getElementById('tab--starred');
var tabNos     = document.getElementById('tab--nos');
var booked     = document.getElementById('booked');
var starred    = document.getElementById('starred');
var nos        = document.getElementById('nos');

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
            tabBooked.className = 'tab tab--active';
            booked.className    = 'tab-content tab-content--show';
            changeHash('booked');
            break;
        case 'starred':
            tabStarred.className = 'tab tab--active';
            starred.className    = 'tab-content tab-content--show';
            changeHash('starred');
            break;
        case 'nos':
            tabNos.className = 'tab tab--active';
            nos.className    = 'tab-content tab-content--show';
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
    booked.className     = 'tab-content';
    starred.className    = 'tab-content';
    nos.className        = 'tab-content';
}