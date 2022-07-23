<?php 
// Close layout
wp_reset_postdata();
$main_layout = mitup_get_current_main_layout();
$width_sidebar = mitup_width_sidebar();
?>

</div>

<?php if( $main_layout == "right_sidebar" || $main_layout == "left_sidebar" ){ ?>
    <div class="<?php echo esc_attr($width_sidebar); ?>">
       <?php get_sidebar(); ?>
    </div>
<?php } ?>

</div></div></section>




