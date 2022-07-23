<?php get_header();


// Open layout
get_template_part('templates/mitup_open_layout');
					
if ( have_posts() ) : while ( have_posts() ) : the_post();
    get_template_part( 'content/content', 'page' );
    if ( comments_open() ) comments_template( '', true );
endwhile; else : ?>
        <p><?php esc_html_e('Sorry, no pages matched your criteria.', 'mitup'); ?></p>
<?php endif;

get_template_part('templates/mitup_close_layout');



get_footer(); ?>




