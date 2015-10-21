<?php

class Woocommerce_Daily_Coupons_Public {

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
	 * Full version of the days of the week
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $days    Full version of the days of the week
	 */
	private $days = array(
		'Mon' => 'Monday',
		'Tue' => 'Tuesday',
		'Wed' => 'Wednesday',
		'Thu' => 'Thursday',
		'Fri' => 'Friday',
		'Sat' => 'Saturday',
		'Sun' => 'Sunday'
	);

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
	 * Checks if the supplied coupon can be used or not.
	 *
	 * @since  1.0.0
	 * @param  bool 	    $valid      The current coupon validity
	 * @param  WC_Coupon 	$coupon 	Current coupon instance
	 * @return bool              	    If the coupon can be used
	 */
	public function check_daily_coupon_valid( $valid, $coupon ) {

		$day = ( new Datetime() )->format('D');

	    $allowed = ( isset($coupon->daily_coupon) && !empty($coupon->daily_coupon) ) ? explode( ',', $coupon->daily_coupon ) : array();

	    if ( empty($allowed) )
	    	return TRUE;

	    if ( in_array($day, $allowed) )
	    	return TRUE;
	    else {
	    	$msg = __('This coupon can only used on the following days: ');
	    	$allowedDays = array();

	    	foreach ( $allowed as $allowedDay )
	    		$allowedDays[] = __($this->days[ $allowedDay ]);

	    	$msg .= implode(',', $allowedDays) . '.';

	    	wc_add_notice( $msg, 'error' );
	    	return FALSE;
	    }

	}

}