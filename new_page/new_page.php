<?php

/**
*   Plugin Name: BitTest
*   Plugin URI: http://www.bitacad.net
*   Description: Un plugin de test care activeaza un shortcode ce adauga pagini noi.
*   Version: 1.0
*   Author: Bit Academy
*   Author URI: http://www.bitacad.net
*   License: http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// no direct access

if (!defined('ABSPATH')) { die; }

add_shortcode('new_page', 'content_controller');

function content_controller($atts) {
		
	global $wpdb;
	
	require_once('inc/model.php');
	require_once('inc/view.php');
	
	$atts = shortcode_atts(array('nr' => 3), $atts, 'new_page');
	$nr = $atts['nr'];
	$title = $_GET['title'];
	$post_body = $_GET['page_body'];
	
	$model_obj = new BitTestModel($nr, $wpdb, $title, $page_body);
	$results = $model_obj->get_data();
	
	$output = BitTestView::generate_view($results);
	
	return $output;
			
}

register_activation_hook(__FILE__, 'table_fill');

function table_fill() {
	
	global $wpdb;
	
	$results = $wpdb->get_results("SELECT post_title FROM wp_posts", ARRAY_A);
	
	if (empty($results)) {
		
		$wpdb->insert(
			'wp_posts',
			array(
				'post_title' => 'Titlul',
				'post_content' => 'Continut',
			)
		);
		
	}
	
}

