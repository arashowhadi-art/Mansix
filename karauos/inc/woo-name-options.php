<?php
/**
 * Product name-engraving options for a single WooCommerce category
 * (کتگوری «تابلو»): نام با ورق طلا / نام با پلاک طلا / بدون نام.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!woo) {
    return;
}

/**
 * The product category this feature is limited to.
 * Filterable in case the term slug/name differs on other environments.
 */
function karauos_name_option_category_identifier()
{
    return apply_filters('karauos_name_option_category', 'تابلو');
}

/**
 * Resolve the target category term (matched by slug first, then by name,
 * since Persian slugs are sometimes stored percent-encoded).
 */
function karauos_get_name_option_category_term()
{
    static $term = false;

    if (false !== $term) {
        return $term;
    }

    $identifier = karauos_name_option_category_identifier();

    $term = get_term_by('slug', $identifier, 'product_cat');

    if (!$term) {
        $term = get_term_by('slug', rawurlencode($identifier), 'product_cat');
    }

    if (!$term) {
        $term = get_term_by('name', $identifier, 'product_cat');
    }

    return $term ?: null;
}

function karauos_product_has_name_option_category($product_id)
{
    $term = karauos_get_name_option_category_term();

    if (!$term || !$product_id) {
        return false;
    }

    return has_term($term->term_id, 'product_cat', $product_id);
}

/**
 * The three available options and their extra price (تومان).
 */
function karauos_get_name_options()
{
    return apply_filters('karauos_name_options', array(
        'gold_foil' => array(
            'label' => __('نام با ورق طلا', text_domain),
            'price' => 250000,
        ),
        'gold_plaque' => array(
            'label' => __('نام با پلاک طلا', text_domain),
            'price' => 150000,
        ),
        'none' => array(
            'label' => __('بدون نام', text_domain),
            'price' => 0,
        ),
    ));
}

/**
 * Render the radio options on the single product add-to-cart form.
 */
add_action('woocommerce_before_add_to_cart_button', 'karauos_render_name_option_fields', 25);
function karauos_render_name_option_fields()
{
    global $product;

    if (!$product instanceof WC_Product || !karauos_product_has_name_option_category($product->get_id())) {
        return;
    }

    $options  = karauos_get_name_options();
    $selected = isset($_POST['karauos_name_option']) ? sanitize_text_field(wp_unslash($_POST['karauos_name_option'])) : 'none';

    if (!array_key_exists($selected, $options)) {
        $selected = 'none';
    }
    ?>
    <div class="karauos-name-options">
        <p class="karauos-name-options__title"><strong><?php esc_html_e('گزینه درج نام:', text_domain); ?></strong></p>
        <?php foreach ($options as $key => $option) : ?>
            <label class="karauos-name-options__option">
                <input type="radio" name="karauos_name_option" value="<?php echo esc_attr($key); ?>" <?php checked($key, $selected); ?> />
                <span>
                    <?php echo esc_html($option['label']); ?>
                    <?php if ($option['price'] > 0) : ?>
                        (<?php echo esc_html(sprintf(__('%s تومان اضافه می‌شود', text_domain), number_format_i18n($option['price']))); ?>)
                    <?php endif; ?>
                </span>
            </label>
        <?php endforeach; ?>
        <p class="karauos-name-options__note"><?php esc_html_e('در صورت انتخاب درج نام یا متن، لطفاً متن موردنظر را به‌طور کامل در بخش توضیحات سفارش وارد نمایید.', text_domain); ?></p>
    </div>
    <?php
}

/**
 * Minimal inline styling, only loaded on product pages within the category.
 */
