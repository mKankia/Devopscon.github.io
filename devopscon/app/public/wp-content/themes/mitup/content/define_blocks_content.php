<?php

/* This is functions define blocks to display post */

if ( ! function_exists( 'mitup_content_thumbnail' ) ) {
  function mitup_content_thumbnail( $size ) {
    if ( has_post_thumbnail()  && ! post_password_required() || has_post_format( 'image') )  :
      the_post_thumbnail( $size, array('class'=> 'img-responsive' ));
    endif;
  }
}

if ( ! function_exists( 'mitup_postformat_video' ) ) {
  function mitup_postformat_video( ) { ?>
    <?php if(has_post_format('video') && wp_oembed_get(get_post_meta(get_the_id(), "mitup_met_embed_media", true))){ ?>
	    <div class="js-video postformat_video">
	        <?php echo wp_oembed_get(get_post_meta(get_the_id(), "mitup_met_embed_media", true)); ?>
	    </div>
    <?php } ?>
  <?php }
}

if ( ! function_exists( 'mitup_postformat_audio ') ) {
  function mitup_postformat_audio( ) { ?>
    <?php if(has_post_format('audio') && wp_oembed_get(get_post_meta(get_the_id(), "mitup_met_embed_media", true))){ ?>
	    <div class="js-video postformat_audio">
	        <?php echo wp_oembed_get(get_post_meta(get_the_id(), "mitup_met_embed_media", true)); ?>
	    </div>
    <?php } ?>
  <?php }
}

if ( ! function_exists( 'mitup_content_title' ) ) {
  function mitup_content_title() { ?>

    <?php if ( is_single() ) : ?>
      <h1 class="post-title">
          <?php the_title(); ?>
      </h1>
    <?php else : ?>
      <h2 class="post-title">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
        </a>
      </h2>
      <?php endif; ?>

 <?php }
}


if ( ! function_exists( 'mitup_content_meta' ) ) {
  function mitup_content_meta( ) { ?>
	    <span class="post-meta-content">
		    <span class=" post-date">
		        <span class="left"><i class="fa fa-clock-o"></i></span>
		        <span class="right"><?php the_time( get_option( 'date_format' ));?></span>
		    </span>

		    <span class="slash">/</span>

		    <span class=" post-author">
		        <span class="left"><i class="fa fa-meh-o"></i></span>
		        <span class="right"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></span>
		    </span>

		    <span class="slash">/</span>

		    <span class=" comment">
		        <span class="left"><i class="fa fa-comment-o"></i></span>
		        <span class="right"><a href="<?php the_permalink();?>">                    
		            <?php comments_popup_link(
		            	esc_html__(' Leave Comment', 'mitup'), 
		            	esc_html__(' 1 comment', 'mitup'), 
		            	' % comments'.esc_html__('', 'mitup')
		            ); ?>
		        </a></span>                
		    </span>
		</span>
  <?php }
}

if ( ! function_exists( 'mitup_content_body' ) ) {
  function mitup_content_body( ) { ?>
  	<div class="post-excerpt">
		<?php if(is_single()){
		    the_content();
		    wp_link_pages();                
		}else{
			the_excerpt();
		}?>
	</div>

	<?php 
	}
}

if ( ! function_exists( 'mitup_content_readmore' ) ) {
  function mitup_content_readmore( ) { ?>
  	<div class="post-footer">
		<div class="post-readmore">
		    <a class="btn btn-theme btn-theme-transparent" href="<?php the_permalink(); ?>"><?php  esc_html_e('Read more', 'mitup'); ?></a>
		</div>
	</div>
 <?php }
}

if ( ! function_exists( 'mitup_content_tag' ) ) {
  function mitup_content_tag( ) { ?>
	
	    <footer class="post-tag">
	        <?php if(has_tag()){ ?>
	            <span class="post-tags"><i class="fa fa-tag"></i> 
	                <?php the_tags('',',&nbsp;',''); ?>
	            </span> &nbsp;
	        <?php } ?>
	        <?php if(has_category( )){ ?>
	            <span class="post-categories"><i class="fa fa-folder-open"></i> 
	                <?php the_category(','); ?>
	            </span>
	        <?php } ?>
	    </footer>
	
 <?php }
}

if ( ! function_exists( 'mitup_content_gallery' ) ) {
 	function mitup_content_gallery( ) {

		if(has_post_format('gallery')){

			$gallery = get_post_meta(get_the_ID(), 'mitup_met_file_list', true)?get_post_meta(get_the_ID(), 'mitup_met_file_list', true):'';




		    $k = 0;
		    if($gallery){
		        $i=0;

		        ?>

		        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				  	<?php foreach ($gallery as $key => $value) { ?>
				    	<li data-target="#carousel-example-generic" data-slide-to="<?php echo esc_attr($i); ?>" class="<?php echo ($i==0) ? 'active':''; ?>"></li>
				    <?php $i++; } ?>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
				  	<?php foreach ($gallery as $key => $value) { ?>
					    <div class="item <?php echo esc_attr($k==0)?'active':'';$k++; ?>">
					      <img class="img-responsive" src="<?php  echo esc_attr($value); ?>" alt="<?php echo get_the_title(); ?>">
					    </div>
				   	<?php } ?>
				   </div>

				</div>

		       
		        <?php
		    }
		}

	}
}



//Custom comment List:
if ( ! function_exists( 'mitup_theme_comment' ) ) {
function mitup_theme_comment($comment, $args, $depth) {

   $GLOBALS['comment'] = $comment; ?>   
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <article class="comment_item " id="comment-<?php comment_ID(); ?>">
         <header class="comment-author">
         	<?php echo get_avatar($comment,$size='70', $default = 'mysteryman' ); ?>
         </header>

         <section class="comment-details">
             <div class="comment-meta commentmetadata clearfix media-body author-name">
                  <div class="author-name">
                    <?php printf('%s', get_comment_author_link()) ?>&nbsp;<?php esc_html_e('says: ', 'mitup'); ?>
                    <?php printf(get_comment_date()) ?>
                    <div class="event_reply">
                    	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	                    <?php edit_comment_link( esc_html__( '&nbsp; (Edit)', 'mitup' ), '  ', '' );?>
		            </div>
                  </div> 
                  
              </div>

              <div class="comment-body clearfix comment-content">
                  <?php comment_text() ?>
              </div>
                
             
          </section>
          <?php if ($comment->comment_approved == '0') : ?>
             <em><?php esc_html_e('Your comment is awaiting moderation.', 'mitup') ?></em>
             <br />
          <?php endif; ?>
      
        
     </article>
<?php
}
}






