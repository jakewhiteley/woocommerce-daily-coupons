<?php

/**
 * 
 */
class Woocommerce_Daily_Coupons_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name	   The name of this plugin.
	 * @param    string    $version        The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Prints the daily coupons checkboxes
	 */
	public function add_daily_coupons_fields() {

		global $post;
		
		$rawValues = get_post_meta( $post->ID, 'daily_coupon', true );
		$values = empty($rawValues) ? array() : explode( ',', $rawValues );
		$days = array( 'Monday', 'Tuesday', 'Wednesday', 'Thusday', 'Friday', 'Saturday', 'Sunday' );

		echo '<h3>' .  __( 'Only allow this coupon to be used on the following days:', $this->plugin_name) . '</h3>';
		echo '<p><i>If left blank, the coupon will work as normal.</i></p>';

		foreach ( $days as $day ) 
		{
			$minDay = substr( $day, 0, 3 );
			woocommerce_wp_checkbox( array( 
				'id'      => 'daily_coupon_' . $day, 
				'label'   => __( $day, $this->plugin_name ), 
				'name' 	  => __( 'daily_coupon[]', $this->plugin_name ),
				'cbvalue' => $minDay,
				'value'   => in_array( $minDay, $values ) ? $minDay : ''
				) 
			);
		}

	}

	/**
	 * Saves the daily coupon custom field value to post meta
	 * 
	 * @param  int    $post_id    The current post ID
	 */
	public function save_daily_coupon_fields( $post_id ) {

		$coupons =  isset( $_POST['daily_coupon'] ) ? implode( ',', $_POST['daily_coupon'] ) : '';
		update_post_meta( $post_id, 'daily_coupon', $coupons );

	}

	/**
	 * Ensures the daily_coupon value is added to an instance of WC_Coupon
	 * 
	 * @param WC_Coupon $coupon Couon instance
	 */
	public function add_daily_coupon_meta( $coupon ) {
		$coupon->daily_coupon = get_post_meta( $coupon->id, 'daily_coupon', true );
	}

}