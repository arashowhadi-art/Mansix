<?php
/**
 * Plugin Name: افزودن گزینه درج نام (تابلو)
 * Description: افزودن سه گزینه «نام با ورق طلا»، «نام با پلاک طلا» و «بدون نام» به صفحه محصولات یک دسته‌بندی خاص از ووکامرس، همراه با افزایش قیمت متناظر.
 * Version:     1.0.0
 * Author:      Mansix
 * Text Domain: mansix-name-options
 * Requires Plugins: woocommerce
 */

if (!defined('ABSPATH')) {
    exit;
}

final class Mansix_Name_Options
{
    const TEXT_DOMAIN = 'mansix-name-options';

    public static function init()
    {
        add_action('plugins_loaded', array(__CLASS__, 'bootstrap'));
    }

    public static function bootstrap()
    {
        if (!class_exists('WooCommerce')) {
            add_action('admin_notices', array(__CLASS__, 'missing_woocommerce_notice'));
            return;
        }

        add_action('woocommerce_before_add_to_cart_button', array(__CLASS__, 'render_fields'), 25);
        add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_assets'), 20);
        add_filter('woocommerce_add_to_cart_validation', array(__CLASS__, 'validate_selection'), 10, 3);
        add_filter('woocommerce_add_cart_item_data', array(__CLASS__, 'add_cart_item_data'), 10, 2);
        add_action('woocommerce_before_calculate_totals', array(__CLASS__, 'adjust_price'), 20);
        add_filter('woocommerce_get_item_data', array(__CLASS__, 'display_cart_item_data'), 10, 2);
        add_action('woocommerce_checkout_create_order_line_item', array(__CLASS__, 'save_order_item_meta'), 10, 4);
    }

    public static function missing_woocommerce_notice()
    {
        echo '<div class="notice notice-error"><p>';
        echo esc_html__('افزونه «گزینه درج نام» نیازمند فعال‌بودن ووکامرس است.', self::TEXT_DOMAIN);
        echo '</p></div>';
    }

    /**
     * Target product category. Filterable via 'mansix_name_option_category'.
     */
    public static function category_identifier()
    {
        return apply_filters('mansix_name_option_category', 'تابلو');
    }

    /**
     * Resolve the term (slug first, then percent-encoded slug, then name)
     * since Persian slugs are sometimes stored percent-encoded in WordPress.
     */
    public static function get_category_term()
    {
        static $term = false;

        if (false !== $term) {
            return $term;
        }

        $identifier = self::category_identifier();

        $term = get_term_by('slug', $identifier, 'product_cat');

        if (!$term) {
            $term = get_term_by('slug', rawurlencode($identifier), 'product_cat');
        }

        if (!$term) {
            $term = get_term_by('name', $identifier, 'product_cat');
        }

        return $term ?: null;
    }

    public static function product_in_category($product_id)
    {
        $term = self::get_category_term();

        if (!$term || !$product_id) {
            return false;
        }

        return has_term($term->term_id, 'product_cat', $product_id);
    }

    /**
     * The three available options and their extra price (تومان).
     * Filterable via 'mansix_name_options'.
     */
    public static function options()
    {
        return apply_filters('mansix_name_options', array(
            'gold_foil' => array(
                'label' => __('نام با ورق طلا', self::TEXT_DOMAIN),
                'price' => 250000,
            ),
            'gold_plaque' => array(
                'label' => __('نام با پلاک طلا', self::TEXT_DOMAIN),
                'price' => 150000,
            ),
            'none' => array(
                'label' => __('بدون نام', self::TEXT_DOMAIN),
                'price' => 0,
            ),
        ));
    }

    public static function render_fields()
    {
        global $product;

        if (!$product instanceof WC_Product || !self::product_in_category($product->get_id())) {
            return;
        }

        $options  = self::options();
        $selected = isset($_POST['mansix_name_option']) ? sanitize_text_field(wp_unslash($_POST['mansix_name_option'])) : 'none';

        if (!array_key_exists($selected, $options)) {
            $selected = 'none';
        }
        ?>
        <div class="mansix-name-options">
            <p class="mansix-name-options__title"><strong><?php esc_html_e('گزینه درج نام:', self::TEXT_DOMAIN); ?></strong></p>
            <?php foreach ($options as $key => $option) : ?>
                <label class="mansix-name-options__option">
                    <input type="radio" name="mansix_name_option" value="<?php echo esc_attr($key); ?>" <?php checked($key, $selected); ?> />
                    <span>
                        <?php echo esc_html($option['label']); ?>
                        <?php if ($option['price'] > 0) : ?>
                            (<?php echo esc_html(sprintf(__('%s تومان اضافه می‌شود', self::TEXT_DOMAIN), number_format_i18n($option['price']))); ?>)
                        <?php endif; ?>
                    </span>
                </label>
            <?php endforeach; ?>
            <p class="mansix-name-options__note"><?php esc_html_e('در صورت انتخاب درج نام یا متن، لطفاً متن موردنظر را به‌طور کامل در بخش توضیحات سفارش وارد نمایید.', self::TEXT_DOMAIN); ?></p>
        </div>
        <?php
    }

