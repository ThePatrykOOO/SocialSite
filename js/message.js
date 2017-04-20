$(document).ready(function () {

    function showMessage() {
        var id = window.id();
        $.ajax ({
            url:'../php/route.php',
            data: {action:"showMessage", id:id},
            type: 'POST',
            success: function (data) {
                $(".messenger").html(data);
            }
        });
    }
    showMessage();
    setInterval(showMessage,2000);
    $('#sendMessage').click(function () {
        var id = $("#sendMessage").val();
        var message = $("#message").val();
        $.ajax ({
            url:'../php/route.php',
            data: {action:"sendMessage",message:message, id:id},
            type: 'POST',
            success: function (data) {
                showMessage();
                $(".messenger").html(data);
            }
        });
    });
});