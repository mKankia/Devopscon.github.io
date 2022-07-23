<?php

// Open layout
$main_layout = mitup_get_current_main_layout();
$width_main_content = ($main_layout == 'full_width' ) ? 'ovatheme_fullwidth' : mitup_width_main_content();

?>

<section class="page-section">
	<div class="container">
	    <div class="row">
	        <div class=" <?php echo esc_attr($width_main_content); ?>" >

