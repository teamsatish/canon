$(document).ready(function(){

    $(".choosebox input[name='business[]']").click(function() {
        $('.personalform').removeClass('blurdiv');
    })

    $('.thankyouok').click(function() {
        $('.mainblock').removeClass('blurblock');
        $(this).parent().parent().hide();
    });

});