function heightUpdate(h) {
    document.getElementById("heightValue").innerHTML = h + " cm";   
}

window.onload = function() {
    let newVal = document.getElementById("heightInput").value;
    heightUpdate(newVal);
}