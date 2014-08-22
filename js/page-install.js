/*!
  * Precise Pixels | http://precisepixels.co.uk
  * https://github.com/Precise-Pixels/student-rooma
  */

if(bowser.chrome) {
    location.hash = 'chrome';
} else if(bowser.ios) {
    location.hash = 'ios';
} else if(bowser.android) {
    if(bowser.version == 4) {
        location.hash = 'android-4';
    } else {
        location.hash = 'android-3';
    }
} else if(bowser.windowsphone) {
    location.hash = 'windows-phone';
}