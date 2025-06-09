<?php
// ===========================================
// 4. section-credentials.php - DÜZELTİLMİŞ (Defaults eklenmeli)
// ===========================================
?>
<section id="credentials" class="section">
    <div class="container">
        <h2 class="section-title reveal"><?php echo esc_html(get_theme_mod('credentials_title', __('Yetkinlikler ve Sertifikalar', 'bga-hukuk-temasi'))); ?></h2>
        <p class="section-subtitle reveal"><?php echo wp_kses_post(get_theme_mod('credentials_subtitle', __('Profesyonel gelişimimi destekleyen sertifikalar ve yetkinlikler', 'bga-hukuk-temasi'))); ?></p>
        <div class="credentials-grid reveal">
            <?php 
            $main_icon = get_theme_mod('credential_main_icon', 'certificate');
            // Varsayılan sertifikalar tanımla
            $default_credentials = [
                1 => ['title' => __('Avukatlık Lisansı', 'bga-hukuk-temasi'), 'issuer' => __('Türkiye Barolar Birliği', 'bga-hukuk-temasi')],
                2 => ['title' => __('Arabuluculuk Sertifikası', 'bga-hukuk-temasi'), 'issuer' => __('Adalet Bakanlığı', 'bga-hukuk-temasi')],
                3 => ['title' => __('Marka Vekili Sertifikası', 'bga-hukuk-temasi'), 'issuer' => __('Türk Patent ve Marka Kurumu', 'bga-hukuk-temasi')],
                4 => ['title' => __('İş Hukuku Uzmanı', 'bga-hukuk-temasi'), 'issuer' => __('Türkiye Barolar Birliği', 'bga-hukuk-temasi')],
                5 => ['title' => __('Ticaret Hukuku Sertifikası', 'bga-hukuk-temasi'), 'issuer' => __('İstanbul Barosu', 'bga-hukuk-temasi')],
                6 => ['title' => __('Fikri Mülkiyet Hukuku', 'bga-hukuk-temasi'), 'issuer' => __('Ankara Barosu', 'bga-hukuk-temasi')]
            ];
            
            for ($i=1; $i <= 6; $i++):
                $title = get_theme_mod('credential_title_' . $i, $default_credentials[$i]['title'] ?? '');
                $issuer = get_theme_mod('credential_issuer_' . $i, $default_credentials[$i]['issuer'] ?? '');
            ?>
            <?php if (!empty($title)): ?>
                <div class="credential-card">
                    <div class="credential-icon"><?php echo bga_get_icon($main_icon); ?></div>
                    <div class="credential-info">
                        <h3><?php echo esc_html( $title ); ?></h3>
                        <p><?php echo esc_html( $issuer ); ?></p>
                    </div>
                </div>
            <?php endif; endfor; ?>
        </div>
    </div>
</section>
