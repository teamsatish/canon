$(document).ready(function(){

    $(".choosebox input[name='business[]']").click(function() {
        $('.personalform').removeClass('blurdiv');
    })

    // $('.choosebox input[type="checkbox"]').on('change', function() {
    //     $('.choosebox input[type="checkbox"]').not(this).prop('checked', false);
    // });

    $('.thankyouok').click(function() {
        $('.mainblock').removeClass('blurblock');
        $(this).parent().parent().hide();
    });

});