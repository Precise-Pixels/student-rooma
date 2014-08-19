if(bowser.chrome) {
    location.hash = 'chrome';
} else if(bowser.ios) {
    if(bowser.version == 7) {
        location.hash = 'ios-7';
    } else {
        location.hash = 'ios-6';
    }
} else if(bowser.android) {
    if(bowser.version == 4) {
        location.hash = 'android-4';
    } else {
        location.hash = 'android-3';
    }
} else if(bowser.windowsphone) {
    location.hash = 'windows-phone';
}