<?php
/**
 * LookBook - Shop by Outfit Setup
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Enqueue Frontend Assets
 */
add_action( 'enqueue_block_assets', 'spike_lookbook_snap_to_scroll_assets' );
function spike_lookbook_snap_to_scroll_assets() {
	wp_register_script(
		'getbowtied-lookbook-shop-by-outfit-scripts',
		plugins_url( 'assets/js/frontend'.SPIKE_SUFFIX.'.js', dirname(__FILE__) ),
		array( 'jquery', 'jquery-scrollify' ),
		SPIKE_VERSION
	);

	wp_register_style(
		'getbowtied-lookbook-shop-by-outfit-styles',
		plugins_url( 'assets/css/frontend/style'.SPIKE_SUFFIX.'.css', dirname(__FILE__) ),
		array(),
		filemtime(plugin_dir_path( dirname(__FILE__) ) . 'assets/css/frontend/style'.SPIKE_SUFFIX.'.css')
	);
}

/**
 * Enqueue Editor Assets
 */
add_action( 'enqueue_block_editor_assets', 'spike_lookbook_snap_to_scroll_editor_assets' );
function spike_lookbook_snap_to_scroll_editor_assets() {
	wp_register_script(
		'getbowtied-lookbook-shop-by-outfit-editor-scripts',
		plugins_url( 'blocks/lookbook'.SPIKE_SUFFIX.'.js', dirname(__FILE__) ),
		array( 'wp-blocks', 'wp-components', 'wp-editor', 'wp-i18n', 'wp-element', 'jquery' ),
		SPIKE_VERSION
	);

	wp_register_script(
		'getbowtied-lookbook-shop-by-outfit-product-editor-scripts',
		plugins_url( 'blocks/product'.SPIKE_SUFFIX.'.js', dirname(__FILE__) ),
		array( 'wp-blocks', 'wp-components', 'wp-editor', 'wp-i18n', 'wp-element', 'jquery' ),
		SPIKE_VERSION
	);

	wp_register_style(
		'getbowtied-lookbook-shop-by-outfit-editor-styles',
		plugins_url( 'assets/css/backend/editor'.SPIKE_SUFFIX.'.css', dirname(__FILE__) ),
		array(),
		filemtime(plugin_dir_path( dirname(__FILE__) ) . 'assets/css/backend/editor'.SPIKE_SUFFIX.'.css')
	);
}

/**
 * Register Block
 */
register_block_type( 'getbowtied/lookbook-shop-by-outfit', array(
	'editor_script'		=> 'getbowtied-lookbook-shop-by-outfit-editor-scripts',
	'editor_style'		=> 'getbowtied-lookbook-shop-by-outfit-editor-styles',
	'script'			=> 'getbowtied-lookbook-shop-by-outfit-scripts',
	'style'				=> 'getbowtied-lookbook-shop-by-outfit-styles',
	'attributes'      	=> array(
		'title' 						=> array(
			'type'						=> 'string',
			'default'					=>  'Lookbook Title',
		),
		'subtitle'						=> array(
			'type'						=> 'string',
			'default'					=>  'Lookbook Subtitle',
		),
		'imgURL'						=> array(
			'type'						=> 'string',
			'default'					=> '',
		),
		'imgID'							=> array(
			'type'						=> 'number',
			'default'					=> 0,
		),
		'imgAlt'						=> array(
			'type'						=> 'string',
			'default'					=> 'alt',
		),
		'bgColor'						=> array(
			'type'						=> 'string',
			'default'					=> '#d3d5d9',
		),
		'textColor'						=> array(
			'type'						=> 'string',
			'default'					=> '#000',
		),
	),
) );

register_block_type( 'getbowtied/lookbook-shop-by-outfit-product', array(
	'editor_script'		=> 'getbowtied-lookbook-shop-by-outfit-product-editor-scripts',
	'parent'			=> 'getbowtied/lookbook-shop-by-outfit',
	'attributes'      	=> array(
		'productIDs' 					=> array(
			'type'						=> 'string',
			'default'					=>  '',
		),
		'imgURL'						=> array(
			'type'						=> 'string',
			'default'					=>  '',
		),
		'imgID'							=> array(
			'type'						=> 'number',
			'default'					=> 0,
		),
		'image_position'				=> array(
			'type'						=> 'string',
			'default'					=>  'image-right',
		),
		'align'							=> array(
			'type'						=> 'string',
			'default'					=> 'center',
		),
	),

	'render_callback' => 'spike_render_frontend_lookbook_snap_to_scroll_product',
) );
