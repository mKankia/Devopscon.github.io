<?php get_header();

// Open layout
get_template_part('templates/mitup_open_layout');

?>

<!-- Get content -->
<header class="page-header">
	<h2 class="page-title">
		<?php esc_html_e("Search Results for:", 'mitup'); printf(' <span>%s</span>', get_search_query() ); ?>
	</h2>
</header>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content/content', 'search' ); ?>
<?php endwhile; ?>
    <div class="pagination-wrapper">
        <?php mitup_pagination_theme(); ?>
	</div>
<?php else : ?>
        <?php get_template_part( 'content/content', 'none' ); ?>
<?php endif; ?>


<?php 

// Close layout
get_template_part('templates/mitup_close_layout');

get_footer(); ?>