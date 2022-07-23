<?php $sticky_class = is_sticky()?'sticky':''; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >
		
		<?php
		        $link = get_post_meta( $post->ID, 'format_link_url', true );
		        $link_description = get_post_meta( $post->ID, 'format_link_description', true );
		        
		        if ( is_single() ) {
		                printf( '<h1 class="entry-title"><a href="%1$s" target="blank">%2$s</a></h1>',
		                        $link,
		                        get_the_title()
		                );
		        } else {
		                printf( '<h2 class="entry-title"><a href="%1$s" target="blank">%2$s</a></h2>',
		                        $link,
		                        get_the_title()
		                );
		        }
		?>
		<?php
		        printf( '<a href="%1$s" target="blank">%2$s</a>',
		                $link,
		                $link_description
		        );
		?>
</article>