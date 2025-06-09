<?php
// ===========================================
// 6. section-latest-posts.php - DÜZELTİLMİŞ (Text domain düzeltildi)
// ===========================================
$posts_page_id = get_option('page_for_posts');
$posts_page_url = get_permalink($posts_page_id);
?>
<section id="latest-posts" class="section">
    <div class="container">
        <h2 class="section-title reveal"><?php echo esc_html(get_the_title($posts_page_id) ?: __('Son Makaleler', 'bga-hukuk-temasi')); ?></h2>
        
        <div class="article-grid">
            <?php
            $latest_posts = new WP_Query([
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
            ]);

            if ($latest_posts->have_posts()) :
                while ($latest_posts->have_posts()) : $latest_posts->the_post();
                    get_template_part('template-parts/content', 'excerpt');
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>' . esc_html__('Henüz makale bulunmamaktadır.', 'bga-hukuk-temasi') . '</p>';
            endif;
            ?>
        </div>
        
        <?php if ($posts_page_id) : ?>
            <div class="view-all-posts-wrapper reveal">
                <a href="<?php echo esc_url($posts_page_url); ?>" class="button-view-all"><?php esc_html_e('Tüm Makaleleri Görüntüle', 'bga-hukuk-temasi'); ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>