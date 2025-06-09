<?php
/**
 * The main template file.
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Billur_Guler_Aslim_Theme
 */

get_header();

// Front page için özel bir kontrol
if ( is_front_page() && ! is_home() ) {
    // Statik ön sayfa ayarlanmışsa
    get_template_part('template-parts/section', 'hero');
    get_template_part('template-parts/section', 'about');
    get_template_part('template-parts/section', 'services');
    get_template_part('template-parts/section', 'credentials');
    get_template_part('template-parts/section', 'latest-posts'); // Makaleler bölümü
    get_template_part('template-parts/section', 'contact');
} elseif ( is_home() ) {
    // Blog sayfası (latest posts)
    ?>
    <main id="main-content" class="site-main blog-archive">
        <header class="page-header section">
            <div class="container">
                <h1 class="page-title section-title"><?php single_post_title(); ?></h1>
                <?php if ( get_the_archive_description() ) : ?>
                    <div class="archive-description section-subtitle"><?php the_archive_description(); ?></div>
                <?php endif; ?>
            </div>
        </header>

        <div class="container blog-content section">
            <div class="article-grid">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content', 'excerpt' );
                    endwhile;
                    bga_posts_pagination(); // Sayfalama fonksiyonu
                else :
                    get_template_part( 'template-parts/content', 'none' );
                endif;
                ?>
            </div>
        </div>
    </main>
    <?php
} elseif ( is_single() ) {
    // Tekil gönderi sayfası
    ?>
    <main id="main-content" class="site-main single-post">
        <?php
        while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content', 'single' );
        endwhile;
        ?>
    </main>
    <?php
} elseif ( is_page() ) {
    // Normal sayfalar
    ?>
    <main id="main-content" class="site-main page">
        <?php
        while ( have_posts() ) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('page-single'); ?>>
                <header class="page-header section">
                    <div class="container">
                        <?php the_title( '<h1 class="page-title section-title">', '</h1>' ); ?>
                    </div>
                </header>
                <div class="page-content section">
                    <div class="container">
                        <?php the_content(); ?>
                        <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'billur-guler-aslim' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>
                </div>
            </article>
            <?php
        endwhile;
        ?>
    </main>
    <?php
} elseif ( is_archive() || is_search() ) {
    // Arşivler (kategori, etiket, yazar, tarih) ve Arama sonuçları
    ?>
    <main id="main-content" class="site-main archive-page">
        <header class="page-header section">
            <div class="container">
                <?php
                the_archive_title( '<h1 class="page-title section-title">', '</h1>' );
                if ( get_the_archive_description() ) {
                    the_archive_description( '<div class="archive-description section-subtitle">', '</div>' );
                }
                ?>
            </div>
        </header>

        <div class="container blog-content section">
            <div class="article-grid">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content', 'excerpt' );
                    endwhile;
                    bga_posts_pagination(); // Sayfalama fonksiyonu
                else :
                    get_template_part( 'template-parts/content', 'none' );
                endif;
                ?>
            </div>
        </div>
    </main>
    <?php
} else {
    // Diğer tüm durumlar için varsayılan döngü
    ?>
    <main id="main-content" class="site-main default-page">
        <div class="container section">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    the_content(); // Basit içerik gösterimi
                endwhile;
            else :
                get_template_part( 'template-parts/content', 'none' );
            endif;
            ?>
        </div>
    </main>
    <?php
}

get_footer();