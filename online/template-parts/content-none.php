<?php
/**
 * content-none.php - PolyLang ve Loco Translate uyumlu versiyon
 */
?>
<section class="no-results not-found section">
	<header class="page-header container">
		<h1 class="page-title section-title"><?php esc_html_e( 'Nothing Found', 'bga-hukuk-temasi' ); ?></h1>
	</header>

	<div class="page-content container">
		<?php if ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bga-hukuk-temasi' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'bga-hukuk-temasi' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>