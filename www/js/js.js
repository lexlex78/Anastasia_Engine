$(document).ready(function(){
   $('.accordion>li>a').live('click',function() {
        $(this).addClass('select').next('div').slideDown();
        return false;
    }).filter(':first').click();
    $('.accordion>li>a.select').live('click',function() {
        $(this).removeClass('select').next('div').slideUp();
        return false;
    });


    $('.tab-control a').click(function(){
        $('.tabs>div').hide().filter($(this.hash)).show();
        $('.tab-control a').removeClass('select').filter($(this)).addClass('select');
        return false;
    }).filter(':first').click();

    $('.slider').bxSlider({
        auto: true,
        autoControls: false,
        displaySlideQty: 4,
        autoStart : true,
        autoHover : true
    });

    $('.side-nav li>a').click(function(){
        if ($(this).parent().is(':has(div,ul)') && !$(this).hasClass('selected')){
        $(this).parent().parent().children('li').children('ul').not($(this).next('ul')).slideUp(300);
            $(this).next('ul').slideDown(300);

        $(this).parent().parent().children('li').children('a').removeClass('selected').filter($(this)).addClass('selected');
        if ($(this).next().find('li').is(':has(ul)')) {
//            $(this).next().find('li:first').children('a').click();
        }
            return false;
        }
    }).filter($('.side-nav').find('.action')).click();

    $('.basket-way').live("click", function(){
        $('.popup').fadeIn("normal");
        $('.popup-under').fadeTo("normal", 0.33);
    });
    $('.popup-under, .black-del').live("click", function(){
        $('.popup-under, .popup').fadeOut();
    });

    $('.red-del').click(function(){
        $(this).parent().parent().remove();
    });
});
