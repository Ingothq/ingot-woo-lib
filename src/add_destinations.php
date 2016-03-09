<?php
/**
 * Add Woo conversion destination tracking
 *
 * @package   ingot-woo-lib
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2016 Josh Pollock for Ingot LLC
 */


namespace ingot\addon\woo;


use ingot\testing\types;

class add_destinations {
	/**
	 * Add hooks
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'ingot_allowed_destination_types', [ $this, 'destination_types' ] );
		add_filter( 'ingot_allowed_click_types', [ $this, 'allow_destination' ] );
	}

	/**
	 * Add woo type destination tests
	 *
	 * @since 1.0.0
	 *
	 * @uses "ingot_allowed_click_types" filter
	 *
	 * @param $types
	 *
	 * @return array
	 */
	public function destination_types( $types ){

		return array_merge( $types, [
				'cart_woo' => [
					'name'        => __( 'Add To Cart -- WooCommerce', 'ingot' ),
					'description' => __( 'Conversion is registered when an item is added to the WooCommerce cart.', 'ingot' ),
				],
				'sale_woo' => [
					'name'        => __( 'Purchase -- WooCommerce', 'ingot' ),
					'description' => __( 'Conversion is registered when a WooCommerce sale is completed.', 'ingot' ),
				]
			]
		);

	}

	/**
	 * Add destination testing if not already added
	 *
	 * @since 1.0.0
	 *
	 * @uses "ingot_allowed_click_types" filter
	 *
	 * @param $types
	 *
	 * @return array
	 */
	public function allow_destination( $types ){
		if( ! isset( $types[ 'destination' ] ) ){
			$types = array_merge( $types, types::destination_definition() );
		}

		return $types;
	}

}
