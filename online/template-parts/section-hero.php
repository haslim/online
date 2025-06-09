<?php
// ===========================================
// 1. section-hero.php - DÜZELTİLMİŞ
// ===========================================
?>
<section id="hero" class="section">
    <div class="container hero-content">
        <h1 class="hero-title reveal">
            <?php echo wp_kses_post( get_theme_mod( 'hero_title', __('AV. Arb. Billur GÜLER ASLIM', 'bga-hukuk-temasi') ) ); ?>
        </h1>
        <div class="hero-tagline reveal" style="transition-delay: 0.2s;">
            <?php echo wp_kses_post( get_theme_mod( 'hero_tagline', __('Hukuki Çözümlerde Güvenilir Ortağınız <br> Karmaşık süreçlerde netlik, stratejik davalarda güç.', 'bga-hukuk-temasi') ) ); ?>
        </div>
    </div>
</section>

<?php