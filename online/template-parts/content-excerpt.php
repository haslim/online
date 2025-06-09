<article id="post-<?php the_ID(); ?>" <?php post_class('article-card reveal'); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" class="article-card-image-link" title="<?php the_title_attribute(); ?>">
            <div class="article-card-image">
                <?php the_post_thumbnail('large', ['loading' => 'lazy', 'alt' => get_the_title()]); ?>
            </div>
        </a>
    <?php endif; ?>

    <div class="article-card-content">
        <header class="article-header">
            <?php the_title( sprintf( '<h2 class="article-title"><a href="%s" rel="bookmark" title="%s">', esc_url( get_permalink() ), the_title_attribute( array( 'echo' => false ) ) ), '</a></h2>' ); ?>
        </header>

        <div class="article-summary">
            <?php 
            if ( has_excerpt() ) {
                the_excerpt();
            } else {
                echo '<p>' . wp_trim_words( get_the_content(), 30, '...' ) . '</p>';
            }
            ?>
        </div>
    </div>
</article>
