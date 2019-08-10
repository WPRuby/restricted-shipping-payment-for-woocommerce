<?php // phpcs:ignorefile
/**
 * PHPUnit bootstrap file
 *
 * @package Woocommerce_Restricted_Shipping_And_Payment_Pro
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( ! $_tests_dir ) {
	$_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}

if ( ! file_exists( $_tests_dir . '/includes/functions.php' ) ) {
	echo "Could not find $_tests_dir/includes/functions.php, have you run bin/install-wp-tests.sh ?" . PHP_EOL; // WPCS: XSS ok.
	exit( 1 );
}

require_once 'helpers/class-rspw-tests-helper.php';

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
	$_core_dir = getenv( 'WP_CORE_DIR' );
	require $_core_dir . '/wp-content/plugins/woocommerce/woocommerce.php';
	require dirname( dirname( __FILE__ ) ) . '/restricted-shipping-payment-for-woocommerce.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
