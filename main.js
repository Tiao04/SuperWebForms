function imgadj() {
    var windowWidth = window.innerWidth;
    if (windowWidth < 1280) {
        $("#start-img").attr("src", "img/logo/start.png");
        $("#start-img").css("width", "200px");
        $("#start-img").css("bottom", "0px");
    } else {
        $("#start-img").attr("src", "img/background-1789175_960_720.png");
        $("#start-img").css("width", "100%");
        $("#start-img").css("max-height", "110%");
        $("#start-img").css("bottom", "55px");
    }
}


$(document).ready(function () {
    setInterval(function () {
        var windowWidth = window.innerWidth;
        if (windowWidth > 600) {
            var cols = $(window).width() / 30;
            $(".textQuestion").attr("cols", String(cols));
        }else{
            var cols = $(window).width() / 15;
            $(".textQuestion").attr("cols", String(cols));
        }}, 1500);

    var title = [
        "C",
        "R",
        "I",
        "A",
        " ",
        "A",
        "V",
        "A",
        "L",
        "I",
        "A",
        "<br>",
        "E",
        "X",
        "P",
        "L",
        "O",
        "R",
        "A",
    ];

    for (let i in title) {
        setTimeout(function () {
            $(".slogan").append(title[i]);
        }, i * 400);
    }

    $("header").load("header.php");
    $("footer").load("footer.php");
    $("#flex_news").load("news.php");
    $('div#cookie').load('cookie.html');

    imgadj();
    setInterval(imgadj, 1500);
});

function contact() {
    $("html, body").animate({
        scrollTop: $(document).height() - $(window).height(),
    });
}
