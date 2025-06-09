<?php
/**
 * Functions and definitions for Billur Güler Aslım Hukuk Teması.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Billur_Guler_Aslim_Theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Customizer ve varsayılan değerleri çağır
require get_template_directory() . '/inc/defaults.php';
require get_template_directory() . '/inc/customizer.php';

/**
 * Temanın kurulumunu ve temel özelliklerini tanımlar.
 */
function bga_theme_setup() {
    // Çeviri dosyalarını yükle
    load_theme_textdomain( 'billur-guler-aslim', get_template_directory() . '/languages' );
    
    // Dinamik <title> etiketi desteği
    add_theme_support( 'title-tag' );
    
    // Özel logo desteği
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ]);
    
    // Menüleri kaydet
    register_nav_menus( [
        'primary_menu' => esc_html__( 'Ana Menü', 'billur-guler-aslim' ),
        'footer_menu'  => esc_html__( 'Footer Menüsü', 'billur-guler-aslim' ),
    ]);
    
    // HTML5 işaretleme desteği
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ]);

    // Post thumbnail desteği
    add_theme_support( 'post-thumbnails' );
    
    // Gönderi formatları (isteğe bağlı, gerekliyse eklenebilir)
    // add_theme_support( 'post-formats', array( 'aside', 'gallery', 'quote', 'video', 'audio' ) );
}
add_action( 'after_setup_theme', 'bga_theme_setup' );

/**
 * Tema scriptlerini ve stillerini yükler.
 */
