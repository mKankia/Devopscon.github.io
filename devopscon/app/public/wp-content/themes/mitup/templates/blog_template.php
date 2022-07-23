<?php
/** Template Name: Blog Template */
get_header();

// Open layout
get_template_part('templates/mitup_open_layout');




$show_page_heading = get_post_meta(mitup_get_current_id(), "mitup_met_page_heading", true) ? get_post_meta(mitup_get_current_id(), "mitup_met_page_heading", true):'yes'; ?>
<?php if($show_page_heading == 'yes'){ ?>
    <h2 class="post-title"><?php the_title();?> </h2>
<?php } ?>


<?php 
    $blog_page = get_post_meta(mitup_get_current_id(), "mitup_met_blog_page", true) ? get_post_meta(mitup_get_current_id(), "mitup_met_blog_page", true):'3';
    switch ($blog_page) {
        case '1':
            $column = '';
            break;
        case '2':
            $column = 'col-md-6';
            break;
        case '3':
            $column = 'col-md-4';
            break;
        case '4':
            $column = 'col-md-3';
            break;
        default:
            $column = 'col-md-4';
            break;
    }
    
?>

<?php 
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(    
        'paged' => $paged,
        'post_type' => 'post',
        'orderby'   => 'date',
    );
    $blog = new WP_Query($args);
    $i = 0;?>
    
        <?php if ( $blog->have_posts() ) : while ( $blog->have_posts() ) : $blog->the_post(); ?>

            <?php if($i == $blog_page){  ?><div class="clearfix"></div><?php $i=0; } $i++; ?>
            
            <div class="<?php echo esc_attr( $column ); ?>">
            <?php get_template_part( 'content/content', get_post_format() ); ?>
            </div>

        <?php endwhile; ?>
    
            <div class="pagination-wrapper">
                <?php
                    global $wp_query;

                    $big = 999999999; // need an unlikely integer
                    $pages = paginate_links(array(
                                 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                 'format' => '?paged=%#%',
                                 'current' => max(1, get_query_var('paged') ),
                                 'total' => $blog->max_num_pages,
                                 'next_text'    => wp_kses( __('<i class="fa fa-chevron-right"></i>', 'mitup'), true),
                                 'prev_text'    => wp_kses( __('<i class="fa fa-chevron-left"></i>', 'mitup'), true),
                                 'type'         => 'array',
                             ) );

                    if( is_array( $pages ) ) {
                        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
                        echo wp_kses( __('<ul class="pagination">', 'mitup'), true);
                        foreach ( $pages as $page ) {
                                echo wp_kses( __('<li>', 'mitup'), true) .wp_kses($page,true). wp_kses( __('</li>', 'mitup'), true);
                        }
                       echo wp_kses( __('</ul>', 'mitup'), true ) ;
                    }
                ?>
            </div>
    <?php else : ?>
            <p><?php esc_html_e('Sorry, no pages matched your criteria.', 'mitup'); ?></p>
    <?php endif; wp_reset_postdata(); ?>

    
<?php
// Close layout
get_template_part('templates/mitup_close_layout');

get_footer();

?>