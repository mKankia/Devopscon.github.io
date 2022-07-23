<?php 
$show_page_heading = get_post_meta(mitup_get_current_id(), "mitup_met_page_heading", true)?get_post_meta(mitup_get_current_id(), "mitup_met_page_heading", true):'yes';
 ?>
<?php if($show_page_heading == 'yes'){ ?>
    <h2 class="post-title">
    	<a href="<?php esc_url(the_permalink());?>" title="<?php the_title();?>">
    		<?php the_title();?>
    	</a>
    </h2>
<?php } ?>

<?php 
	the_content();
	wp_link_pages();
?>
