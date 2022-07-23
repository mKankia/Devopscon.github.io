<?php 
	
		add_action('after_setup_theme', 'mitup_theme_support', 10);
		
		add_filter('oembed_result', 'mitup_framework_fix_oembeb', 10 );
		add_filter('paginate_links', 'mitup_fix_pagination_error',10);
		
		add_action( 'admin_enqueue_scripts', 'mitup_wpadminjs' );
		
		
		add_action('init', 'mitup_vc_add_param', 10);
		add_action( 'admin_init', 'mitup_add_editor_styles' );

		/* Add theme support */
		function mitup_theme_support(){

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		        wp_enqueue_script( 'comment-reply' );

		    if ( ! isset( $content_width ) ) $content_width = 900;

		    add_theme_support('title-tag');

		    // Adds RSS feed links to <head> for posts and comments.
		    add_theme_support( 'automatic-feed-links' );

		    // Switches default core markup for search form, comment form, and comments    
		    // to output valid HTML5.
		    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

		    /*
		     * This theme supports all available post formats by default.
		     * See http://codex.wordpress.org/Post_Formats
		     */
		     add_theme_support( 'post-formats', array( 'image', 'gallery', 'audio', 'video') );

		    add_theme_support( 'post-thumbnails' );

		    if ( function_exists( 'add_theme_support' ) ) {
		    	add_image_size('mitup_thumbnail_70x70', 70, 70, true);
		    }
		    
		    add_theme_support( 'custom-header' );
		    add_theme_support( 'custom-background');

		    add_filter('gutenberg_use_widgets_block_editor', '__return_false');
			add_filter('use_widgets_block_editor', '__return_false');
		    
		    
		}


		function mitup_add_editor_styles() {
		    add_editor_style( 'custom-editor-style.css' );
		}
		



		

		function mitup_framework_fix_oembeb( $url ){
		    $array = array (
		        'webkitallowfullscreen'     => '',
		        'mozallowfullscreen'        => '',
		        'frameborder="0"'           => '',
		        '</iframe>)'        => '</iframe>'
		    );
		    $url = strtr( $url, $array );

		    if ( strpos( $url, "<embed src=" ) !== false ){
		        return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $url);
		    }
		    elseif ( strpos ( $url, 'feature=oembed' ) !== false ){
		        return str_replace( 'feature=oembed', 'feature=oembed&amp;wmode=opaque', $url );
		    }
		    else{
		        return $url;
		    }
		}

		

		function mitup_wpadminjs() {
			if (is_admin()){
				wp_enqueue_script( 'mitup_wpadminjs', MITUP_THEME_URI.'/extend/wpadmin.js', array('jquery'),false,true );
		    	wp_enqueue_style('mitup_fixcssadmin', MITUP_THEME_URI.'/extend/cssadmin.css',  false, '1.0');	
			}
		}

		// Fix pagination
		function mitup_fix_pagination_error($link) {
			return str_replace('#038;', '&', $link);
		}


		function mitup_pagination_theme() {
		   
		    if( is_singular() )
		        return;
		 
		    global $wp_query;
		 
		    /** Stop execution if there's only 1 page */
		    if( $wp_query->max_num_pages <= 1 )
		        return;
		 
		    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		    $max   = intval( $wp_query->max_num_pages );
		 
		    /** Add current page to the array */
		    if ( $paged >= 1 )
		        $links[] = $paged;
		 
		    /** Add the pages around the current page to the array */
		    if ( $paged >= 3 ) {
		        $links[] = $paged - 1;
		        $links[] = $paged - 2;
		    }
		 
		    if ( ( $paged + 2 ) <= $max ) {
		        $links[] = $paged + 2;
		        $links[] = $paged + 1;
		    }
		 
		    echo wp_kses( __( '<div class="blog_pagination"><ul class="pagination">','mitup' ), true ) . "\n";
		 
		    /** Previous Post Link */
		    if ( get_previous_posts_link() )
		        printf( '<li class="prev page-numbers">%s</li>' . "\n", get_previous_posts_link('<i class="fa fa-chevron-left"></i>') );
		 
		    /** Link to first page, plus ellipses if necessary */
		    if ( ! in_array( 1, $links ) ) {
		        $class = 1 == $paged ? ' class="active"' : '';
		 
		        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		 
		        if ( ! in_array( 2, $links ) )
		            echo wp_kses( __('<li><span class="pagi_dots">...</span></li>', 'mitup' ) , true);
		    }
		 
		    /** Link to current page, plus 2 pages in either direction if necessary */
		    sort( $links );
		    foreach ( (array) $links as $link ) {
		        $class = $paged == $link ? ' class="active"' : '';
		        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		    }
		 
		    /** Link to last page, plus ellipses if necessary */
		    if ( ! in_array( $max, $links ) ) {
		        if ( ! in_array( $max - 1, $links ) )
		            echo wp_kses( __('<li><span class="pagi_dots">...</span></li>', 'mitup' ) , true) . "\n";
		 
		        $class = $paged == $max ? ' class="active"' : '';
		        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		    }
		 
		    /** Next Post Link */
		    if ( get_next_posts_link() )
		        printf( '<li class="next page-numbers">%s</li>' . "\n", get_next_posts_link('<i class="fa fa-chevron-right"></i>') );
		 
		    echo wp_kses( __( '</ul></div>', 'mitup' ), true ) . "\n";
		 
		}




		/* Visual Composer */

		function mitup_vc_add_param(){
			/* Visual Composer */
			if(function_exists('vc_add_param')){

			  /* Customize Row element */	
			  $vc_row_attributes = array(
			    
			   
			    array("type" => "colorpicker",
			        "heading" => esc_html__('Background pattern color ', 'mitup'),
			        "param_name" => 'ova_bg_pattern',
			        "default"	=> ''
			    ),
			    array("type" => "dropdown",
			        "heading" => esc_html__('Choose opacity for background pattern color', 'mitup'),
			        "param_name" => "opacity_bg_pattern",
			        "value" => array(

			                esc_html__('0.1', 'mitup') => '0.1',
			                esc_html__('0.2', 'mitup') => '0.2',
			                esc_html__('0.3', 'mitup') => '0.3',
			                esc_html__('0.4', 'mitup') => '0.4',
			                esc_html__('0.5', 'mitup') => '0.5',
			                esc_html__('0.6', 'mitup') => '0.6',
			                esc_html__('0.7', 'mitup') => '0.7',
			                esc_html__('0.8', 'mitup') => '0.8',
			                esc_html__('0.9', 'mitup') => '0.9',
			                esc_html__('1', 'mitup') => '1',
			        )

			    ),
			    array("type" => "colorpicker",
			        "heading" => esc_html__('Text Color of Row', 'mitup'),
			        "param_name" => 'ova_textcolor',
			        "default"	=> '#333'
			    ),

			  );
			  vc_add_params( 'vc_row', $vc_row_attributes );
			  /* /Customize Row element */	

			 
			  
			}
		}
		

		

	

