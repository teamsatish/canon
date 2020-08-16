$(document).ready(function(){

    $(".choosebox input[name='business[]']").click(function() {
        $('.personalform').removeClass('blurdiv');
    })

    $('.thankyouok').click(function() {
        $('.mainblock').removeClass('blurblock');
        $(this).parent().parent().hide();
    });

    if (navigator.platform.match('Mac') !== null) {
        document.body.setAttribute('class', document.body.className + ' MAC');
    }

});