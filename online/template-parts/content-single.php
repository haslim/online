<article id="post-<?php the_ID(); ?>" <?php post_class('post-single'); ?>>
    <header class="post-header section">
        <div class="container">
            <?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
            <div class="post-meta">
                <span class="post-date">
                    <?php _e( 'Published on', 'bga-hukuk-temasi' ); ?>
                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                </span>
                <?php if ( get_the_author() ) : ?>
                    <span class="post-author">
                        <?php _e( 'by', 'bga-hukuk-temasi' ); ?>
                        <span class="author-name"><?php the_author(); ?></span>
                    </span>
                <?php endif; ?>
                <?php if ( has_category() ) : ?>
                    <span class="post-categories">
                        <?php _e( 'in', 'bga-hukuk-temasi' ); ?>
                        <?php the_category( ', ' ); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('full', ['alt' => get_the_title()]); ?>
        </div>
    <?php endif; ?>

    <div class="post-content section">
        <div class="container">
            <?php
            the_content();
            
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'bga-hukuk-temasi' ),
                'after'  => '</div>',
            ) );
            ?>
        </div>
    </div>

    <?php if ( has_tag() ) : ?>
        <footer class="post-footer section">
            <div class="container">
                <div class="post-tags">
                    <span class="tags-label"><?php _e( 'Tags:', 'bga-hukuk-temasi' ); ?></span>
                    <?php the_tags( '', ', ', '' ); ?>
                </div>
            </div>
        </footer>
    <?php endif; ?>
</article>

<?php 
// Post navigation
$prev_post = get_previous_post();
$next_post = get_next_post();

if ( $prev_post || $next_post ) : ?>
    <nav class="post-navigation section">
        <div class="container">
            <h2 class="screen-reader-text"><?php _e( 'Post navigation', 'bga-hukuk-temasi' ); ?></h2>
            <div class="nav-links">
                <?php if ( $prev_post ) : ?>
                    <div class="nav-previous">
                        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
                            <span class="nav-subtitle"><?php _e( 'Previous:', 'bga-hukuk-temasi' ); ?></span>
                            <span class="nav-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ( $next_post ) : ?>
                    <div class="nav-next">
                        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next">
                            <span class="nav-subtitle"><?php _e( 'Next:', 'bga-hukuk-temasi' ); ?></span>
                            <span class="nav-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
<?php endif; ?>

<?php // SEO için Yapılandırılmış Veri ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php echo esc_url(get_permalink()); ?>"
  },
  "headline": "<?php echo esc_js(get_the_title()); ?>",
  <?php if ( has_post_thumbnail() ) : ?>
  "image": "<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>",
  <?php endif; ?>
  "datePublished": "<?php echo esc_attr(get_the_date('c')); ?>",
  "dateModified": "<?php echo esc_attr(get_the_modified_date('c')); ?>",
  "author": {
    "@type": "Person",
    "name": "<?php echo esc_js(get_the_author()); ?>"
  },
  "publisher": {
    "@type": "Organization",
    "name": "<?php echo esc_js(get_bloginfo('name')); ?>",
    <?php $logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ); ?>
    <?php if ( $logo ) : ?>
    "logo": {
      "@type": "ImageObject",
      "url": "<?php echo esc_url($logo[0]); ?>"
    }
    <?php endif; ?>
  }
}
</script>