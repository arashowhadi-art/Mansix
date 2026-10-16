<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WC_Settings_Page' ) ) {
	return;
}

/**
 * Adds a "اسنپ‌پی" tab under WooCommerce > Settings where the store owner
 * picks one or more payment gateways (e.g. SnapPay), whether to increase or
 * decrease the cart total when one of them is chosen at checkout, and the
 * percentage to apply.
 */
class TPOL_SnappPay_Settings_Page extends WC_Settings_Page {

	public function __construct() {
		$this->id    = 'tpol_snappay_discount';
		$this->label = __( 'اسنپ‌پی', '3pol-snappay-discount' );

		parent::__construct();
	}

	public function get_settings( $current_section = '' ) {
		$gateways      = WC()->payment_gateways() ? WC()->payment_gateways()->payment_gateways() : array();
		$gateway_options = array();
		foreach ( $gateways as $gateway ) {
			$gateway_options[ $gateway->id ] = sprintf( '%s (id: %s)', $gateway->get_method_title(), $gateway->id );
		}

		return array(
			array(
				'title' => __( 'تغییر خودکار قیمت برای درگاه(های) پرداخت', '3pol-snappay-discount' ),
				'type'  => 'title',
				'desc'  => __( 'وقتی مشتری در پرداخت ووکامرس یکی از درگاه‌های انتخاب‌شده در پایین (مثلاً اسنپ‌پی) را انتخاب کند، درصد زیر به‌طور خودکار به مبلغ سبد خرید اضافه یا از آن کم می‌شود. با انتخاب هر درگاه دیگری، مبلغ سبد خرید بدون تغییر باقی می‌ماند.', '3pol-snappay-discount' ),
				'id'    => 'tpol_snappay_options',
			),
			array(
				'title'   => __( 'فعال‌سازی', '3pol-snappay-discount' ),
				'id'      => 'tpol_snappay_enabled',
				'type'    => 'checkbox',
				'default' => 'yes',
			),
			array(
				'title'             => __( 'درگاه‌های پرداخت', '3pol-snappay-discount' ),
				'id'                => 'tpol_snappay_gateway_ids',
				'type'              => 'multiselect',
				'class'             => 'wc-enhanced-select',
				'css'               => 'min-width: 400px;',
				'default'           => array( 'snapppay' ),
				'options'           => $gateway_options,
				'desc_tip'          => __( 'یک یا چند درگاه را انتخاب کنید. با انتخاب هر کدام از این درگاه‌ها در صفحه پرداخت، درصد تنظیم‌شده اعمال می‌شود.', '3pol-snappay-discount' ),
				'custom_attributes' => array(
					'data-placeholder' => __( 'درگاه(های) مورد نظر را انتخاب کنید', '3pol-snappay-discount' ),
				),
			),
			array(
				'title'   => __( 'نوع تغییر قیمت', '3pol-snappay-discount' ),
				'id'      => 'tpol_snappay_mode',
				'type'    => 'select',
				'default' => 'increase',
				'options' => array(
					'increase' => __( 'افزایش قیمت (اضافه کردن درصد)', '3pol-snappay-discount' ),
					'decrease' => __( 'تخفیف (کم کردن درصد)', '3pol-snappay-discount' ),
				),
				'desc'    => __( 'مشخص می‌کند درصد وارد شده به مبلغ سبد خرید اضافه شود یا از آن کم شود.', '3pol-snappay-discount' ),
			),
			array(
				'title'             => __( 'درصد', '3pol-snappay-discount' ),
				'id'                => 'tpol_snappay_percent',
				'type'              => 'number',
				'default'           => '10',
				'custom_attributes' => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '0.01',
				),
				'desc'              => __( 'درصدی از مبلغ سبد خرید که هنگام انتخاب یکی از درگاه‌های بالا اضافه یا کم می‌شود.', '3pol-snappay-discount' ),
			),
			array(
				'title'   => __( 'عنوان نمایشی', '3pol-snappay-discount' ),
				'id'      => 'tpol_snappay_label',
				'type'    => 'text',
				'default' => __( 'هزینه پرداخت با اسنپ‌پی', '3pol-snappay-discount' ),
				'desc'    => __( 'این متن در صفحه پرداخت به‌عنوان ردیف تغییر قیمت به مشتری نمایش داده می‌شود.', '3pol-snappay-discount' ),
			),
			array(
				'type' => 'sectionend',
				'id'   => 'tpol_snappay_options',
			),
		);
	}
}
