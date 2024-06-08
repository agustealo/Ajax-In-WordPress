( function( $ ) {
    // Site Title and Tagline.
    wp.customize( 'blogname', function( value ) {
        value.bind( function( to ) {
            $( '.site-title a' ).text( to );
        } );
    } );
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $( '.site-description' ).text( to );
        } );
    } );

    // Color Scheme.
    wp.customize( 'ajaxinwp_color_scheme', function( value ) {
        value.bind( function( to ) {
            document.body.dataset.theme = to;

            if ( to === 'auto' ) {
                adjustThemeBasedOnTime();
            }
        } );
    } );

    // Function to adjust the theme based on the time
    function adjustThemeBasedOnTime() {
        const currentHour = new Date().getHours();

        if (currentHour >= 19 || currentHour < 7) {
            document.body.dataset.theme = 'dark';
        } else {
            document.body.dataset.theme = 'light';
        }
    }

    // Other Customizer settings...
    wp.customize( 'ajaxinwp_Header1_bg_color', function( value ) {
        value.bind( function( to ) {
            $( 'header' ).css( 'background-color', to );
        } );
    } );

    wp.customize( 'ajaxinwp_font_size', function( value ) {
        value.bind( function( to ) {
            $( 'body' ).css( 'font-size', to + 'px' );
        } );
    } );

    wp.customize( 'ajaxinwp_link_color', function( value ) {
        value.bind( function( to ) {
            $( 'a' ).css( 'color', to );
        } );
    } );

    wp.customize( 'ajaxinwp_background_color', function( value ) {
        value.bind( function( to ) {
            $( 'body' ).css( 'background-color', to );
        } );
    } );

    wp.customize( 'ajaxinwp_footer_text', function( value ) {
        value.bind( function( to ) {
            $( '.footer-text' ).text( to );
        } );
    } );

    wp.customize( 'ajaxinwp_navigation_layout', function( value ) {
        value.bind( function( to ) {
            if ( to === 'container' ) {
                $( '.navbar' ).addClass( 'container' ).removeClass( 'container-fluid default' );
            } else if ( to === 'container-fluid' ) {
                $( '.navbar' ).addClass( 'container-fluid' ).removeClass( 'container default' );
            } else {
                $( '.navbar' ).addClass( 'default' ).removeClass( 'container container-fluid' );
            }
        } );
    } );

    wp.customize( 'ajaxinwp_nav_text_color', function( value ) {
        value.bind( function( to ) {
            $( '.navbar, .navbar a' ).css( 'color', to );
        } );
    } );

    wp.customize( 'ajaxinwp_nav_bg_color', function( value ) {
        value.bind( function( to ) {
            $( '.navbar' ).css( 'background-color', to );
        } );
    } );

    wp.customize( 'ajaxinwp_button_background_color', function( value ) {
        value.bind( function( to ) {
            $( 'button, .button, [type=submit], .wp-element-button, .wp-block-search__button, [type=button], [type=reset]' ).css( 'background-color', to );
        } );
    } );

    wp.customize( 'ajaxinwp_button_text_color', function( value ) {
        value.bind( function( to ) {
            $( 'button, .button, [type=submit], .wp-element-button, .wp-block-search__button, [type=button], [type=reset]' ).css( 'color', to );
        } );
    } );

    wp.customize( 'ajaxinwp_button_border_radius', function( value ) {
        value.bind( function( to ) {
            $( 'button, .button, [type=submit], .wp-element-button, .wp-block-search__button, [type=button], [type=reset]' ).css( 'border-radius', to + 'px' );
        } );
    } );

    wp.customize( 'ajaxinwp_border_color', function( value ) {
        value.bind( function( to ) {
            $( '#searchsubmit, .wp-block-search__input, .button, button, input[type="submit"], input[type="button"], input[type="email"], input[type="text"], input[type="url"], textarea' ).css( 'border-color', to );
        } );
    } );

    // Footer Layout.
    wp.customize( 'ajaxinwp_footer_layout', function( value ) {
        value.bind( function( to ) {
            $( '.card-footer' ).removeClass('d-none d-block').addClass(to);
        } );
    } );

    // Icons.
    if ( typeof ajaxinwpIconChoices !== 'undefined' && ajaxinwpIconChoices.icons ) {
        $( 'input[id^="customize-control-ajaxinwp_"][id$="_icon"]' ).each( function() {
            var $input = $( this );
            $input.autocomplete({
                source: ajaxinwpIconChoices.icons,
                minLength: 0,
            }).focus( function() {
                $( this ).autocomplete( 'search', '' );
            });
        });
    }
} )( jQuery );
