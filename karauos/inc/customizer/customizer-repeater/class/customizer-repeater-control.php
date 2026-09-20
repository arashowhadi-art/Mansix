<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class Customizer_Repeater extends WP_Customize_Control {

	public $id;
	private $boxtitle = array();
	private $add_field_label = array();
	private $customizer_icon_container = '';
	private $allowed_html = array();
	
	public $customizer_repeater_font_weight_control = true;
	public $customizer_repeater_EOT_control = true;
	public $customizer_repeater_TTF_control = true;
	public $customizer_repeater_WOFF_control = true;
	public $customizer_repeater_WOFF2_control = true;
	public $customizer_repeater_SVG_control = true;


	/*Class constructor*/
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		/*Get options from customizer.php*/
		$this->add_field_label = esc_html__( 'Add Font Weight', text_domain );
		if ( ! empty( $args['add_field_label'] ) ) {
			$this->add_field_label = $args['add_field_label'];
		}

		$this->add_field_description = esc_html__( 'Add Font Weight', text_domain );
		if ( ! empty( $args['add_field_description'] ) ) {
			$this->add_field_description = $args['add_field_description'];
		}

		$this->boxtitle = esc_html__( 'Customizer Font', text_domain );
		if ( ! empty ( $args['item_name'] ) ) {
			$this->boxtitle = $args['item_name'];
		} elseif ( ! empty( $this->label ) ) {
			$this->boxtitle = $this->label;
		}

		if ( ! empty( $args['customizer_repeater_font_weight_control'] ) ) {
			$this->customizer_repeater_font_weight_control = $args['customizer_repeater_font_weight_control'];
		}

		if ( ! empty( $args['customizer_repeater_EOT_control'] ) ) {
			$this->customizer_repeater_EOT_control = $args['customizer_repeater_EOT_control'];
		}

		if ( ! empty( $args['customizer_repeater_TTF_control'] ) ) {
			$this->customizer_repeater_TTF_control = $args['customizer_repeater_TTF_control'];
		}

		if ( ! empty( $args['customizer_repeater_WOFF_control'] ) ) {
			$this->customizer_repeater_WOFF_control = $args['customizer_repeater_WOFF_control'];
		}

		if ( ! empty( $args['customizer_repeater_WOFF2_control'] ) ) {
			$this->customizer_repeater_WOFF2_control = $args['customizer_repeater_WOFF2_control'];
		}

		if ( ! empty( $args['customizer_repeater_SVG_control'] ) ) {
			$this->customizer_repeater_SVG_control = $args['customizer_repeater_SVG_control'];
		}

		

		if ( ! empty( $id ) ) {
			$this->id = $id;
		}

		$allowed_array1 = wp_kses_allowed_html( 'post' );
		$allowed_array2 = array(
			'input' => array(
				'type'        => array(),
				'class'       => array(),
				'placeholder' => array()
			)
		);

		$this->allowed_html = array_merge( $allowed_array1, $allowed_array2 );
	}

	/*Enqueue resources for the control*/
	public function enqueue() {

		wp_enqueue_style( 'customizer-repeater-admin-stylesheet', wp_directory_uri .'/inc/customizer/customizer-repeater/css/admin-style.css', array(), CUSTOMIZER_REPEATER_VERSION );
		wp_enqueue_script( 'customizer-repeater-script', wp_directory_uri .'/inc/customizer/customizer-repeater/js/customizer_repeater.js', array('jquery', 'jquery-ui-draggable', 'wp-color-picker' ), CUSTOMIZER_REPEATER_VERSION, true  );
	}

	public function render_content() {

		/*Get default options*/
		$this_default = json_decode( $this->setting->default );

		/*Get values (json format)*/
		$values = $this->value();

		/*Decode values*/
		$json = json_decode( $values );

		if ( ! is_array( $json ) ) {
			$json = array( $values );
		} ?>

        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <div class="customizer-repeater-general-control-repeater customizer-repeater-general-control-droppable">
			<?php
			if ( ( count( $json ) == 1 && '' === $json[0] ) || empty( $json ) ) {
				if ( ! empty( $this_default ) ) {
					$this->iterate_array( $this_default ); ?>
                    <input type="hidden"
                           id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
                           class="customizer-repeater-colector"
                           value="<?php echo esc_textarea( json_encode( $this_default ) ); ?>"/>
					<?php
				} else {
					$this->iterate_array(); ?>
                    <input type="hidden"
                           id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
                           class="customizer-repeater-colector"/>
					<?php
				}
			} else {
				$this->iterate_array( $json ); ?>
                <input type="hidden" id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
                       class="customizer-repeater-colector" value="<?php echo esc_textarea( $this->value() ); ?>"/>
				<?php
			} ?>
        </div>
        <button type="button" class="button add_field customizer-repeater-new-field">
			<?php echo esc_html( $this->add_field_label ); ?>
        </button>
		<?php
	}

	private function iterate_array($array = array()){
		/*Counter that helps checking if the box is first and should have the delete button disabled*/
		$it = 0;
		if(!empty($array)){
			foreach($array as $icon){ ?>
                <div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable">
                    <div class="customizer-repeater-customize-control-title">
						<?php echo esc_html( $this->boxtitle ) ?>
                    </div>
                    <div class="customizer-repeater-box-content-hidden">
						<?php
						$font_weight = $EOT_url = $TTF_url = $WOFF_url = $WOFF2_url = $SVG_url = '';
						
						if(!empty($icon->font_weight)){
							$font_weight = $icon->font_weight;
						}

						if(!empty($icon->EOT_url)){
							$EOT_url = $icon->EOT_url;
						}

						if(!empty($icon->TTF_url)){
							$TTF_url = $icon->TTF_url;
						}

						if(!empty($icon->WOFF_url)){
							$WOFF_url = $icon->WOFF_url;
						}

						if(!empty($icon->WOFF2_url)){
							$WOFF2_url = $icon->WOFF2_url;
						}

						if(!empty($icon->SVG_url)){
							$SVG_url = $icon->SVG_url;
						}
						
						if($this->customizer_repeater_font_weight_control == true){
							$this->font_weight_control($font_weight);
						}

						if($this->customizer_repeater_EOT_control == true){
							$this->EOT_control($EOT_url);
						}
						if($this->customizer_repeater_TTF_control == true){
							$this->TTF_control($TTF_url);
						}
						if($this->customizer_repeater_WOFF_control == true){
							$this->WOFF_control($WOFF_url);
						}
						if($this->customizer_repeater_WOFF2_control == true){
							$this->WOFF2_control($WOFF2_url);
						}
						if($this->customizer_repeater_SVG_control == true){
							$this->SVG_control($SVG_url);
						}
						?>

                        <input type="hidden" class="social-repeater-box-id" value="<?php if ( ! empty( $id ) ) {
							echo esc_attr( $id );
						} ?>">
                        <button type="button" class="social-repeater-general-control-remove-field" <?php if ( $it == 0 ) {
							echo 'style="display:none;"';
						} ?>>
							<?php esc_html_e( 'Delete Font', text_domain ); ?>
                        </button>

                    </div>
                </div>

				<?php
				$it++;
			}
		} else { ?>
            <div class="customizer-repeater-general-control-repeater-container">
                <div class="customizer-repeater-customize-control-title">
					<?php echo esc_html( $this->boxtitle ) ?>
                </div>
                <div class="customizer-repeater-box-content-hidden">
					<?php
					if ( $this->customizer_repeater_font_weight_control == true ) {
						$this->font_weight_control();
					}

					if ( $this->customizer_repeater_EOT_control == true ) {
						$this->EOT_control();
					}

					if ( $this->customizer_repeater_TTF_control == true ) {
						$this->TTF_control();
					}
					if ( $this->customizer_repeater_WOFF_control == true ) {
						$this->WOFF_control();
					}
					if ( $this->customizer_repeater_WOFF2_control == true ) {
						$this->WOFF2_control();
					}
					if ( $this->customizer_repeater_SVG_control == true ) {
						$this->SVG_control();
					}
					?>
                    <input type="hidden" class="social-repeater-box-id">
                    <button type="button" class="social-repeater-general-control-remove-field button" style="display:none;">
						<?php esc_html_e( 'Delete Font', text_domain ); ?>
                    </button>
                </div>
            </div>
			<?php
		}
	}

	private function font_weight_control($value='normal'){ ?>
        <span class="customize-control-title">
            <?php esc_html_e('Font Weight',text_domain);?>
        </span>
        <select class="customizer-repeater-font-weight">
            <option value="normal" <?php selected($value,'normal');?>>Normal</option>
            <option value="bold" <?php selected($value,'bold');?>>Bold</option>
			<option value="100" <?php selected($value,'100');?>>100</option>
			<option value="200" <?php selected($value,'200');?>>200</option>
            <option value="300" <?php selected($value,'300');?>>300</option>
            <option value="400" <?php selected($value,'400');?>>400</option>
            <option value="500" <?php selected($value,'500');?>>500</option>
            <option value="600" <?php selected($value,'600');?>>600</option>
            <option value="700" <?php selected($value,'700');?>>700</option>
			<option value="800" <?php selected($value,'800');?>>800</option>
			<option value="900" <?php selected($value,'900');?>>900</option>
        </select>
		<?php
	}

	private function EOT_control($value = '', $show = ''){ ?>
        <div class="customizer-repeater-font-control">
            <span class="customize-control-title">
                <?php esc_html_e('EOT File',text_domain)?>
            </span>
            <input type="text" class="widefat custom-eot-url" value="<?php echo esc_attr( $value ); ?>">
            <input type="button" class="button button-secondary customizer-repeater-custom-eot-button" value="<?php esc_attr_e( 'Upload EOT',text_domain ); ?>" />
        </div>
		<?php
	}

	private function TTF_control($value = '', $show = ''){ ?>
        <div class="customizer-repeater-font-control">
            <span class="customize-control-title">
                <?php esc_html_e('TTF File',text_domain)?>
            </span>
            <input type="text" class="widefat custom-ttf-url" value="<?php echo esc_attr( $value ); ?>">
            <input type="button" class="button button-secondary customizer-repeater-custom-ttf-button" value="<?php esc_attr_e( 'Upload TTF',text_domain ); ?>" />
        </div>
		<?php
	}

	private function WOFF_control($value = '', $show = ''){ ?>
        <div class="customizer-repeater-font-control">
            <span class="customize-control-title">
                <?php esc_html_e('WOFF File',text_domain)?>
            </span>
            <input type="text" class="widefat custom-woff-url" value="<?php echo esc_attr( $value ); ?>">
            <input type="button" class="button button-secondary customizer-repeater-custom-woff-button" value="<?php esc_attr_e( 'Upload WOFF',text_domain ); ?>" />
        </div>
		<?php
	}

	private function WOFF2_control($value = '', $show = ''){ ?>
        <div class="customizer-repeater-font-control">
            <span class="customize-control-title">
                <?php esc_html_e('WOFF2 File',text_domain)?>
            </span>
            <input type="text" class="widefat custom-woff2-url" value="<?php echo esc_attr( $value ); ?>">
            <input type="button" class="button button-secondary customizer-repeater-custom-woff2-button" value="<?php esc_attr_e( 'Upload WOFF2',text_domain ); ?>" />
        </div>
		<?php
	}

	private function SVG_control($value = '', $show = ''){ ?>
        <div class="customizer-repeater-font-control">
            <span class="customize-control-title">
                <?php esc_html_e('SVG File',text_domain)?>
            </span>
            <input type="text" class="widefat custom-svg-url" value="<?php echo esc_attr( $value ); ?>">
            <input type="button" class="button button-secondary customizer-repeater-custom-svg-button" value="<?php esc_attr_e( 'Upload SVG',text_domain ); ?>" />
        </div>
		<?php
	}
	
}