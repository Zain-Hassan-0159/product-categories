<?php
/**
 * Plugin Name:       product-categories
 * Plugin URI:        https://hassanzain.com
 * Description:       This is the custom elementor plugin widget extention.
 * Author:            Zain Hassan
 * Author URI:        https://hassanzain.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       elementor-pro
 */

if(!defined('ABSPATH')){
    exit;
}

/**
 *  Elementor Custom Widget
*/
function register_product_categoriesCustom_widgets( $widgets_manager ) {

	require_once( __DIR__ . '/inc/categories.php' );
	$widgets_manager->register( new \CategoriesOne );


}

add_action( 'elementor/widgets/register', 'register_product_categoriesCustom_widgets' );


