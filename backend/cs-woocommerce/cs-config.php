<?php

/**
 * woocommerce custom settings
 * and hooks
 */
if ( !function_exists( 'jobcareer_woocommerce_enabled' ) ) {

	function jobcareer_woocommerce_enabled() {
		if ( class_exists( 'WooCommerce' ) ) {
			return true;
		}
		return false;
	}

}

/**
 * check if the plugin is enabled, 
 * otherwise stop the script
 */
if ( !jobcareer_woocommerce_enabled() ) {
	return false;
}

/**
 * @Woocommerce Support Theme
 *
 */
add_theme_support( 'woocommerce' );

add_filter( 'woocommerce_enqueue_styles', '__return_false' );

if ( !function_exists( 'child_manage_woocommerce_styles' ) ) {

	add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );

	function child_manage_woocommerce_styles() {
		//remove generator meta tag
		remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
		//first check that woo exists to prevent fatal errors
		if ( function_exists( 'is_woocommerce' ) ) {
			//dequeue scripts and styles
			if ( !is_woocommerce() && !is_cart() && !is_checkout() && !is_shop() ) {
				wp_dequeue_script( 'wc_price_slider' );
				wp_dequeue_script( 'wc-single-product' );
				//wp_dequeue_script('wc-add-to-cart');
				wp_dequeue_script( 'wc-cart-fragments' );
				wp_dequeue_script( 'wc-checkout' );
				wp_dequeue_script( 'wc-add-to-cart-variation' );
				wp_dequeue_script( 'wc-single-product' );
				//wp_dequeue_script('wc-cart');
				wp_dequeue_script( 'wc-chosen' );
				//wp_dequeue_script('woocommerce');
				wp_dequeue_script( 'prettyPhoto' );
				wp_dequeue_script( 'prettyPhoto-init' );
				//wp_dequeue_script('jquery-blockui');
				wp_dequeue_script( 'jquery-placeholder' );
				wp_dequeue_script( 'fancybox' );
				wp_dequeue_script( 'jqueryui' );
			}
		}
	}

}
/**
 * @Remove Woocommerce Default
 * @Remove Sidebar
 * @Breadcrumb
 *
 */
if ( !function_exists( 'jobcareer_shop_title' ) ) {

	function jobcareer_shop_title() {
		$title = '';
		return $title;
	}

	add_filter( 'woocommerce_show_page_title', 'jobcareer_shop_title' );
}

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );


/**
 * @Define Image Sizes
 *
 */

global $pagenow;

if ( !function_exists( 'jobcareer_woocommerce_image_dimensions' ) ) {

	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
		add_action( 'init', 'jobcareer_woocommerce_image_dimensions', 1 );

	function jobcareer_woocommerce_image_dimensions() {
		$catalog = array(
			'width' => '350', // px
			'height' => '350', // px
			'crop' => 1 // true
		);
		$single = array(
			'width' => '350', // px
			'height' => '350', // px
			'crop' => 1 // true
		);
		$thumbnail = array(
			'width' => '350', // px
			'height' => '350', // px
			'crop' => 1 // false
		);
		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
		update_option( 'shop_single_image_size', $single ); // Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
	}

}


/**
 * @Removing Shop Default Title
 *
 */
if ( !function_exists( 'jobcareer_woocommerce_shop_title' ) ) {

	function jobcareer_woocommerce_shop_title() {
		$jobcareer_shop_title = '';
		return $jobcareer_shop_title;
	}

	add_filter( 'woocommerce_show_page_title', 'jobcareer_woocommerce_shop_title' );
}


/**
 * @Adding Add to Cart
 * @ Custom Text
 *
 */
//remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

if ( !function_exists( 'jobcareer_loop_add_to_cart' ) ) {

	function jobcareer_loop_add_to_cart() {
		global $product;
		echo '<div class="product-action-button">';
		echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="cs-color btn btn-flat button csborder-color add-to-cart-button ajax_add_to_cart %s product_type_%s">%s</a>', esc_url( $product->add_to_cart_url() ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), esc_attr( isset( $quantity ) ? $quantity : 1  ), $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '', esc_attr( $product->product_type ), 'Add to cart' ), $product );
		echo '</div>';
		//echo apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="cs-color btn btn-flat button product_type_simple add_to_cart_button ajax_add_to_cart %s product_type_%s">%s</a>', esc_url($product->add_to_cart_url()), esc_attr($product->id), esc_attr($product->get_sku()), esc_attr(isset($quantity) ? $quantity : 1 ), $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '', esc_attr($product->product_type), ''.esc_html__('Add to cart','jobcareer','jobcareer').''), $product);
	}

}

/**
 * adding flash sale
 * custom text
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

if ( !function_exists( 'jobcareer_sale_flash_icon' ) ) {

	add_filter( 'woocommerce_sale_flash', 'jobcareer_sale_flash_icon', 10, 3 );

	function jobcareer_sale_flash_icon() {
		$icon = '<span class="sale">SALE</span>';
		echo jobcareer_allow_special_char( $icon );
	}

}

/**
 * Product single page
 * customize Title
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 12 );




if ( !function_exists( 'jobcareer_single_product_stock_status' ) ) {

	add_filter( 'woocommerce_single_product_summary', 'jobcareer_single_product_stock_status', 20 );

	function jobcareer_single_product_stock_status() {

		$jobcareer_prod_sale = get_post_meta( get_the_id(), '_stock_status', true );
		if ( $jobcareer_prod_sale == 'instock' ) {
			echo '<span class="stock_wrapper">' . __( 'Availability', 'jobcareer' ) . ': <span class="stock"><b>' . __( 'in stock', 'jobcareer' ) . '</b></span></span>';
		} else {
			echo '<span class="stock_wrapper">' . __( 'Availability', 'jobcareer' ) . ': <span class="stock"><b>' . __( 'out of stock', 'jobcareer' ) . '</b></span></span>';
		}
	}

}


if ( !function_exists( 'jobcareer_single_product_title' ) ) {

	add_filter( 'woocommerce_single_product_summary', 'jobcareer_single_product_title', 10 );

	function jobcareer_single_product_title() {
		$jobcareer_prod_title = get_the_title();
		if ( $jobcareer_prod_title ) {
			echo '<h2>' . get_the_title() . '</h2>';
		}
	}

}





/**
 * @Removing Product Image Dimensions
 *
 */
if ( !function_exists( 'jobcareer_remove_thumbnail_dimensions' ) ) {

	add_filter( 'post_thumbnail_html', 'jobcareer_remove_thumbnail_dimensions', 10, 3 );

	function jobcareer_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		return $html;
	}

}

