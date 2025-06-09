<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Bu dosya, temanın varsayılan metinlerini içerir.
require_once get_template_directory() . '/inc/defaults.php';

function bga_customize_register( $wp_customize ) {

    // Ana Panel
    $wp_customize->add_panel( 'bga_main_panel', [ 
        'priority' => 10, 
        'title' => __('Tema Ayarları', 'billur-guler-aslim')
    ]);
    
    // İkon Listesi (Feather Icons karşılıkları)
    $icons = [
        'law-book' => __('Hukuk Kitabı (Law Book)', 'billur-guler-aslim'), 
        'court' => __('Mahkeme (Court)', 'billur-guler-aslim'), 
        'judge' => __('Yargıç (Judge)', 'billur-guler-aslim'), 
        'certificate' => __('Sertifika (Certificate)', 'billur-guler-aslim'), 
        'plus' => __('Artı (+) (Plus)', 'billur-guler-aslim'), 
        'linkedin' => __('LinkedIn (LinkedIn)', 'billur-guler-aslim'), 
        'whatsapp' => __('WhatsApp (WhatsApp)', 'billur-guler-aslim'),
        'map-pin' => __('Harita İğnesi (Map Pin)', 'billur-guler-aslim'),
        'mail' => __('E-posta (Mail)', 'billur-guler-aslim'),
        'phone' => __('Telefon (Phone)', 'billur-guler-aslim'),
    ];

    // --- BÖLÜM 1: HERO ---
    $wp_customize->add_section( 'bga_hero_section', [ 
        'title' => __('1. Hero', 'billur-guler-aslim'), 
        'panel' => 'bga_main_panel' 
    ] );
    $wp_customize->add_setting( 'hero_title', [
        'default' => bga_get_default('hero_title'), 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'hero_title', [
        'label' => __('Ana Başlık', 'billur-guler-aslim'), 
        'section' => 'bga_hero_section'
    ] );
    $wp_customize->add_setting( 'hero_tagline', [
        'default' => bga_get_default('hero_tagline'), 
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'hero_tagline', [
        'label' => __('Alt Başlık', 'billur-guler-aslim'), 
        'section' => 'bga_hero_section', 
        'type' => 'textarea'
    ] );

    // --- BÖLÜM 2: HAKKIMDA ---
    $wp_customize->add_section( 'bga_about_section', [ 
        'title' => __('2. Hakkımda', 'billur-guler-aslim'), 
        'panel' => 'bga_main_panel' 
    ] );
    $wp_customize->add_setting( 'about_image', [
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'about_image', [
        'label' => __('Fotoğraf', 'billur-guler-aslim'), 
        'section' => 'bga_about_section'
    ] ) );
    $wp_customize->add_setting( 'about_subheading_1', [
        'default' => bga_get_default('about_subheading_1'), 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'about_subheading_1', [
        'label' => __('Alt Başlık 1', 'billur-guler-aslim'), 
        'section' => 'bga_about_section'
    ] );
    $wp_customize->add_setting( 'about_text_1', [
        'default' => bga_get_default('about_text_1'), 
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'about_text_1', [
        'label' => __('Paragraf 1', 'billur-guler-aslim'), 
        'section' => 'bga_about_section', 
        'type' => 'textarea'
    ] );
    $wp_customize->add_setting( 'about_subheading_2', [
        'default' => bga_get_default('about_subheading_2'), 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'about_subheading_2', [
        'label' => __('Alt Başlık 2', 'billur-guler-aslim'), 
        'section' => 'bga_about_section'
    ] );
    $wp_customize->add_setting( 'about_text_2', [
        'default' => bga_get_default('about_text_2'), 
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'about_text_2', [
        'label' => __('Paragraf 2', 'billur-guler-aslim'), 
        'section' => 'bga_about_section', 
        'type' => 'textarea'
    ] );
    
    // --- BÖLÜM 3: UZMANLIK ALANLARI ---
    $wp_customize->add_section( 'bga_services_section', [ 
        'title' => __('3. Uzmanlık Alanları', 'billur-guler-aslim'), 
        'panel' => 'bga_main_panel' 
    ] );
    $wp_customize->add_setting( 'services_title', [
        'default' => bga_get_default('services_title'), 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'services_title', [
        'label' => __('Bölüm Başlığı', 'billur-guler-aslim'), 
        'section' => 'bga_services_section'
    ] );
    $wp_customize->add_setting( 'services_subtitle', [
        'default' => bga_get_default('services_subtitle'), 
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'services_subtitle', [
        'label' => __('Bölüm Alt Başlığı', 'billur-guler-aslim'), 
        'section' => 'bga_services_section', 
        'type' => 'textarea'
    ] );
    for ($i=1; $i <= 3; $i++) {
        $wp_customize->add_setting( 'service_title_' . $i, [
            'default' => bga_get_default('service_title_' . $i), 
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage' // EKLEDİK!
        ] );
        $wp_customize->add_control( 'service_title_' . $i, [
            'label' => sprintf(__('%d. Hizmet Başlığı', 'billur-guler-aslim'), $i), 
            'section' => 'bga_services_section'
        ] );
        $wp_customize->add_setting( 'service_content_' . $i, [
            'default' => bga_get_default('service_content_' . $i), 
            'sanitize_callback' => 'wp_kses_post',
            'transport' => 'postMessage' // EKLEDİK!
        ] );
        $wp_customize->add_control( 'service_content_' . $i, [
            'label' => sprintf(__('%d. Hizmet İçeriği', 'billur-guler-aslim'), $i), 
            'section' => 'bga_services_section', 
            'type' => 'textarea'
        ] );
        $wp_customize->add_setting( 'service_icon_' . $i, [
            'default' => bga_get_default('service_icon_' . $i), 
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh' // İkonlar için genelde refresh daha güvenlidir.
        ] );
        $wp_customize->add_control( 'service_icon_' . $i, [
            'label' => sprintf(__('%d. Hizmet İkonu', 'billur-guler-aslim'), $i), 
            'section' => 'bga_services_section', 
            'type' => 'select', 
            'choices' => $icons
        ] );
    }
    $wp_customize->add_setting( 'accordion_toggle_icon', [
        'default' => 'plus', 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh' // İkonlar için refresh
    ]);
    $wp_customize->add_control( 'accordion_toggle_icon', [
        'label' => __('Akordiyon İkonu', 'billur-guler-aslim'), 
        'section' => 'bga_services_section', 
        'type' => 'select', 
        'choices' => $icons
    ]);

    // --- BÖLÜM 4: YETKİNLİKLER ---
    $wp_customize->add_section( 'bga_credentials_section', [ 
        'title' => __('4. Yetkinlikler', 'billur-guler-aslim'), 
        'panel' => 'bga_main_panel' 
    ] );
    $wp_customize->add_setting( 'credentials_title', [
        'default' => bga_get_default('credentials_title'), 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'credentials_title', [
        'label' => __('Bölüm Başlığı', 'billur-guler-aslim'), 
        'section' => 'bga_credentials_section'
    ] );
    $wp_customize->add_setting( 'credentials_subtitle', [
        'default' => bga_get_default('credentials_subtitle'), 
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'credentials_subtitle', [
        'label' => __('Bölüm Alt Başlığı', 'billur-guler-aslim'), 
        'section' => 'bga_credentials_section', 
        'type' => 'textarea'
    ] );
    $wp_customize->add_setting( 'credential_main_icon', [
        'default' => bga_get_default('credential_main_icon'), 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh' // İkonlar için refresh
    ] );
    $wp_customize->add_control( 'credential_main_icon', [
        'label' => __('Tüm Yetkinlikler İçin İkon', 'billur-guler-aslim'), 
        'section' => 'bga_credentials_section', 
        'type' => 'select', 
        'choices' => $icons
    ]);
    for ($i=1; $i <= 6; $i++) {
        $wp_customize->add_setting( 'credential_title_' . $i, [
            'default' => bga_get_default('credential_title_' . $i), 
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage' // EKLEDİK!
        ] );
        $wp_customize->add_control( 'credential_title_' . $i, [
            'label' => sprintf(__('%d. Yetkinlik Başlığı', 'billur-guler-aslim'), $i), 
            'section' => 'bga_credentials_section'
        ] );
        $wp_customize->add_setting( 'credential_issuer_' . $i, [
            'default' => bga_get_default('credential_issuer_' . $i), 
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage' // EKLEDİK!
        ] );
        $wp_customize->add_control( 'credential_issuer_' . $i, [
            'label' => sprintf(__('%d. Veren Kurum', 'billur-guler-aslim'), $i), 
            'section' => 'bga_credentials_section'
        ] );
    }

    // --- BÖLÜM 5: İLETİŞİM ---
    $wp_customize->add_section( 'bga_contact_section', [ 
        'title' => __('5. İletişim', 'billur-guler-aslim'), 
        'panel' => 'bga_main_panel' 
    ] );
    $wp_customize->add_setting( 'contact_title', [
        'default' => bga_get_default('contact_title'), 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'contact_title', [
        'label' => __('Bölüm Başlığı', 'billur-guler-aslim'), 
        'section' => 'bga_contact_section'
    ] );
    $wp_customize->add_setting( 'contact_subtitle', [
        'default' => bga_get_default('contact_subtitle'), 
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'contact_subtitle', [
        'label' => __('Bölüm Alt Başlığı', 'billur-guler-aslim'), 
        'section' => 'bga_contact_section', 
        'type' => 'textarea'
    ] );
    $wp_customize->add_setting( 'contact_address', [
        'default' => bga_get_default('contact_address'), 
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'contact_address', [
        'label' => __('Adres', 'billur-guler-aslim'), 
        'section' => 'bga_contact_section', 
        'type' => 'textarea'
    ] );
    $wp_customize->add_setting( 'contact_address_icon', [
        'default' => 'map-pin', 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh' // İkonlar için refresh
    ] );
    $wp_customize->add_control( 'contact_address_icon', [
        'label' => __('Adres İkonu', 'billur-guler-aslim'), 
        'section' => 'bga_contact_section', 
        'type' => 'select', 
        'choices' => $icons
    ]);
    $wp_customize->add_setting( 'contact_email', [
        'default' => bga_get_default('contact_email'), 
        'sanitize_callback' => 'sanitize_email',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'contact_email', [
        'label' => __('E-posta', 'billur-guler-aslim'), 
        'section' => 'bga_contact_section',
        'type' => 'email'
    ] );
    $wp_customize->add_setting( 'contact_email_icon', [
        'default' => 'mail', 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh' // İkonlar için refresh
    ] );
    $wp_customize->add_control( 'contact_email_icon', [
        'label' => __('E-posta İkonu', 'billur-guler-aslim'), 
        'section' => 'bga_contact_section', 
        'type' => 'select', 
        'choices' => $icons
    ]);
    $wp_customize->add_setting( 'contact_phone', [
        'default' => bga_get_default('contact_phone'), 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'contact_phone', [
        'label' => __('Telefon', 'billur-guler-aslim'), 
        'section' => 'bga_contact_section',
        'type' => 'tel'
    ] );
    $wp_customize->add_setting( 'contact_phone_icon', [
        'default' => 'phone', 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh' // İkonlar için refresh
    ] );
    $wp_customize->add_control( 'contact_phone_icon', [
        'label' => __('Telefon İkonu', 'billur-guler-aslim'), 
        'section' => 'bga_contact_section', 
        'type' => 'select', 
        'choices' => $icons
    ]);
    $wp_customize->add_setting( 'contact_linkedin', [
        'default' => bga_get_default('contact_linkedin'), 
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'contact_linkedin', [
        'label' => __('LinkedIn URL', 'billur-guler-aslim'), 
        'section' => 'bga_contact_section',
        'type' => 'url'
    ] );
    $wp_customize->add_setting( 'contact_linkedin_icon', [
        'default' => 'linkedin', 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh' // İkonlar için refresh
    ] );
    $wp_customize->add_control( 'contact_linkedin_icon', [
        'label' => __('LinkedIn İkonu', 'billur-guler-aslim'), 
        'section' => 'bga_contact_section', 
        'type' => 'select', 
        'choices' => $icons
    ]);
    // Not: Shortcode çıktısı genellikle postMessage ile güncellenmez, refresh gerektirir.
    $wp_customize->add_setting( 'contact_form_shortcode', [
        'default' => bga_get_default('contact_form_shortcode'), 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh' 
    ] );
    $wp_customize->add_control( 'contact_form_shortcode', [
        'label' => __('İletişim Formu Shortcode', 'billur-guler-aslim'), 
        'section' => 'bga_contact_section'
    ] );
    
    // --- BÖLÜM 6: FOOTER ---
    $wp_customize->add_section( 'bga_footer_section', [ 
        'title' => __('6. Footer', 'billur-guler-aslim'), 
        'panel' => 'bga_main_panel' 
    ] );
    $wp_customize->add_setting( 'footer_copyright', [
        'default' => bga_get_default('footer_copyright'), 
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'footer_copyright', [
        'label' => __('Copyright Metni', 'billur-guler-aslim'), 
        'section' => 'bga_footer_section',
        'type' => 'textarea'
    ] );
    $wp_customize->add_setting( 'whatsapp_number', [
        'default' => bga_get_default('whatsapp_number'), 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage' // EKLEDİK!
    ] );
    $wp_customize->add_control( 'whatsapp_number', [
        'label' => __('WhatsApp Numarası', 'billur-guler-aslim'), 
        'section' => 'bga_footer_section'
    ] );
    $wp_customize->add_setting( 'footer_whatsapp_icon', [
        'default' => 'whatsapp', 
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh' // İkonlar için refresh
    ] );
    $wp_customize->add_control( 'footer_whatsapp_icon', [
        'label' => __('WhatsApp İkonu', 'billur-guler-aslim'), 
        'section' => 'bga_footer_section', 
        'type' => 'select', 
        'choices' => $icons
    ]);

    // --- BÖLÜM 7: GDPR / KVKK ---
    $wp_customize->add_section( 'bga_gdpr_section', [
        'title' => __('7. GDPR / KVKK Uyarısı', 'billur-guler-aslim'),
        'panel' => 'bga_main_panel',
        'description' => __('Bu ayarlar basit bir GDPR/Çerez uyarı çubuğu içindir. Daha kapsamlı çözümler için bir eklenti önerilir.', 'billur-guler-aslim'),
    ]);
    $wp_customize->add_setting( 'gdpr_notice_text', [
        'default'           => bga_get_default('gdpr_notice_text'),
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage' // EKLEDİK!
    ]);
    $wp_customize->add_control( 'gdpr_notice_text', [
        'label'             => __('Uyarı Metni (HTML destekli)', 'billur-guler-aslim'),
        'section'           => 'bga_gdpr_section',
        'type'              => 'textarea',
    ]);
    $wp_customize->add_setting( 'gdpr_button_text', [
        'default'           => bga_get_default('gdpr_button_text'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage' // EKLEDİK!
    ]);
    $wp_customize->add_control( 'gdpr_button_text', [
        'label'             => __('Kabul Butonu Metni', 'billur-guler-aslim'),
        'section'           => 'bga_gdpr_section',
        'type'              => 'text',
    ]);
}
add_action( 'customize_register', 'bga_customize_register' );