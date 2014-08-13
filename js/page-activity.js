var tabBooked  = document.getElementById('tab--booked');
var tabStarred = document.getElementById('tab--starred');
var tabNos     = document.getElementById('tab--nos');
var booked     = document.getElementById('booked');
var starred    = document.getElementById('starred');
var nos        = document.getElementById('nos');

tabBooked.addEventListener('click', function() {
    resetTabs();
    tabBooked.className = 'tab tab--active';
    booked.className    = 'tab-content tab-content--show';
    changeHash('booked');
});

tabStarred.addEventListener('click', function() {
    resetTabs();
    tabStarred.className = 'tab tab--active';
    starred.className    = 'tab-content tab-content--show';
    changeHash('starred');
});

tabNos.addEventListener('click', function() {
    resetTabs();
    tabNos.className = 'tab tab--active';
    nos.className    = 'tab-content tab-content--show';
    changeHash('nos');
});

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