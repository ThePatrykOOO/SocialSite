$(document).ready(function () {
    function p() { //funkcja kontrolna
        alert("WORK");
    }
    //read more in profile
    $('#profil-hide').hide();
    $("#more-profil").click(function(){
        $("#profil-hide").toggle();
    });

    $(document).ready(function(){
        $("#flip").click(function(){
            $("#panel").slideToggle("slow");
        });
    });

    $('.panelIcon').click(function () {
        $('#leftside').css({width:"80%",visibility:"visible"}).toggle();
    });
    $('.chatIcon').click(function () {
        $('.chatSide').css({width:"80%",visibility:"visible"}).toggle();
    });


    //add post
    $('#addPost').click(function () {
        var message = $("#postText").val();
        $.ajax ({
            url:'../php/route.php',
            data: {action:"addPost",postText:message},
            type: 'POST',
            success: function (data) {
                $(".col-lg-12 .post").html(data);
            }
        });
        $.ajax ({
            url:'../php/route.php',
            data: {action:"showMainPost"},
            type: 'POST',
            success: function (data) {
                $("#posts").html(data);
            }
        });
    });

    // show post on main page
    // $('#main').ready(function () {
    //     $.ajax ({
    //         url:'../php/route.php',
    //         data: {action:"showMainPost"},
    //         type: 'POST',
    //         success: function (data) {
    //             $("#main").html(data);
    //         }
    //     });
    // });

//    Post like
    $('.likePost').click(function () {
        var id = $(this).val();
        $.ajax ({
            url:'../php/route.php',
            data: {action:"likePost",id:id},
            type: 'POST',
            success: function (data) {
                $(".col-lg-12 .post").html(data);
            }
        });
    });

    //Just unlike post
    $('.alreadyUnlike').click(function () {
        var id = $(this).val();
        $.ajax ({
            url:'../php/route.php',
            data: {action:"alreadyUnlike",id:id},
            type: 'POST',
            success: function (data) {
                $(".col-lg-12 .post").html(data);
            }
        });
    });

//    already like post
    $('.alreadyLike').click(function () {
        var id = $(this).val();
        $.ajax ({
            url:'../php/route.php',
            data: {action:"alreadyLike",id:id},
            type: 'POST',
            success: function (data) {
                $(".col-lg-12 .post .optionsPost").html(data);
            }
        });
    });

    //Unlike post
    $('.unLikePost').click(function () {
        var id = $(this).val();
        $.ajax ({
            url:'../php/route.php',
            data: {action:"unLikePost",id:id},
            type: 'POST',
            success: function (data) {
                $(".col-lg-12 .post .optionsPost").html(data);
            }
        });
    });

    $('.unLikePost').click(function () {
        var id = $(this).val();
        $.ajax ({
            url:'../php/route.php',
            data: {action:"unLikePost",id:id},
            type: 'POST',
            success: function (data) {
                $(".col-lg-12 .post .optionsPost").html(data);
            }
        });
    });

    function likePageStatus() {
        var id = window.id();
        $.ajax({
            url: '../php/route.php',
            data: {action: "showPageStatus", id: id},
            type: 'POST',
            success: function (data) {
                $("#likeStatus").html(data);
            }
        });
    }
    likePageStatus(id)
    //like page status
    if ($('#likeStatus').length) {
        var id = $(this).val();
        likePageStatus(id)
    }

    //like page
    $('#likeSite').click(function () {
        var id = window.id();
        $.ajax ({
            url:'../php/route.php',
            data: {action:"likeSite",id:id},
            type: 'POST',
            success: function (data) {
                $("#likeStatus").html(data);
            }
        });

    });


    //unlike page
    $('#UnlikeSite').click(function () {
        var id = window.id();
        $.ajax ({
            url:'../php/route.php',
            data: {action:"UnlikeSite",id:id},
            type: 'POST',
            success: function (data) {
                $("#likeStatus").html(data);
            }
        });
    });
});