add_action('wp_enqueue_scripts', 'karauos_name_options_assets', 20);
function karauos_name_options_assets()
{
    if (!is_product() || !karauos_product_has_name_option_category(get_queried_object_id())) {
        return;
    }

    $css = '
.karauos-name-options{margin:15px 0;padding:15px;border:1px solid #e0e0e0;border-radius:6px;background:#fafafa}
.karauos-name-options__title{margin:0 0 10px}
.karauos-name-options__option{display:flex;align-items:center;gap:8px;margin-bottom:8px;cursor:pointer;font-weight:normal}
.karauos-name-options__option input{margin:0}
.karauos-name-options__note{margin:10px 0 0;font-size:13px;color:#c0392b}
';

    wp_add_inline_style('karauos-style', $css);
}

/**
 * Require a valid option to be selected for products in the category.
 */
add_filter('woocommerce_add_to_cart_validation', 'karauos_validate_name_option', 10, 3);
function karauos_validate_name_option($passed, $product_id, $quantity)
{
    if (!karauos_product_has_name_option_category($product_id)) {
        return $passed;
    }

    $options  = karauos_get_name_options();
    $selected = isset($_POST['karauos_name_option']) ? sanitize_text_field(wp_unslash($_POST['karauos_name_option'])) : '';

    if (!array_key_exists($selected, $options)) {
        wc_add_notice(__('لطفاً یکی از گزینه‌های درج نام را انتخاب کنید.', text_domain), 'error');
        return false;
    }

    return $passed;
}

/**
 * Store the selected option on the cart item.
 */
add_filter('woocommerce_add_cart_item_data', 'karauos_add_name_option_cart_item_data', 10, 2);
function karauos_add_name_option_cart_item_data($cart_item_data, $product_id)
{
    if (!karauos_product_has_name_option_category($product_id)) {
        return $cart_item_data;
    }

    $options  = karauos_get_name_options();
    $selected = isset($_POST['karauos_name_option']) ? sanitize_text_field(wp_unslash($_POST['karauos_name_option'])) : 'none';

    if (!array_key_exists($selected, $options)) {
        $selected = 'none';
    }

    $cart_item_data['karauos_name_option'] = $selected;

    return $cart_item_data;
}

/**
 * Add the option's extra price on top of the product's own price.
 */
add_action('woocommerce_before_calculate_totals', 'karauos_adjust_name_option_price', 20);
function karauos_adjust_name_option_price($cart)
{
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    $options = karauos_get_name_options();

    foreach ($cart->get_cart() as $cart_item) {
        if (empty($cart_item['karauos_name_option']) || empty($options[$cart_item['karauos_name_option']]['price'])) {
            continue;
        }

        $product_id     = $cart_item['variation_id'] ? $cart_item['variation_id'] : $cart_item['product_id'];
        $fresh_product  = wc_get_product($product_id);

        if (!$fresh_product) {
            continue;
        }

        $base_price = (float) $fresh_product->get_price('edit');
        $cart_item['data']->set_price($base_price + $options[$cart_item['karauos_name_option']]['price']);
    }
}

function karauos_format_name_option_value($selected)
{
    $options = karauos_get_name_options();

    if (!isset($options[$selected])) {
        return '';
    }

    $value = $options[$selected]['label'];

    if ($options[$selected]['price'] > 0) {
        $value .= ' (+' . number_format_i18n($options[$selected]['price']) . ' ' . __('تومان', text_domain) . ')';
    }

    return $value;
}

/**
 * Show the selection in the cart, mini-cart and checkout review.
 */
add_filter('woocommerce_get_item_data', 'karauos_display_name_option_cart_item', 10, 2);
function karauos_display_name_option_cart_item($item_data, $cart_item)
{
    if (empty($cart_item['karauos_name_option'])) {
        return $item_data;
    }

    $value = karauos_format_name_option_value($cart_item['karauos_name_option']);

    if ('' === $value) {
        return $item_data;
    }

    $item_data[] = array(
        'key'   => __('گزینه درج نام', text_domain),
        'value' => $value,
    );

    return $item_data;
}

/**
 * Persist the selection on the order line item (admin + emails).
 */
add_action('woocommerce_checkout_create_order_line_item', 'karauos_save_name_option_order_item_meta', 10, 4);
function karauos_save_name_option_order_item_meta($item, $cart_item_key, $values, $order)
{
    if (empty($values['karauos_name_option'])) {
        return;
    }

    $value = karauos_format_name_option_value($values['karauos_name_option']);

    if ('' === $value) {
        return;
    }

    $item->add_meta_data(__('گزینه درج نام', text_domain), $value, true);
}
