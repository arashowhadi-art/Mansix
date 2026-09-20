<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TMT_Product_Meta extends Widget_Base {

	public function get_name() {
		return 'woocommerce-product-meta';
	}

	public function get_title() {
		return __( 'Product Meta', text_domain );
	}

	public function get_icon() {
		return 'eicon-product-meta';
	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'meta', 'data', 'product' ];
	}

	public function get_categories() {
		return [ 'shop_karauos' ];
    }

	protected function _register_controls() {

		$this->start_controls_section('section_product_meta_content',['label' => __( 'Content', text_domain )]);
		$this->add_control(
			'show_sku',
			[
				'label' => __( 'Show SKU', text_domain ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_category',
			[
				'label' => __( 'Show Category', text_domain ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_tag',
			[
				'label' => __( 'Show Tag', text_domain ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'heading_category_caption',
			[
				'label' => __( 'Category', text_domain ),
				'type' => Controls_Manager::HEADING,
				'condition'   => [
                    'show_category'	=> 'yes',
                ],
			]
		);

		$this->add_control(
			'category_caption_single',
			[
				'label' => __( 'Singular', text_domain ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Category', text_domain ),
				'condition'   => [
                    'show_category'	=> 'yes',
                ],
			]
		);

		$this->add_control(
			'category_caption_plural',
			[
				'label' => __( 'Plural', text_domain ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Categories', text_domain ),
				'condition'   => [
                    'show_category'	=> 'yes',
                ],
			]
		);

		$this->add_control(
			'heading_tag_caption',
			[
				'label' => __( 'Tag', text_domain ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'   => [
                    'show_tag'	=> 'yes',
                ],
			]
		);

		$this->add_control(
			'tag_caption_single',
			[
				'label' => __( 'Singular', text_domain ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Tag', text_domain ),
				'condition'   => [
                    'show_tag'	=> 'yes',
                ],
			]
		);

		$this->add_control(
			'tag_caption_plural',
			[
				'label' => __( 'Plural', text_domain ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Tags', text_domain ),
				'condition'   => [
                    'show_tag'	=> 'yes',
                ],
			]
		);

		$this->add_control(
			'heading_sku_caption',
			[
				'label' => __( 'SKU', text_domain ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'   => [
                    'show_sku'	=> 'yes',
                ],
			]
		);

		$this->add_control(
			'sku_caption',
			[
				'label' => __( 'SKU', text_domain ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'SKU', text_domain ),
				'condition'   => [
                    'show_sku'	=> 'yes',
                ],
			]
		);

		$this->add_control(
			'sku_missing_caption',
			[
				'label' => __( 'Missing', text_domain ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'N/A', text_domain ),
				'condition'   => [
                    'show_sku'	=> 'yes',
                ],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_product_meta_style',
			[
				'label' => __( 'Style', text_domain ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', text_domain ),
				'type' => Controls_Manager::SELECT,
				'default' => 'flex-column',
				'options' => [
					'flex-column' => __( 'Vertical', text_domain ),
					'justify-content-between' => __( 'Horizontal', text_domain ),
				],
			]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', text_domain ),
                'selector' => '{{WRAPPER}} .product_meta > span',
            ]
        );
		$this->add_control(
            'padding',
            [
                'label'      => esc_html__( 'Padding', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top' => '10',
                    'right' => '0',
                    'bottom' => '10',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .product_meta > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'margin',
            [
                'label'      => esc_html__( 'Margin', text_domain ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .product_meta > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
		);

		$this->add_control(
			'heading_text_style',
			[
				'label' => __( 'Text', text_domain ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} span',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_link_style',
			[
				'label' => __( 'Link', text_domain ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'selector' => '{{WRAPPER}} a',
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => __( 'Color', text_domain ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	private function get_plural_or_single( $single, $plural, $count ) {
		return 1 === $count ? $single : $plural;
	}

	protected function render() {

		$settings = $this->get_settings();
		
		$view = $settings['view'];

		global $product;

		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		$settings = $this->get_settings_for_display();
		?>
		<div class="product_meta flex <?php echo $view; ?>">

			<?php do_action( 'woocommerce_product_meta_start' );
			if($settings['show_sku'] == 'yes') {
				$sku = $product->get_sku();
				$sku_caption = ! empty( $settings['sku_caption'] ) ? $settings['sku_caption'] : __( 'SKU', text_domain );
				$sku_missing = ! empty( $settings['sku_missing_caption'] ) ? $settings['sku_missing_caption'] : __( 'N/A', text_domain );
				if ( wc_product_sku_enabled() && ( $sku || $product->is_type( 'variable' ) ) ) : ?>
					<span class="sku_wrapper detail-container"><span class="detail-label"><?php echo esc_html( $sku_caption ); ?></span> <span class="sku"><?php echo $sku ? $sku : esc_html( $sku_missing ); ?></span></span>
				<?php endif;
			}
			if($settings['show_category'] == 'yes') {
				$category_caption_single = ! empty( $settings['category_caption_single'] ) ? $settings['category_caption_single'] : __( 'Category', text_domain );
				$category_caption_plural = ! empty( $settings['category_caption_plural'] ) ? $settings['category_caption_plural'] : __( 'Categories', text_domain );
				if ( count( $product->get_category_ids() ) ) : ?>
					<span class="posted_in detail-container"><span class="detail-label"><?php echo esc_html( $this->get_plural_or_single( $category_caption_single, $category_caption_plural, count( $product->get_category_ids() ) ) ); ?></span> : <span class="detail-content"><?php echo get_the_term_list( $product->get_id(), 'product_cat', '', ', ' ); ?></span></span>
				<?php endif;
			}

			if($settings['show_tag'] == 'yes') {
				$tag_caption_single = ! empty( $settings['tag_caption_single'] ) ? $settings['tag_caption_single'] : __( 'Tag', text_domain );
				$tag_caption_plural = ! empty( $settings['tag_caption_plural'] ) ? $settings['tag_caption_plural'] : __( 'Tags', text_domain );
				if ( count( $product->get_tag_ids() ) ) : ?>
					<span class="tagged_as detail-container"><span class="detail-label"><?php echo esc_html( $this->get_plural_or_single( $tag_caption_single, $tag_caption_plural, count( $product->get_tag_ids() ) ) ); ?></span> : <span class="detail-content"><?php echo get_the_term_list( $product->get_id(), 'product_tag', '', ', ' ); ?></span></span>
				<?php endif;
			}

			do_action( 'woocommerce_product_meta_end' ); ?>

		</div>
		<?php
	}

}
Plugin::instance()->widgets_manager->register_widget_type( new TMT_Product_Meta );