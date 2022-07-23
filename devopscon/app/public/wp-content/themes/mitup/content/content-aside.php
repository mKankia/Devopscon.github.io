<?php $sticky_class = is_sticky()?'sticky':''; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >
		<div class="post-body">
	           <?php the_content(''); /* Display content  */ ?>
	    </div>
</article>