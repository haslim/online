
<?php
// ===========================================
// 3. section-services.php - DÜZELTİLMİŞ
// ===========================================
?>
<section id="services" class="section">
    <div class="container">
        <h2 class="section-title reveal"><?php echo esc_html(get_theme_mod('services_title', __('Uzmanlık Alanları', 'bga-hukuk-temasi'))); ?></h2>
        <p class="section-subtitle reveal"><?php echo wp_kses_post(get_theme_mod('services_subtitle', __('Hukuki ihtiyaçlarınız için kapsamlı çözümler sunuyorum', 'bga-hukuk-temasi'))); ?></p>
        <div class="accordion reveal">
            <?php
            // Varsayılan değerler doğrudan şablon içinde tanımlanır.
            $default_services = [ 
                1 => [
                    'title' => __('Hukuki Danışmanlık ve Dava Takibi', 'bga-hukuk-temasi'), 
                    'content' => __('Ticaret Hukuku, İş Hukuku, Borçlar Hukuku ve Aile Hukuku alanlarında profesyonel danışmanlık ve dava takibi hizmetleri sunuyorum.', 'bga-hukuk-temasi'), 
                    'icon' => 'law-book'
                ], 
                2 => [
                    'title' => __('Arabuluculuk Hizmetleri', 'bga-hukuk-temasi'), 
                    'content' => __('Ticari, iş ve aile uyuşmazlıklarında arabuluculuk hizmetleri ile tarafları barışçıl çözüme ulaştırıyorum.', 'bga-hukuk-temasi'), 
                    'icon' => 'court'
                ], 
                3 => [
                    'title' => __('Marka & Patent Vekilliği', 'bga-hukuk-temasi'), 
                    'content' => __('Marka tescili, patent başvuruları ve fikri mülkiyet haklarının korunması konularında uzman hizmet veriyorum.', 'bga-hukuk-temasi'), 
                    'icon' => 'judge'
                ]
            ];
            for ($i=1; $i <= 3; $i++):
                $title = get_theme_mod('service_title_' . $i, $default_services[$i]['title']);
                $content = get_theme_mod('service_content_' . $i, $default_services[$i]['content']);
                $icon_name = get_theme_mod('service_icon_' . $i, $default_services[$i]['icon']);
                $toggle_icon = get_theme_mod('accordion_toggle_icon', 'plus');
            ?>
            <?php if (!empty($title)): ?>
                <div class="accordion-item">
                    <div class="accordion-header" role="button" tabindex="0">
                        <div class="accordion-icon"><?php echo bga_get_icon($icon_name); ?></div>
                        <h3 class="accordion-title"><?php echo esc_html( $title ); ?></h3>
                        <div class="accordion-toggle-icon"><?php echo bga_get_icon($toggle_icon); ?></div>
                    </div>
                    <div class="accordion-content"><p><?php echo wp_kses_post( $content ); ?></p></div>
                </div>
            <?php endif; endfor; ?>
        </div>
    </div>
</section>
