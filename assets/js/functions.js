//Sync time after every five minutes
function sync() {
    var ref = firebase.database().ref('Server/servertime');

    ref.on('value', function (snapshot) {

        $("#servertime").val(snapshot.val());

    });
}

//Update servertime on Firebase
function updatetime() {

    $.ajax({
        url: "http://192.168.0.107/bidwin/update_server.php",
        cache: false,
        success: function (html) {

        }
    });
}

//Increament timer
function timer() {
    setInterval(function () {
            $("#servertime").val(parseInt($("#servertime").val()) + 1);
        }
        , 1000);
}
