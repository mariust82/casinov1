var trackCounter = 0;
function tracker() {
    if (trackCounter>0) return;
    $.ajax({
        url: '/tracker?t='+(new Date()).getTime(),
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
