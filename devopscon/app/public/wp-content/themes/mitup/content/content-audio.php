<?php $sticky_class = is_sticky()?'sticky':''; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >
		
		<?php if(has_post_format('audio')){ ?>
        <div class="post-media">
        	<?php mitup_postformat_audio(); /* Display video of post */ ?>
        </div>
        <?php } ?>

        <div class="post-title">
	            <?php mitup_content_title(); /* Display title of post */ ?>
	    </div>

        <div class="post-meta">
	        <?php mitup_content_meta(); /* Display Date, Author, Comment */ ?>
	    </div>

	    <div class="post-body">
	            <?php mitup_content_body(); /* Display content of post or intro in category page */ ?>
	    </div>

	    <?php if(!is_single()){ ?> 
	            <?php mitup_content_readmore(); /* Display read more button in category page */ ?>
	    <?php }?>

	    

</article>