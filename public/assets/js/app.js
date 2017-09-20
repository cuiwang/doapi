//背景选择

$(function () {
    $("#button-bg1").click(function () {
        $("body").css({
            "background": "url('../../assets/img/1.jpg')no-repeat center center fixed"
        });
        changeBg('1.jpg');

    });
    $("#button-bg2").click(function () {
        $("body").css({
            "background": "url('../../assets/img/2.jpg')no-repeat center center fixed"
            ,"background-size": "cover"
        });
        changeBg('2.jpg');
    });
    $("#button-bg3").click(function () {
        $("body").css({
            "background": "url('../../assets/img/3.jpg')no-repeat center center fixed"
            ,"background-size": "cover"
        });
        changeBg('3.jpg');

    });
    $("#button-bg4").click(function () {
        $("body").css({
            "background": "url('../../assets/img/4.jpg')no-repeat center center fixed"
            ,"background-size": "cover"
        });
        changeBg('4.jpg');

    });
    $("#button-bg5").click(function () {
        $("body").css({
            "background": "url('../../assets/img/5.jpg')no-repeat center center fixed"
            ,"background-size": "cover"
        });
        changeBg('5.jpg');

    });
    $("#button-bg6").click(function () {
        $("body").css({
            "background": "url('../../assets/img/6.jpg')no-repeat center center fixed"
            ,"background-size": "cover"
        });
        changeBg('6.jpg');

    });
    $("#button-bg7").click(function () {
        $("body").css({
            "background": "url('../../assets/img/7.jpg')no-repeat center center fixed"
            ,"background-size": "cover"
        });
        changeBg('7.jpg');

    });
    $("#button-bg8").click(function () {
        $("body").css({
            "background": "url('../../assets/img/8.jpg')no-repeat center center fixed"
            ,"background-size": "cover"
        });
        changeBg('8.jpg');

    });
    $("#button-bg9").click(function () {
        $("body").css({
            "background": "url('../../assets/img/9.jpg')no-repeat center center fixed"
            ,"background-size": "cover"
        });
        changeBg('9.jpg');

    });
    $("#button-bg10").click(function () {
        $("body").css({
            "background": "url('../../assets/img/10.jpg')no-repeat center center fixed"
            ,"background-size": "cover"
        });
        changeBg('10.jpg');

    });
    $("#button-bg11").click(function () {
        $("body").css({
            "background": "url('../../assets/img/11.jpg')no-repeat center center fixed"
            ,"background-size": "cover"
        });
        changeBg('11.jpg');

    });
    $("#button-bg12").click(function () {
        $("body").css({
            "background": "url('../../assets/img/12.jpg')no-repeat center center fixed"
            ,"background-size": "cover"
        });
        changeBg('12.jpg');

    });
    $("#button-bg13").click(function () {
        $("body").css({
            "background": "url('../../assets/img/13.jpg')no-repeat center center fixed"
            ,"background-size": "cover"
        });
        changeBg('13.jpg');

    });
    //$('#button-bg8').trigger("click");//默认点击

});


/**
 * Background Changer end
 */
//TOGGLE CLOSE
$('.nav-toggle').click(function () {
    //get collapse content selector
    var collapse_content_selector = $(this).attr('href');

    //make the collapse content to be shown or hide
    var toggle_switch = $(this);
    $(collapse_content_selector).slideToggle(function () {
        if ($(this).css('display') == 'block') {
            //change the button label to be 'Show'
            toggle_switch.html('<span class="entypo-minus-squared"></span>');
        } else {
            //change the button label to be 'Hide'
            toggle_switch.html('<span class="entypo-plus-squared"></span>');
        }
    });
});


$('.nav-toggle-alt').click(function () {
    //get collapse content selector
    var collapse_content_selector = $(this).attr('href');

    //make the collapse content to be shown or hide
    var toggle_switch = $(this);
    $(collapse_content_selector).slideToggle(function () {
        if ($(this).css('display') == 'block') {
            //change the button label to be 'Show'
            toggle_switch.html('<span class="entypo-up-open"></span>');
        } else {
            //change the button label to be 'Hide'
            toggle_switch.html('<span class="entypo-down-open"></span>');
        }
    });
    return false;
});
//CLOSE ELEMENT
$(".gone").click(function () {
    var collapse_content_close = $(this).attr('href');
    $(collapse_content_close).hide();


});

//tooltip
$('.tooltitle').tooltip();

 