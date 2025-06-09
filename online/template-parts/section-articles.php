<?php
// ===========================================
// 7. section-articles.php - DÜZELTİLMİŞ (Text domain düzeltildi)
// ===========================================
?>
<section id="articles" class="section section-articles">
  <div class="container">
    <h2><?php _e('Makaleler', 'bga-hukuk-temasi'); ?></h2>
    <div class="articles-list">
      <?php
      $articles = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 3,
      ]);
      if ($articles->have_posts()):
        while ($articles->have_posts()): $articles->the_post(); ?>
          <article class="article-excerpt">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="excerpt"><?php the_excerpt(); ?></div>
          </article>
        <?php endwhile;
        wp_reset_postdata();
      else: ?>
        <p><?php _e('Henüz makale bulunmamaktadır.', 'bga-hukuk-temasi'); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>