<?php get_header();

// Open layout
get_template_part('templates/mitup_open_layout');


?>

					
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content/content', get_post_format() ); ?>
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