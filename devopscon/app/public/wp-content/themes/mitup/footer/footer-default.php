<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-3 footer_copyright">
				<?php if( is_active_sidebar('footer') ){ dynamic_sidebar('footer'); } ?>
			</div>
			<div class="col-md-3 footer_contact">
				<?php if( is_active_sidebar('footer_contact') ){ dynamic_sidebar('footer_contact'); } ?>
			</div>
			<div class="col-md-3 footer_sub">
				<?php if( is_active_sidebar('footer_sub') ){ do_shortcode( dynamic_sidebar('footer_sub') ); } ?>
			</div>
			<div class="col-md-3 footer_social">
				<?php if( is_active_sidebar('footer_social') ){ dynamic_sidebar('footer_social'); } ?>
			</div>
		</div>
	</div>
</footer>