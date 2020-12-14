var trackCounter = 0;
function tracker() {
    if (trackCounter>0) return;
    $.ajax({
        url: '/tracker',
        type: 'get',
        data: {},
    }).done(function (data) {
        $(window).unbind('mousemove', tracker);
    });
    trackCounter++;
}

$( document ).ready(function() {
    $(window).on('mousemove', tracker);
});