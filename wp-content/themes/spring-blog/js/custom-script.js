jQuery(document).ready(function($) {

	// Navigation

	$('#masthead').find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( '<button class="submenu-button"></button>' );

	$('.submenu-button').click( function() {
		$(this).parent().find('.sub-menu').first().slideToggle();
	});

	$('.main-navigation-toggle').click( function() {
		$(this).toggleClass('menu-opened');
		$('.nav-menu').slideToggle();
	});

	if( $(window).width() < 1024 ) {
        $('.nav-menu').find("li").last().bind( 'keydown', function(e) {
            if( !e.shiftKey && e.which === 9 ) {
                e.preventDefault();
                $('.site-header').find('.main-navigation-toggle').focus();
            }
        });
    }
    else {
        $('.nav-menu').find("li").unbind('keydown');
    }

    $(window).resize(function() {
        if( $(window).width() < 1024 ) {
            $('.nav-menu').find("li").last().bind( 'keydown', function(e) {
                if( !e.shiftKey && e.which === 9 ) {
                    e.preventDefault();
                    $('.site-header').find('.main-navigation-toggle').focus();
                }
            });
        }
        else {
            $('.nav-menu').find("li").unbind('keydown');
        }
    });

    $('.main-navigation-toggle').on('keydown', function (e) {
        var tabKey    = e.keyCode === 9;
        var shiftKey  = e.shiftKey;

        if( $('.main-navigation-toggle').hasClass('menu-opened') ) {
            if ( shiftKey && tabKey ) {
                e.preventDefault();
                $('.nav-menu').find("li:last-child > a").focus();
                $('.nav-menu').find("li").last().bind( 'keydown', function(e) {
                    if( !e.shiftKey && e.which === 9 ) {
                        e.preventDefault();
                        $('.site-header').find('.main-navigation-toggle').focus();
                    }
                });
            }
        }
    });

});
