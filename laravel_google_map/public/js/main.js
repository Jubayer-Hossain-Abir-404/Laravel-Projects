function getLocation()
{
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    }
}

function showPosition(position){
    document.querySelector('.myForm input[name = "latitude"]').value = position.coords.latitude;
    document.querySelector('.myForm input[name = "longitude"]').value = position.coords.longitude;

}

function showError(error)
{
    switch(error.code){
        case error.PERMISSION_DENIED:
            alert("You must Allow The Request For Geolocation To Fill Out The Form");
            location.reload();
            break;
    }
}

