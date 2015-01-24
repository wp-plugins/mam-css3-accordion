<?php 
/*
Plugin Name: MAM Hover-Accordion
Plugin URI: http://mamunkhan.net/plugins/mam-hover-accordion
Description: This plugin will enable css3 accordion your wordpress theme. You can embed css3 accordion via shortcode in everywhere you want, even in theme files. 
Author: MAMUN KHAN
Version: 1.0
Author URI: http://mamunkhan.net/plugins
*/

/*Some Set-up*/
define('NIVO_HOVER_ACCORDION_SLIDER_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

wp_enqueue_script('mam-accordion-hover-button-slider-jquery', NIVO_HOVER_ACCORDION_SLIDER_PLUGIN_URL.'js/accordian-button.js', array('jquery'));

wp_enqueue_style('hover-accordion-plugin-default-css', NIVO_HOVER_ACCORDION_SLIDER_PLUGIN_URL.'css/style.css');
wp_enqueue_style('hover-responsive-accordion-plugin-default-css', NIVO_HOVER_ACCORDION_SLIDER_PLUGIN_URL.'css/responsive.css');







/* Add Slider Shortcode Button on Post Visual Editor */

function mam_all_hover_ccordion_button() {
	add_filter ("mce_external_plugins", "mamhovertaccordion_button_js");
	add_filter ("mce_buttons", "mamhoveraccordionb");
}

function mamhovertaccordion_button_js($plugin_array) {
	$plugin_array['wptuts'] = plugins_url('js/accordian-button.js', __FILE__);
	return $plugin_array;
}

function mamhoveraccordionb($buttons) {
	array_push ($buttons, 'mamhoveraccordion');
	return $buttons;
}
add_action ('init', 'mam_all_hover_ccordion_button'); 






/* This code for Slider shortcode */
function hover_accordion_wrapper_shortcode( $atts, $content = null  ) {

	return '
	<div class="accordion"><ul>'.do_shortcode($content).'</ul></div>	
	';
}	
add_shortcode('mamhover', 'hover_accordion_wrapper_shortcode');


function hover_accordion_shortcode( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'title' => '',
		'text' => '',
	), $atts ) );
	
	
	return '
			<li>
				<a href="'.get_the_permalink().'"><span>'.$title.'</span></a>
				<div>
					<p>'.$text.'</p>
				</div>
			</li>
	';
}	
add_shortcode('hover', 'hover_accordion_shortcode');










?>