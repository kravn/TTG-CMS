$(window).load(function() {
    $.get('games', function(data) {
        console.log(data.menu['@attributes'].account);
    });
});

$(function() {
    $('img').addClass('img-responsive');
    $('iframe[src*="youtube.com"]').each(function() {
        $(this).parent("p").append($("<div></div>").addClass("flex-video").append($(this)));
    });
    $("body").floatingSocialShare({
        buttons: ["facebook","twitter","google-plus"],
        text: ""
    });
});