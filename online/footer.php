<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Billur_Guler_Aslim_Theme
 */
?>
</main><!-- #main-content -->

<footer class="footer-container">
    <div class="footer-main">
        <div class="container">
            <div class="footer-copyright"><p class="footer-copyright-text"><?php echo wp_kses_post( str_replace('[year]', date('Y'), get_theme_mod('footer_copyright', bga_get_default('footer_copyright'))) ); ?></p></div>
            <nav class="footer-nav" aria-label="<?php esc_attr_e('Yasal Bağlantılar', 'billur-guler-aslim'); ?>">
                 <?php
                    // Footer menüsü atanmışsa göster, atanmamışsa yedek menüyü göster
                    if ( has_nav_menu( 'footer_menu' ) ) {
                        wp_nav_menu([
                            'theme_location' => 'footer_menu', 
                            'container' => false, 
                            'menu_class' => 'footer-links-list', 
                            'depth' => 1 // Sadece ilk seviye bağlantılar
                        ]);
                    } else {
                        // YEDEK FOOTER MENÜSÜ - Kullanıcıların bu sayfaları oluşturup menüye atamaları önerilir.
                        $kvkk_page = get_page_by_path('kvkk'); // Varsayılan slug 'kvkk'
                        $privacy_page = get_page_by_path('gizlilik-politikasi'); // Varsayılan slug 'gizlilik-politikasi'
                        $sitemap_page = get_page_by_path('site-haritasi'); // Varsayılan slug 'site-haritasi'
                        $contact_page = get_page_by_path('iletisim'); // Varsayılan slug 'iletisim'

                        echo '<ul class="footer-links-list">';
                        echo '<li><a href="' . ( $kvkk_page ? esc_url(get_permalink($kvkk_page->ID)) : '#' ) . '">' . esc_html__( 'KVKK', 'billur-guler-aslim' ) . '</a></li>';
                        echo '<li><a href="' . ( $privacy_page ? esc_url(get_permalink($privacy_page->ID)) : '#' ) . '">' . esc_html__( 'Gizlilik Politikası', 'billur-guler-aslim' ) . '</a></li>';
                        echo '<li><a href="' . ( $sitemap_page ? esc_url(get_permalink($sitemap_page->ID)) : '#' ) . '">' . esc_html__( 'Site Haritası', 'billur-guler-aslim' ) . '</a></li>';
                        echo '<li><a href="' . ( $contact_page ? esc_url(get_permalink($contact_page->ID)) : '#contact' ) . '">' . esc_html__( 'İletişim', 'billur-guler-aslim' ) . '</a></li>';
                        echo '</ul>';
                    }
                ?>
            </nav>
        </div>
    </div>
</footer>

<?php 
// WhatsApp butonu
$whatsapp_number = get_theme_mod('whatsapp_number', bga_get_default('whatsapp_number'));
if ( !empty($whatsapp_number) ) : 
    $whatsapp_icon = get_theme_mod('footer_whatsapp_icon', 'whatsapp');
    $whatsapp_message = urlencode(__('Merhaba, size nasıl yardımcı olabilirim?', 'billur-guler-aslim')); // Varsayılan WhatsApp mesajı
?>
<a href="https://wa.me/<?php echo esc_attr( preg_replace('/[^0-9]/', '', $whatsapp_number) ); ?>?text=<?php echo $whatsapp_message; ?>" target="_blank" class="whatsapp-button" aria-label="<?php esc_attr_e('WhatsApp ile iletişim', 'billur-guler-aslim'); ?>">
    <?php echo bga_get_icon($whatsapp_icon); ?>
</a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>