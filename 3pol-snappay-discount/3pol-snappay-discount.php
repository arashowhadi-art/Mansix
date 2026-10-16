<?php
/**
 * Plugin Name: 3pol - تغییر خودکار قیمت برای درگاه اسنپ‌پی
 * Description: اگر در پرداخت ووکامرس یکی از درگاه‌های انتخاب‌شده (مثلاً اسنپ‌پی) انتخاب شود، به‌صورت خودکار درصد تعیین‌شده (پیش‌فرض ۱۰٪) به مبلغ سبد خرید اضافه یا از آن کم می‌شود (قابل تنظیم). با انتخاب هر درگاه دیگر، مبلغ سبد خرید بدون تغییر باقی می‌ماند.
 * Version: 1.1.0
 * Requires Plugins: woocommerce
 * Text Domain: 3pol-snappay-discount
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class TPOL_SnappPay_Discount {

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function init() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			add_action( 'admin_notices', array( $this, 'woocommerce_missing_notice' ) );
			return;
		}

		$this->maybe_migrate_single_gateway_option();

		add_filter( 'woocommerce_get_settings_pages', array( $this, 'register_settings_page' ) );
		add_action( 'woocommerce_cart_calculate_fees', array( $this, 'apply_snappay_fee' ) );
	}

	public function woocommerce_missing_notice() {
		echo '<div class="notice notice-error"><p>' .
			esc_html__( 'افزونه «تغییر خودکار قیمت برای درگاه اسنپ‌پی» نیاز به فعال بودن ووکامرس دارد.', '3pol-snappay-discount' ) .
			'</p></div>';
	}

	/**
	 * Earlier versions of this plugin stored a single gateway id in
	 * 'tpol_snappay_gateway_id'. Carry that value forward into the new
	 * multi-gateway option ('tpol_snappay_gateway_ids') the first time this
	 * runs on a site that already had the old option saved.
	 */
	private function maybe_migrate_single_gateway_option() {
		if ( false !== get_option( 'tpol_snappay_gateway_ids', false ) ) {
			return;
		}

		$old_value = get_option( 'tpol_snappay_gateway_id', '' );

		if ( ! empty( $old_value ) ) {
			update_option( 'tpol_snappay_gateway_ids', array( $old_value ) );
		}
	}

	/**
	 * Registers a settings page (WooCommerce > Settings > اسنپ‌پی) via the
	 * standard WC_Settings_Page API so it fits the native WooCommerce admin UI.
	 */
	public function register_settings_page( $settings ) {
		if ( ! class_exists( 'TPOL_SnappPay_Settings_Page' ) ) {
			require_once __DIR__ . '/includes/class-tpol-snappay-settings-page.php';
		}
		$settings[] = new TPOL_SnappPay_Settings_Page();
		return $settings;
	}

	public static function get_settings() {
		$gateway_ids = get_option( 'tpol_snappay_gateway_ids', array( 'snapppay' ) );

		if ( ! is_array( $gateway_ids ) ) {
			$gateway_ids = array_filter( array_map( 'trim', explode( ',', (string) $gateway_ids ) ) );
		}

		return array(
			'enabled'     => get_option( 'tpol_snappay_enabled', 'yes' ),
			'gateway_ids' => $gateway_ids,
			'percent'     => get_option( 'tpol_snappay_percent', '10' ),
			'mode'        => get_option( 'tpol_snappay_mode', 'increase' ),
			'label'       => get_option( 'tpol_snappay_label', __( 'هزینه پرداخت با اسنپ‌پی', '3pol-snappay-discount' ) ),
		);
	}

	/**
	 * Reads the payment gateway currently selected on checkout. WooCommerce
	 * itself stores the radio-button selection in the session (from the
	 * posted checkout form) before this fee hook runs, so we read it
	 * directly here.
	 *
	 * Deliberately does NOT call get_available_payment_gateways() to
	 * validate the value: that method calls is_available() on every
	 * registered gateway, and some payment gateway plugins (SnapPay's
	 * included) perform a live network/API call inside is_available().
	 * Doing that on every single cart/fee recalculation caused repeated
	 * outbound requests and 503 timeouts on checkout.
	 */
	private function get_chosen_payment_method() {
		if ( ! WC()->session ) {
			return '';
		}

		return (string) WC()->session->get( 'chosen_payment_method' );
	}

	public function apply_snappay_fee( $cart ) {
		// Avoid running in wp-admin (except for the AJAX calls WooCommerce itself makes on checkout).
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			return;
		}

		$settings = self::get_settings();

		if ( 'yes' !== $settings['enabled'] ) {
			return;
		}

		$gateway_ids = array_filter( array_map( 'trim', $settings['gateway_ids'] ) );
		$percent     = floatval( $settings['percent'] );

		if ( empty( $gateway_ids ) || $percent <= 0 ) {
			return;
		}

		$chosen_gateway = $this->get_chosen_payment_method();

		if ( '' === $chosen_gateway || ! in_array( $chosen_gateway, $gateway_ids, true ) ) {
			return;
		}

		$cart_subtotal = (float) $cart->get_subtotal();

		if ( $cart_subtotal <= 0 ) {
			return;
		}

		$amount = round( $cart_subtotal * ( $percent / 100 ), 2 );

		if ( $amount <= 0 ) {
			return;
		}

		/**
		 * Allow developers to fine-tune the fee amount programmatically.
		 *
		 * @param float   $amount  Calculated fee amount (positive number).
		 * @param float   $percent Percentage from settings.
		 * @param WC_Cart $cart    Current cart object.
		 */
		$amount = apply_filters( 'tpol_snappay_fee_amount', $amount, $percent, $cart );

		// 'increase' adds a surcharge (positive fee), 'decrease' applies a discount (negative fee).
		$sign = ( 'decrease' === $settings['mode'] ) ? -1 : 1;

		$cart->add_fee( $settings['label'], $sign * $amount, false );
	}
}

new TPOL_SnappPay_Discount();
