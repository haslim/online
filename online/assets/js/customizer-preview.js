( function( $ ) {

    // Site Title & Tagline
    wp.customize( 'blogname', function( value ) {
        value.bind( function( to ) {
            $( '.site-logo a' ).text( to ); 
        } );
    } );
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            // If you have a specific element for tagline, target it. 
            // Otherwise, this is handled by selective refresh.
            // No direct element for tagline in this theme's header text output currently.
        } );
    } );

    // Hero Title
    wp.customize( 'hero_title', function( value ) {
        value.bind( function( to ) {
            $( '#hero .hero-title' ).html( to ); // Use .html() to allow possible HTML tags
        } );
    } );

    // Hero Tagline
    wp.customize( 'hero_tagline', function( value ) {
        value.bind( function( to ) {
            $( '#hero .hero-tagline' ).html( to ); // Use .html() to allow <br> tag
        } );
    } );
    
    // About Section
    wp.customize( 'about_subheading_1', function( value ) {
        value.bind( function( to ) {
            $( '#about .about-text > div:first-child .sub-heading' ).text( to );
        } );
    } );
    wp.customize( 'about_text_1', function( value ) {
        value.bind( function( to ) {
            $( '#about .about-text > div:first-child p' ).html( to );
        } );
    } );
    wp.customize( 'about_subheading_2', function( value ) {
        value.bind( function( to ) {
            $( '#about .about-text > div:last-child .sub-heading' ).text( to );
        } );
    } );
    wp.customize( 'about_text_2', function( value ) {
        value.bind( function( to ) {
            $( '#about .about-text > div:last-child p' ).html( to );
        } );
    } );
    wp.customize( 'about_image', function( value ) {
        value.bind( function( to ) {
            $( '#about .about-image' ).attr( 'src', to );
        } );
    } );

    // Services Section
    wp.customize( 'services_title', function( value ) {
        value.bind( function( to ) {
            $( '#services .section-title' ).text( to );
        } );
    } );
    wp.customize( 'services_subtitle', function( value ) {
        value.bind( function( to ) {
            $( '#services .section-subtitle' ).html( to );
        } );
    } );
    for (let i = 1; i <= 3; i++) {
        wp.customize( 'service_title_' + i, function( value ) {
            value.bind( function( to ) {
                $( `.accordion-item:nth-child(${i}) .accordion-title` ).text( to );
            } );
        } );
        wp.customize( 'service_content_' + i, function( value ) {
            value.bind( function( to ) {
                $( `.accordion-item:nth-child(${i}) .accordion-content p` ).html( to );
            } );
        } );
        // Note: Icon changes require custom JS for SVG replacement,
        // or a full refresh. Selective refresh on the parent element
        // is typically the way to go for complex HTML like SVG icons.
        // For simplicity, we'll rely on full refresh or direct element replacement by WordPress.
    }

    // Credentials Section
    wp.customize( 'credentials_title', function( value ) {
        value.bind( function( to ) {
            $( '#credentials .section-title' ).text( to );
        } );
    } );
    wp.customize( 'credentials_subtitle', function( value ) {
        value.bind( function( to ) {
            $( '#credentials .section-subtitle' ).html( to );
        } );
    } );
    for (let i = 1; i <= 6; i++) {
        wp.customize( 'credential_title_' + i, function( value ) {
            value.bind( function( to ) {
                $( `.credential-card:nth-child(${i}) .credential-info h3` ).text( to );
            } );
        } );
        wp.customize( 'credential_issuer_' + i, function( value ) {
            value.bind( function( to ) {
                $( `.credential-card:nth-child(${i}) .credential-info p` ).text( to );
            } );
        } );
    }

    // Contact Section
    wp.customize( 'contact_title', function( value ) {
        value.bind( function( to ) {
            $( '#contact .section-title' ).text( to );
        } );
    } );
    wp.customize( 'contact_subtitle', function( value ) {
        value.bind( function( to ) {
            $( '#contact .section-subtitle' ).html( to );
        } );
    } );
    wp.customize( 'contact_address', function( value ) {
        value.bind( function( to ) {
            $( '#contact .contact-item:nth-child(1) p' ).html( to );
        } );
    } );
    wp.customize( 'contact_email', function( value ) {
        value.bind( function( to ) {
            const emailLink = $( '#contact .contact-item:nth-child(2) a' );
            emailLink.attr( 'href', 'mailto:' + to );
            emailLink.text( to );
        } );
    } );
    wp.customize( 'contact_phone', function( value ) {
        value.bind( function( to ) {
            const phoneLink = $( '#contact .contact-item:nth-child(3) a' );
            phoneLink.attr( 'href', 'tel:' + to.replace(/[^0-9+]/g, '') );
            phoneLink.text( to );
        } );
    } );
    wp.customize( 'contact_linkedin', function( value ) {
        value.bind( function( to ) {
            const linkedinLink = $( '.social-links a[title="LinkedIn"]' );
            if (to) {
                if (linkedinLink.length === 0) { // If link doesn't exist, create it (requires more complex DOM manipulation, usually selective refresh is better)
                    // This scenario is best handled by selective refresh
                } else {
                    linkedinLink.attr( 'href', to );
                    linkedinLink.show();
                }
            } else {
                linkedinLink.hide();
            }
        } );
    } );

    // Footer Copyright
    wp.customize( 'footer_copyright', function( value ) {
        value.bind( function( to ) {
            // Replace [year] placeholder in copyright text
            const year = new Date().getFullYear();
            const processedTo = to.replace('[year]', year);
            $( '.footer-copyright-text' ).html( processedTo );
        } );
    } );

    // WhatsApp Button
    wp.customize( 'whatsapp_number', function( value ) {
        value.bind( function( to ) {
            const whatsappButton = $( '.whatsapp-button' );
            if (to) {
                whatsappButton.attr('href', 'https://wa.me/' + to.replace(/[^0-9]/g, '') + '?text=Merhaba,%20size%20nas%C4%B1l%20yard%C4%B1mc%C4%B1%20olabilirim%3F');
                whatsappButton.show();
            } else {
                whatsappButton.hide();
            }
        } );
    } );

    // GDPR Notice Text
    wp.customize( 'gdpr_notice_text', function( value ) {
        value.bind( function( to ) {
            $( '#bga-gdpr-notice p' ).html( to );
        } );
    } );

    // GDPR Button Text
    wp.customize( 'gdpr_button_text', function( value ) {
        value.bind( function( to ) {
            $( '#bga-gdpr-accept-button' ).text( to );
        } );
    } );


} )( jQuery );