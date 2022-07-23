<?php get_header();


// Open layout
get_template_part('templates/mitup_open_layout');


// Get content
if ( have_posts() ) : while ( have_posts() ) : the_post();
	get_template_part( 'content/content', get_post_format() );
    if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

endwhile; else :
    get_template_part( 'content/content', 'none' );
endif;

// Close layout

get_template_part('templates/mitup_close_layout');

get_footer(); ?>