function bga_theme_scripts() {
    $theme_version = '1.1.0'; // Temanın versiyonunu style.css'ten almalı

    // Ana stil dosyası
    wp_enqueue_style( 'bga-main-style', get_stylesheet_uri(), [], $theme_version );
    
    // Main JS dosyası
    wp_enqueue_script( 'bga-main-script', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], $theme_version, true );

    // Customizer Preview için ayrı JS dosyası
    if ( is_customize_preview() ) {
        wp_enqueue_script( 'bga-customizer-preview', get_template_directory_uri() . '/assets/js/customizer-preview.js', ['jquery', 'customize-preview'], $theme_version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'bga_theme_scripts' );

/**
 * SVG ikonları için fonksiyon.
 * Feather ikonlar burada inline SVG olarak çekilir.
 *
 * @param string $icon_name İkonun adı (Feather Icons adıyla eşleşmeli).
 * @return string SVG kodu veya boş string.
 */
function bga_get_icon( $icon_name ) {
    if ( empty( $icon_name ) ) {
        return '';
    }

    $icon_file = get_template_directory() . '/assets/icons/' . sanitize_file_name($icon_name) . '.svg';

    if ( file_exists( $icon_file ) ) {
        // SVG dosyasını doğrudan oku ve döndür
        return file_get_contents( $icon_file );
    }
    
    // Eğer ikon bulunamazsa debug modu açıksa hata mesajı döndür
    if ( WP_DEBUG ) {
        error_log("SVG icon not found: " . $icon_name);
    }
    return ''; // İkon bulunamazsa boş döndür
}

/**
 * GDPR Uyarısı Ekleme (Basit bir örnek)
 * Eğer profesyonel bir GDPR çözümü gerekiyorsa, bir eklenti tercih edilmelidir.
 */
function bga_add_gdpr_notice() {
    // Gizlilik Politikası sayfası bağlantısını dinamik olarak al
    $privacy_policy_page_id = get_option( 'wp_page_for_privacy_policy' );
    $privacy_policy_url = '#'; // Varsayılan boş URL

    if ( $privacy_policy_page_id ) {
        $privacy_policy_url = get_permalink( $privacy_policy_page_id );
        // Eğer Polylang aktifse, gizlilik politikası sayfasının mevcut dildeki çevirisini al.
        if ( function_exists( 'pll_get_post' ) ) {
            $translated_privacy_policy_id = pll_get_post( $privacy_policy_page_id );
            if ( $translated_privacy_policy_id ) {
                $privacy_policy_url = get_permalink( $translated_privacy_policy_id );
            }
        }
    }
    
    $gdpr_text_raw = get_theme_mod('gdpr_notice_text', bga_get_default('gdpr_notice_text'));
    // GDPR metnini gizlilik politikası URL'si ile formatla
    $gdpr_text = sprintf($gdpr_text_raw, esc_url($privacy_policy_url));
    $gdpr_button_text = get_theme_mod('gdpr_button_text', bga_get_default('gdpr_button_text'));

    if (empty($gdpr_text) || empty($gdpr_button_text)) {
        return; // GDPR metni veya butonu yoksa gösterme
    }

    // Kullanıcı zaten kabul etmiş mi kontrol et
    if (isset($_COOKIE['bga_gdpr_accepted']) && $_COOKIE['bga_gdpr_accepted'] === 'true') {
        return;
    }

    echo '<div id="bga-gdpr-notice" class="bga-gdpr-notice">';
    echo '<p>' . wp_kses_post($gdpr_text) . '</p>';
    echo '<button id="bga-gdpr-accept-button" class="bga-gdpr-accept-button">' . esc_html($gdpr_button_text) . '</button>';
    echo '</div>';
    
    // GDPR Notice JS (main.js içinde artık)
}
add_action('wp_body_open', 'bga_add_gdpr_notice');

/**
 * Çeviri fonksiyonları için yardımcı fonksiyon.
 * Polylang veya Loco Translate gibi eklentilerle uyumluluk sağlar.
 *
 * @param string $option_key Tema seçeneği anahtarı.
 * @param string $default Varsayılan değer.
 * @return string Çevrilmiş veya varsayılan değer.
 */
function bga_get_theme_option($option_key, $default = '') {
    $value = get_theme_mod($option_key, $default);
    
    // Eğer Polylang aktifse çevir
    if (function_exists('pll__')) {
        return pll__($value);
    }
    
    return $value;
}

/**
 * Tema seçenekleri için çeviri kaydetme.
 * Polylang kullanılıyorsa, Customizer alanlarındaki metinleri Polylang'e kaydeder.
 */
function bga_register_strings_for_translation() {
    if (function_exists('pll_register_string')) {
        $defaults = bga_get_default(''); 

        // bga_get_default fonksiyonundaki her bir varsayılan değeri tek tek kaydedin
        foreach ($defaults as $key => $value) {
            // Eğer değer bir placeholder URL içeriyorsa (örn. %s), çevirilebilir dize olarak kaydetmeyin
            // veya URL kısmını çıkararak kaydedin
            if (strpos($value, '%s') !== false) {
                // Örneğin, GDPR metni için sadece statik kısmını kaydet
                // Not: %s olan stringler için pll_register_string direkt çalışmayabilir.
                // Bu durumda stringi kendiniz parçalayıp kaydetmeniz gerekebilir.
                // Basitlik adına, şimdilik %s'i içeren stringleri kaydetmiyoruz,
                // çünkü sprintf ile dinamikleştirilmişler.
                continue; 
            }
            pll_register_string($key, $value, 'Billur Güler Aslım Teması', true);
        }
        // Ek olarak, GDPR buton metnini de kaydedelim
        pll_register_string('gdpr_button_text', bga_get_default('gdpr_button_text'), 'Billur Güler Aslım Teması', true);

        // Ek olarak, makaleler bölüm başlığını da kaydedelim (index.php'den alınır)
        pll_register_string('Son Makaleler', __('Son Makaleler', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Hukuki gelişmeleri takip edin, güncel bilgiler edinin.', __('Hukuki gelişmeleri takip edin, güncel bilgiler edinin.', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Tüm Makaleleri Görüntüle', __('Tüm Makaleleri Görüntüle', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Makaleler', __('Makaleler', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true); // Menü ve sayfa başlığı için
        pll_register_string('Published on', __('Published on', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('by', __('by', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('in', __('in', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Tags:', __('Tags:', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Previous:', __('Previous:', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Next:', __('Next:', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Read More', __('Read More', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Nothing Found', __('Nothing Found', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Sorry, but nothing matched your search terms. Please try again with some different keywords.', __('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', __('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Page', __('Page', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Pages:', __('Pages:', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Post navigation', __('Post navigation', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Categories:', __('Categories:', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);

        // Footer yasal bağlantı yedek metinleri
        pll_register_string('KVKK', __('KVKK', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Gizlilik Politikası', __('Gizlilik Politikası', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('Site Haritası', __('Site Haritası', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true);
        pll_register_string('İletişim', __('İletişim', 'billur-guler-aslim'), 'Billur Güler Aslım Teması', true); // Footer için de tanımlayalım
    }
}
add_action('init', 'bga_register_strings_for_translation');

/**
 * Ana menüdeki tek sayfa (anchor) bağlantılarını, ana sayfa dışındaki sayfalarda tam URL'lere dönüştürür.
 *
 * @param array $menu_items WP_Post (nav_menu_item) nesnelerinin dizisi.
 * @param object $args wp_nav_menu()'ye iletilen bağımsız değişkenler.
 * @return array Değiştirilmiş menü öğesi dizisi.
 */
function bga_adjust_nav_menu_item_urls( $menu_items, $args ) {
    // Sadece 'primary_menu' konumundaki menüyü ve ana sayfa dışındaki durumları hedefle.
    if ( $args->theme_location == 'primary_menu' && ! is_front_page() ) {
        foreach ( $menu_items as $menu_item ) {
            // Eğer bağlantı bir anchor (# ile başlıyor ve sadece # değilse)
            if ( str_starts_with( $menu_item->url, '#' ) && $menu_item->url !== '#' ) {
                // Ana sayfanın URL'sini ve anchor'ı birleştir
                $menu_item->url = home_url( '/' ) . $menu_item->url;
            }
        }
    }
    return $menu_items;
}
add_filter( 'wp_nav_menu_objects', 'bga_adjust_nav_menu_item_urls', 10, 2 );


/**
 * Yıl dinamikleştirme fonksiyonu.
 * Footer'da [year] kısa kodunu mevcut yılla değiştirir.
 */
function bga_dynamic_year_shortcode($atts, $content = '') {
    return date('Y');
}
add_shortcode('year', 'bga_dynamic_year_shortcode');


/**
 * Tema için Structured Data (JSON-LD) ekler.
 * Ana sayfa ve genel site bilgileri için.
 */
function bga_add_structured_data() {
    if ( is_front_page() || is_home() ) {
        $logo_id = get_theme_mod('custom_logo');
        $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'full') : get_template_directory_uri() . '/assets/images/og-image.webp';
        
        $phone_number = preg_replace('/[^0-9]/', '', get_theme_mod('contact_phone', bga_get_default('contact_phone')));
        $email_address = get_theme_mod('contact_email', bga_get_default('contact_email'));
        $address = wp_strip_all_tags(str_replace('<br>', ', ', get_theme_mod('contact_address', bga_get_default('contact_address'))));
        $site_name = get_bloginfo('name');
        $site_url = home_url('/');

        $json_ld = [
            "@context" => "https://schema.org",
            "@graph" => [
                [
                    "@type" => "Organization",
                    "@id" => $site_url . "#organization",
                    "name" => $site_name,
                    "url" => $site_url,
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => $logo_url,
                        "width" => 280, 
                        "height" => 80
                    ],
                    "contactPoint" => [
                        "@type" => "ContactPoint",
                        "telephone" => $phone_number,
                        "contactType" => "customer service",
                        "email" => $email_address
                    ],
                    "sameAs" => [
                        get_theme_mod('contact_linkedin', bga_get_default('contact_linkedin'))
                    ]
                ],
                [
                    "@type" => "WebSite",
                    "@id" => $site_url . "#website",
                    "url" => $site_url,
                    "name" => $site_name,
                    "publisher" => [ "@id" => $site_url . "#organization" ],
                    "inLanguage" => get_bloginfo('language')
                ]
            ]
        ];

        // Yerel İşletme (LocalBusiness) veya Hukuk Hizmeti (LegalService) ekleme
        $json_ld['@graph'][] = [
            "@type" => "LegalService", 
            "name" => $site_name,
            "url" => $site_url,
            "image" => $logo_url,
            "priceRange" => "TL", 
            "telephone" => $phone_number,
            "email" => $email_address,
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => str_replace(', Türkiye', '', $address), 
                "addressLocality" => 'Antalya', 
                "addressRegion" => 'Antalya', 
                "addressCountry" => 'TR' 
            ],
            "openingHoursSpecification" => [
                [
                    "@type" => "OpeningHoursSpecification",
                    "dayOfWeek" => [ "Monday", "Tuesday", "Wednesday", "Thursday", "Friday" ],
                    "opens" => "09:00",
                    "closes" => "18:00"
                ]
            ]
        ];

        // Eğer kişi (Person) bilgisi eklenecekse (Avukat Billur Güler Aslım için)
        $about_image_url = get_theme_mod('about_image', get_template_directory_uri() . '/assets/images/placeholder-about.webp');
        $person_name = wp_strip_all_tags(get_theme_mod('hero_title', bga_get_default('hero_title')));

        $json_ld['@graph'][] = [
            "@type" => "Person",
            "name" => $person_name,
            "url" => $site_url,
            "image" => $about_image_url,
            "jobTitle" => __("Avukat & Arabulucu", 'billur-guler-aslim'),
            // "alumniOf" => "..." // Mezun olunan üniversite eklenebilir
        ];
        
        echo '<script type="application/ld+json">' . json_encode( $json_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'bga_add_structured_data' );

/**
 * Sayfalama için özel fonksiyon.
 */
function bga_posts_pagination() {
    the_posts_pagination(array(
        'prev_text'          => __('« Previous', 'billur-guler-aslim'),
        'next_text'          => __('Next »', 'billur-guler-aslim'),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'billur-guler-aslim') . ' </span>',
    ));
}