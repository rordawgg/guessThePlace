var img = document.getElementById("main_photo");
var body = document.getElementsByTagName("body")[0];
var counter = document.getElementById("counter_bar");
var inputs = document.querySelectorAll("input[type='submit']");
var mainButtonColor = "white";
var hintColor = "transparent";



img.addEventListener('load', function() {
    var vibrant = new Vibrant(img);
    var swatches = vibrant.swatches()
    for (var swatch in swatches)
        if (swatches.hasOwnProperty(swatch) && swatches[swatch])
            console.log(swatch, swatches[swatch].getHex());
    hintColor = swatches["DarkVibrant"].getHex();
    mainButtonColor = swatches["LightVibrant"].getHex();
    
    body.style.backgroundColor = swatches["Vibrant"].getHex();
    counter.style.backgroundColor = swatches["Muted"].getHex();
    
    for (var i = 0; i < inputs.length; ++i) {
        inputs[i].style.backgroundColor = swatches["LightVibrant"].getHex();
    }
}, false);