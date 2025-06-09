<?php
// ===========================================
// 2. section-about.php - DÜZELTİLMİŞ
// ===========================================
$about_image_url = get_theme_mod('about_image', get_template_directory_uri() . '/assets/images/about-placeholder.webp');
$subheading1 = get_theme_mod('about_subheading_1', __('Felsefem', 'bga-hukuk-temasi'));
$text1 = get_theme_mod('about_text_1', __('Hukuk, yalnızca kanun metinlerinden ibaret değildir; temelinde insan, adalet ve denge arayışı yatar. Benimsediğim yaklaşım, müvekkillerimin hukuki ihtiyaçlarını derinlemesine anlamak ve bu ihtiyaçları sadece yasal çerçevede değil, aynı zamanda stratejik ve ticari hedefleri doğrultusunda çözüme kavuşturmaktır.', 'bga-hukuk-temasi'));
$subheading2 = get_theme_mod('about_subheading_2', __('Biyografi', 'bga-hukuk-temasi'));
$text2 = get_theme_mod('about_text_2', __('15 yılı aşkın mesleki tecrübemle, Antalya merkezli olarak avukatlık, arabuluculuk ve marka-patent vekilliği alanlarında hizmet vermekteyim. Fikri Mülkiyet Hukuku, İş Hukuku, Ticaret Hukuku gibi alanlardaki uzmanlığımı, uyuşmazlıkların çözümünde modern ve sonuç odaklı bir bakış açısıyla birleştiriyorum.', 'bga-hukuk-temasi'));
?>
<section id="about" class="section">
    <div class="container">
        <div class="about-grid">
            <div class="about-image-wrapper reveal">
                <img src="<?php echo esc_url($about_image_url); ?>" alt="<?php esc_attr_e('Avukat Arabulucu Billur Güler Aslım', 'bga-hukuk-temasi'); ?>" class="about-image" loading="lazy"/>
            </div>
            <div class="about-text">
                <div class="reveal">
                    <h2 class="sub-heading"><?php echo esc_html($subheading1); ?></h2>
                    <p><?php echo wp_kses_post($text1); ?></p>
                </div>
                <div class="reveal" style="transition-delay: 0.2s;">
                    <h2 class="sub-heading"><?php echo esc_html($subheading2); ?></h2>
                    <p><?php echo wp_kses_post($text2); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>