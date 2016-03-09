<?php
/**
 * Track Woo conversion events
 *
 * @package   ingot-woo-lib
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2016 Josh Pollock for Ingot LLC
 */

namespace ingot\addon\woo;


use ingot\testing\tests\click\destination\hooks;

class tracking {

	/**
	 * Add the tracking hooks
	 *
	 * @since 1.1.0
	 */
	public function __construct(){
		add_action( 'woocommerce_add_to_cart', [ $this, 'add_to_cart' ] );
		add_action( 'woocommerce_payment_complete_order_status', [ $this, 'purchase' ] );
	}

	/**
	 * Track conversions when Woo product added to cart
	 *
	 * @since 1.1.0
	 *
	 * @uses "woocommerce_add_to_cart"
	 */
	public function add_to_cart(){
		hooks::get_instance([])->check_if_victory( 'woo_cart' );
	}

	/**
	 * Track conversions when Woo product is purchased
	 *
	 * @since 1.1.0
	 *
	 * @uses "woocommerce_payment_complete_order_status"
	 */
	public function purchase(){
		hooks::get_instance( [] )->check_if_victory( 'woo_sale' );
	}

}
