<?php
/*
Plugin Name: Interactive World Map Plugin
Plugin URI: http://devorion.work/
Description:  Interactive World Map Plugin
Version: 1.0
Author: Selman Demirdoven
Author URI: http://devorion.work
Licence: GPLv2 or later
*/
if ( !defined( 'ABSPATH' ) ){
	exit;
}
function iwmp_front_scripts() {
	wp_enqueue_script('worldmap-js', plugin_dir_url( __FILE__ ).'worldmap.js', '', '1.0.0', false);
}
add_action('wp_enqueue_scripts', 'iwmp_front_scripts');

function iwmp_my_map_shortcode ($atts, $content = null) {
	ob_start();
	extract(shortcode_atts(array(
		"countries" => '',
		"colors" => '',
	), $atts));
	$countries_array = explode(",", $countries);
	$colors_array = explode(",", $colors);
	$map_details = array_combine($countries_array, $colors_array);
	?>
	<canvas id="my_map" width="800" height="400" style="max-width: 100%;"></canvas>
	<script type="text/javascript">
	WorldMap({
		id: "my_map",
		padding: 10,
		detail: <?php echo json_encode($map_details); ?>
	});
	</script>
	<?php
	return ob_get_clean();
}
add_shortcode('my_map', 'iwmp_my_map_shortcode');
?>