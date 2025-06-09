<?php
// ===========================================
// 5. section-contact.php - DÜZELTİLMİŞ (Defaults eklenmeli)
// ===========================================
?>
<section id="contact" class="section">
    <div class="container">
        <h2 class="section-title reveal"><?php echo esc_html(get_theme_mod('contact_title', __('İletişim', 'bga-hukuk-temasi'))); ?></h2>
        <p class="section-subtitle reveal"><?php echo wp_kses_post(get_theme_mod('contact_subtitle', __('Hukuki ihtiyaçlarınız için benimle iletişime geçin', 'bga-hukuk-temasi'))); ?></p>
        <div class="contact-grid">
            <div class="contact-details reveal">
                <div class="contact-item">
                    <h3><?php _e('ADRES', 'bga-hukuk-temasi'); ?></h3>
                    <p><?php echo wp_kses_post(get_theme_mod('contact_address', __('Adres bilgisi buraya gelecek', 'bga-hukuk-temasi'))); ?></p>
                </div>
                <div class="contact-item">
                    <h3><?php _e('E-POSTA', 'bga-hukuk-temasi'); ?></h3>
                    <p><a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'info@example.com')); ?>"><?php echo esc_html(get_theme_mod('contact_email', 'info@example.com')); ?></a></p>
                </div>
                <div class="contact-item">
                    <h3><?php _e('TELEFON', 'bga-hukuk-temasi'); ?></h3>
                    <p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', get_theme_mod('contact_phone', '+90 555 000 00 00'))); ?>"><?php echo esc_html(get_theme_mod('contact_phone', '+90 555 000 00 00')); ?></a></p>
                </div>
                <div class="social-links">
                    <?php $linkedin_url = get_theme_mod('contact_linkedin', ''); if (!empty($linkedin_url)):?>
                    <a href="<?php echo esc_url($linkedin_url); ?>" target="_blank" rel="noopener noreferrer" title="<?php esc_attr_e('LinkedIn', 'bga-hukuk-temasi'); ?>"><?php echo bga_get_icon(get_theme_mod('contact_linkedin_icon', 'linkedin')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="contact-form-wrapper reveal" style="transition-delay: 0.2s;">
                <?php echo do_shortcode(get_theme_mod('contact_form_shortcode', __('[İletişim formu kısa kodu buraya]', 'bga-hukuk-temasi'))); ?>
            </div>
        </div>
    </div>
</section>