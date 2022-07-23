<?php	
function mitup_register_menus() {
  register_nav_menus( array(
    'primary'   => esc_html__( 'Primary Menu', 'mitup' ),
    'onepage'   => esc_html__( 'OnePage Menu', 'mitup' )

  ) );
}
add_action( 'init', 'mitup_register_menus' );
