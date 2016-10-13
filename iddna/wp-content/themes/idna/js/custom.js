jQuery( ".iddna a" ).addClass( "popup-with-zoom-anim" );

jQuery(".two-thirds #user_login").attr("placeholder", "Username");
jQuery(".two-thirds #user_pass").attr("placeholder", "Password");

/******************************************
*	Video Autoplay
******************************************/
//jQuery("#video-home .html5vid video").play();

jQuery(document).ready(function() {
    setTimeout(function(){
        jQuery('body').addClass('loaded');
    }, 3000);    
});


jQuery(window).load(function(){
  /*****Preloader off****/
  jQuery('#loading').fadeOut("slow");
  jQuery('.splash-content').fadeIn("slow");
});

jQuery(".menu-top-menu-container .skype a").attr("href", "skype:SuisseLifeScience?call");

/*
jQuery( "form.search-form" ).append("<div class='btnsearch'><i class='fa fa-search'></i></div>")
jQuery( "form.search-form .btnsearch" ).click(function() {
  jQuery( "form.search-form input[type='search']" ).toggleClass( "search-effect" );
  jQuery( "form.search-form" ).toggleClass( "form-effect" );
});*/

/*******************************
*	Adding span to checkbox
*******************************/
jQuery( "form#loginform .login-remember label" ).append("<span class='chk'></span>")

/********************************
*	Contact Form selects Hide
********************************/
jQuery( "#state-us" ).hide();
jQuery( "#canada-p" ).hide();

jQuery('#country-option').change(function(){
            var i= jQuery('#country-option').val();

            if(i=="USA")
            {
                jQuery('#state-us').show();
                jQuery('#canada-p').hide();
            }
           	if(i=="Canada")
            {
                jQuery('#state-us').hide(); // hide the first one
                jQuery('#canada-p').show(); // show the other one
            }
            if (i=="Country (required)") {
				jQuery('#state-us').hide();
                jQuery('#canada-p').hide();
            }
});


jQuery(function( $ ){

    $("header .genesis-nav-menu, .nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu, .top-area-content .widget_nav_menu").addClass("responsive-menu").before('<div class="responsive-menu-icon"></div>');

    $(".responsive-menu-icon").click(function(){
        $(this).next("header .genesis-nav-menu, .nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu, .top-area-content .widget_nav_menu").slideToggle();
    });

    $(window).resize(function(){
        if(window.innerWidth > 767) {
            $("header .genesis-nav-menu, .nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu, nav .sub-menu, .top-area-content .widget_nav_menu, .top-area-content .widget_nav_menu .sub-menu").removeAttr("style");
            $(".responsive-menu > .menu-item").removeClass("menu-open");
        }
    });

    $(".responsive-menu > .menu-item, .responsive-menu .menu-top-menu-container .menu .menu-item").click(function(event){
        if (event.target !== this)
        return;
            $(this).find(".sub-menu:first").slideToggle(function() {
            $(this).parent().toggleClass("menu-open");
        });
    });

});