    public static function enqueue_assets()
    {
        if (!function_exists('is_product') || !is_product() || !self::product_in_category(get_queried_object_id())) {
            return;
        }

        $css = '
.mansix-name-options{margin:15px 0;padding:15px;border:1px solid #e0e0e0;border-radius:6px;background:#fafafa}
.mansix-name-options__title{margin:0 0 10px}
.mansix-name-options__option{display:flex;align-items:center;gap:8px;margin-bottom:8px;cursor:pointer;font-weight:normal}
.mansix-name-options__option input{margin:0}
.mansix-name-options__note{margin:10px 0 0;font-size:13px;color:#c0392b}
';

        wp_register_style('mansix-name-options', false, array(), '1.0.0');
        wp_enqueue_style('mansix-name-options');
        wp_add_inline_style('mansix-name-options', $css);
    }

    public static function validate_selection($passed, $product_id, $quantity)
    {
        if (!self::product_in_category($product_id)) {
            return $passed;
        }

        $options  = self::options();
        $selected = isset($_POST['mansix_name_option']) ? sanitize_text_field(wp_unslash($_POST['mansix_name_option'])) : '';

        if (!array_key_exists($selected, $options)) {
            wc_add_notice(__('لطفاً یکی از گزینه‌های درج نام را انتخاب کنید.', self::TEXT_DOMAIN), 'error');
            return false;
        }

        return $passed;
    }

    public static function add_cart_item_data($cart_item_data, $product_id)
    {
        if (!self::product_in_category($product_id)) {
            return $cart_item_data;
        }

        $options  = self::options();
        $selected = isset($_POST['mansix_name_option']) ? sanitize_text_field(wp_unslash($_POST['mansix_name_option'])) : 'none';

        if (!array_key_exists($selected, $options)) {
            $selected = 'none';
        }

        $cart_item_data['mansix_name_option'] = $selected;

        return $cart_item_data;
    }

    public static function adjust_price($cart)
    {
        if (is_admin() && !defined('DOING_AJAX')) {
            return;
        }

        $options = self::options();

        foreach ($cart->get_cart() as $cart_item) {
            if (empty($cart_item['mansix_name_option']) || empty($options[$cart_item['mansix_name_option']]['price'])) {
                continue;
            }

            $product_id    = $cart_item['variation_id'] ? $cart_item['variation_id'] : $cart_item['product_id'];
            $fresh_product = wc_get_product($product_id);

            if (!$fresh_product) {
                continue;
            }

            $base_price = (float) $fresh_product->get_price('edit');
            $cart_item['data']->set_price($base_price + $options[$cart_item['mansix_name_option']]['price']);
        }
    }

    public static function format_value($selected)
    {
        $options = self::options();

        if (!isset($options[$selected])) {
            return '';
        }

        $value = $options[$selected]['label'];

        if ($options[$selected]['price'] > 0) {
            $value .= ' (+' . number_format_i18n($options[$selected]['price']) . ' ' . __('تومان', self::TEXT_DOMAIN) . ')';
        }

        return $value;
    }

    public static function display_cart_item_data($item_data, $cart_item)
    {
        if (empty($cart_item['mansix_name_option'])) {
            return $item_data;
        }

        $value = self::format_value($cart_item['mansix_name_option']);

        if ('' === $value) {
            return $item_data;
        }

        $item_data[] = array(
            'key'   => __('گزینه درج نام', self::TEXT_DOMAIN),
            'value' => $value,
        );

        return $item_data;
    }

    public static function save_order_item_meta($item, $cart_item_key, $values, $order)
    {
        if (empty($values['mansix_name_option'])) {
            return;
        }

        $value = self::format_value($values['mansix_name_option']);

        if ('' === $value) {
            return;
        }

        $item->add_meta_data(__('گزینه درج نام', self::TEXT_DOMAIN), $value, true);
    }
}

Mansix_Name_Options::init();
