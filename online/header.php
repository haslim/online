<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Billur_Guler_Aslim_Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php
        // SEO Meta Etiketleri
        $site_name = get_bloginfo('name');
        $site_description = get_bloginfo('description');
        
        $hero_title = get_theme_mod('hero_title', bga_get_default('hero_title'));
        $hero_tagline_stripped = wp_strip_all_tags(get_theme_mod('hero_tagline', bga_get_default('hero_tagline')));
        
        // OG Image için About bölümündeki görseli kullan, yoksa varsayılanı
        $og_image_url = get_theme_mod('about_image') ? esc_url(get_theme_mod('about_image')) : get_template_directory_uri() . '/assets/images/og-image.webp';
        $og_image_width = 1200; // Varsayılan Open Graph görseli genişliği
        $og_image_height = 630; // Varsayılan Open Graph görseli yüksekliği

        if (get_theme_mod('about_image')) {
            $image_id = attachment_url_to_postid(get_theme_mod('about_image'));
            if ($image_id) {
                $image_meta = wp_get_attachment_metadata($image_id);
                if ($image_meta) {
                    $og_image_width = $image_meta['width'];
                    $og_image_height = $image_meta['height'];
                }
            }
        }
    ?>
    <title><?php wp_title('|', true, 'right'); echo esc_html($hero_title); ?> | <?php _e('Hukuk & Danışmanlık', 'billur-guler-aslim'); ?></title>
    <meta name="description" content="<?php echo esc_attr($hero_tagline_stripped); ?>">
    
    <!-- Canonical URL -->
    <?php 
        if ( is_singular() ) {
            echo '<link rel="canonical" href="' . esc_url( get_permalink() ) . '" />' . "\n";
        } elseif ( is_front_page() && ! is_home() ) {
            echo '<link rel="canonical" href="' . esc_url( home_url( '/' ) ) . '" />' . "\n";
        } elseif ( is_home() && get_option( 'page_for_posts' ) ) {
            echo '<link rel="canonical" href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '" />' . "\n";
        } else {
            // Default for archives, search, etc.
            echo '<link rel="canonical" href="' . esc_url( get_the_permalink() ) . '" />' . "\n";
        }
    ?>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
    <meta property="og:title" content="<?php echo esc_html($hero_title); ?> - <?php echo esc_html($site_name); ?>">
    <meta property="og:description" content="<?php echo esc_attr($hero_tagline_stripped); ?>">
    <meta property="og:image" content="<?php echo $og_image_url; ?>">
    <meta property="og:image:width" content="<?php echo esc_attr($og_image_width); ?>">
    <meta property="og:image:height" content="<?php echo esc_attr($og_image_height); ?>">
    <meta property="og:locale" content="<?php echo esc_attr( get_locale() ); ?>">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
    <meta name="twitter:title" content="<?php echo esc_html($hero_title); ?> - <?php echo esc_html($site_name); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($hero_tagline_stripped); ?>">
    <meta name="twitter:image" content="<?php echo $og_image_url; ?>">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="preloader">
    <?php 
    if ( has_custom_logo() ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
        // Preloader logosu için alt metin ekle
        $logo_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
        if ( empty( $logo_alt ) ) {
            $logo_alt = get_bloginfo( 'name' ) . ' Logo';
        }
        echo '<img src="' . esc_url( $logo_url ) . '" class="logo-img" alt="' . esc_attr($logo_alt) . '">';
    } else {
        // Logo yoksa site adını göster veya bir spinner
        echo '<div class="preloader-spinner"></div>';
    }
    ?>
</div>

<header class="header" id="mainHeader">
    <div class="container nav-container">
        <div class="logo-link">
             <?php 
                if ( has_custom_logo() ) {
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
                    $logo_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
                    if ( empty( $logo_alt ) ) {
                        $logo_alt = get_bloginfo( 'name' ) . ' Logo';
                    }
                    echo '<a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr($logo_alt) . '" class="custom-logo" width="280" height="80"></a>'; // Add width/height for performance
                } else {
                    // Logo atanmamışsa site adını metin olarak göster
                    echo '<span class="site-logo"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></span>';
                }
            ?>
        </div>
        <nav aria-label="<?php esc_attr_e( 'Ana Gezinti', 'billur-guler-aslim' ); ?>">
            <?php
            // Menü atanmışsa göster, atanmamışsa yedek menüyü göster
            if ( has_nav_menu( 'primary_menu' ) ) {
                wp_nav_menu([
                    'theme_location'  => 'primary_menu',
                    'container'       => false,
                    'menu_class'      => 'nav-menu',
                    'menu_id'         => 'navMenu',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ]);
            } else {
                // YEDEK MENÜ (Kullanıcı henüz menü atamadıysa bu görünür)
                $posts_page_id = get_option('page_for_posts');
                $posts_page_url = get_permalink($posts_page_id);

                echo '<ul id="navMenu" class="nav-menu">';
                echo '<li><a href="#about" class="nav-link">' . __('Hakkımda', 'billur-guler-aslim') . '</a></li>';
                echo '<li><a href="#services" class="nav-link">' . __('Uzmanlık Alanları', 'billur-guler-aslim') . '</a></li>';
                echo '<li><a href="#credentials" class="nav-link">' . __('Yetkinlikler', 'billur-guler-aslim') . '</a></li>';
                // Makaleler linki
                if ($posts_page_id && $posts_page_url) {
                    echo '<li><a href="' . esc_url($posts_page_url) . '" class="nav-link">' . __('Makaleler', 'billur-guler-aslim') . '</a></li>';
                }
                echo '<li><a href="#contact" class="nav-link">' . __('İletişim', 'billur-guler-aslim') . '</a></li>';
                echo '</ul>';
            }
            ?>
        </nav>
        
        <?php 
        // Polylang Dil Seçici
        if (function_exists('pll_the_languages')) {
            echo '<div class="language-switcher">';
            pll_the_languages(array('dropdown' => 0, 'show_flags' => 1, 'show_names' => 1));
            echo '</div>';
        }
        ?>

        <button class="mobile-toggle" id="mobileToggle" aria-label="<?php esc_attr_e('Menüyü aç/kapat', 'billur-guler-aslim'); ?>" aria-controls="navMenu" aria-expanded="false">
            <span class="bar top"></span>
            <span class="bar middle"></span>
            <span class="bar bottom"></span>
        </button>
    </div>
</header>