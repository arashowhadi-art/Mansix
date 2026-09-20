<?php
if ( ! function_exists( 'TMT_minify_css' ) ) {

	function TMT_minify_css( $css = '' ) {

		// Return if no CSS
		if ( ! $css ) return;

		// Normalize whitespace
		$css = preg_replace( '/\s+/', ' ', $css );

		// Remove ; before }
		$css = preg_replace( '/;(?=\s*})/', '', $css );

		// Remove space after , : ; { } */ >
		$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

		// Remove space before , ; { }
		$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

		// Strips leading 0 on decimal values (converts 0.5px into .5px)
		$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

		// Strips units if value is 0 (converts 0px to 0)
		$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

		// Trim
		$css = trim( $css );

		// Return minified CSS
		return $css;
		
	}

}
function minify_custom_css( $css ) {
    return TMT_minify_css( $css );
}
add_filter( 'wp_get_custom_css', 'minify_custom_css' );

function save_customizer_css_in_file( $output = NULL ) {

    // Get all the customier css
    $output = apply_filters( 'tmt_head_css', $output );

    // Get Custom Panel CSS
    $output_custom_css = wp_get_custom_css();

    // Minified the Custom CSS
    $output .= TMT_minify_css( $output_custom_css );
        
    // We will probably need to load this file
    require_once( ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'file.php' );
    
    global $wp_filesystem;
    $upload_dir = wp_upload_dir(); // Grab uploads folder array
    $dir = trailingslashit( $upload_dir['basedir'] ) . 'tmt'. DIRECTORY_SEPARATOR; // Set storage directory path

    WP_Filesystem(); // Initial WP file system
    $wp_filesystem->mkdir( $dir ); // Make a new folder 'tmt' for storing our file if not created already.
    $wp_filesystem->put_contents( $dir . 'custom-style.css', $output, 0644 ); // Store in the file.

    return;
}
add_action( 'admin_bar_init', 'save_customizer_css_in_file', 9999 );

function custom_style_css( $output = NULL ) {
    global $wp_customize;
    $upload_dir = wp_upload_dir();

    // Get all the customier css
    $output = apply_filters( 'tmt_head_css', $output );

    // Get Custom Panel CSS
    $output_custom_css = wp_get_custom_css();

    // Minified the Custom CSS
    $output .= TMT_minify_css( $output_custom_css );

    // Render CSS from the custom file
    if ( ! isset( $wp_customize ) && file_exists( $upload_dir['basedir'] .'/tmt/custom-style.css' ) && ! empty( $output ) ) { 
        wp_enqueue_style( 'tmt-custom', trailingslashit( $upload_dir['baseurl'] ) . 'tmt/custom-style.css', false, null );	    			
    }
    return;	
}
add_action('wp_enqueue_scripts', 'custom_style_css', 9999);

function karauos_customize_register( $wp_customize ) {

    $wp_customize->add_panel( 'karauos_panel',array(
        'title' => __( 'karauos Settings', text_domain ),
        'priority' => 1,
    ));

    // Header Settings
    $wp_customize->add_section( 'header_settings' , array(
        'title'       => __( 'Header Settings', text_domain ),
        'priority'    => 30,
        'panel' => 'karauos_panel',
    ) );

    $wp_customize->add_setting( 'tmt_header_page_template', array('default' => '0') );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tmt_header_page_template', array(
        'label'	   				=> esc_html__( 'Header Select Template', text_domain ),
        'description'	   		=> esc_html__( 'Choose a template created in Theme Panel > My Library.', text_domain ),
        'type' 					=> 'select',
        'section'  				=> 'header_settings',
        'settings' 				=> 'tmt_header_page_template',
        'priority' 				=> 1,
        'choices' 				=> tmt_customizer_elementor_library( 'library' ),
    ) ) );

    $wp_customize->add_setting( 'checkbox_setting_id', array('capability' => 'edit_theme_options') );
    $wp_customize->add_control( 'checkbox_setting_id', array(
      'type' => 'checkbox',
      'section' => 'header_settings', // Add a default or your own section
      'label' => __( 'Absolute Header', text_domain ),
    ) );

    $wp_customize->add_setting( 'checkbox_setting_id_mobile', array('capability' => 'edit_theme_options') );
    $wp_customize->add_control( 'checkbox_setting_id_mobile', array(
      'type' => 'checkbox',
      'section' => 'header_settings', // Add a default or your own section
      'label' => __( 'Absolute Header (Mobile)', text_domain ),
    ) );

    // Footer Settings
    $wp_customize->add_section( 'footer_settings' , array(
        'title'       => __( 'Footer Settings', text_domain ),
        'priority'    => 30,
        'panel' => 'karauos_panel',
    ) );

    $wp_customize->add_setting( 'tmt_footer_page_template', array('default' => '0') );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tmt_footer_page_template', array(
        'label'	   				=> esc_html__( 'Footer Select Template', text_domain ),
        'description'	   		=> esc_html__( 'Choose a template created in Theme Panel > My Library.', text_domain ),
        'type' 					=> 'select',
        'section'  				=> 'footer_settings',
        'settings' 				=> 'tmt_footer_page_template',
        'priority' 				=> 1,
        'choices' 				=> tmt_customizer_elementor_library( 'library' ),
    ) ) );

    // Archive Settings
    $wp_customize->add_section( 'archive_settings' , array(
        'title'       => __( 'Archive Page Settings', text_domain ),
        'priority'    => 30,
        'panel' => 'karauos_panel',
    ) );

    $wp_customize->add_setting( 'tmt_index_page_template', array('default' => '0') );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tmt_index_page_template', array(
        'label'	   				=> esc_html__( 'Archive Page Select Template', text_domain ),
        'description'	   		=> esc_html__( 'Choose a template created in Theme Panel > My Library.', text_domain ),
        'type' 					=> 'select',
        'section'  				=> 'archive_settings',
        'settings' 				=> 'tmt_index_page_template',
        'priority' 				=> 1,
        'choices' 				=> tmt_customizer_elementor_library( 'library' ),
    ) ) );

    $wp_customize->add_setting( 'tmt_project_page_template', array('default' => '0') );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tmt_project_page_template', array(
        'label'	   				=> esc_html__( 'Archive Project Select Template', text_domain ),
        'description'	   		=> esc_html__( 'Choose a template created in Theme Panel > My Library.', text_domain ),
        'type' 					=> 'select',
        'section'  				=> 'archive_settings',
        'settings' 				=> 'tmt_project_page_template',
        'priority' 				=> 1,
        'choices' 				=> tmt_customizer_elementor_library( 'library' ),
    ) ) );

    if(woo) {
        $wp_customize->add_setting( 'tmt_shop_page_template', array('default' => '0') );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tmt_shop_page_template', array(
            'label'	   				=> esc_html__( 'Archive Shop Select Template', text_domain ),
            'description'	   		=> esc_html__( 'Choose a template created in Theme Panel > My Library.', text_domain ),
            'type' 					=> 'select',
            'section'  				=> 'archive_settings',
            'settings' 				=> 'tmt_shop_page_template',
            'priority' 				=> 1,
            'choices' 				=> tmt_customizer_elementor_library( 'library' ),
        ) ) );
    }


    // Single Settings
    $wp_customize->add_section( 'single_settings' , array(
        'title'       => __( 'Single Page Settings', text_domain ),
        'priority'    => 30,
        'panel' => 'karauos_panel',
    ) );

    $wp_customize->add_setting( 'tmt_single_page_template', array('default' => '0') );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tmt_single_page_template', array(
        'label'	   				=> esc_html__( 'Single Post Select Template', text_domain ),
        'description'	   		=> esc_html__( 'Choose a template created in Theme Panel > My Library.', text_domain ),
        'type' 					=> 'select',
        'section'  				=> 'single_settings',
        'settings' 				=> 'tmt_single_page_template',
        'priority' 				=> 1,
        'choices' 				=> tmt_customizer_elementor_library( 'library' ),
    ) ) );

    $wp_customize->add_setting( 'tmt_single_project_template', array('default' => '0') );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tmt_single_project_template', array(
        'label'	   				=> esc_html__( 'Single Project Select Template', text_domain ),
        'description'	   		=> esc_html__( 'Choose a template created in Theme Panel > My Library.', text_domain ),
        'type' 					=> 'select',
        'section'  				=> 'single_settings',
        'settings' 				=> 'tmt_single_project_template',
        'priority' 				=> 1,
        'choices' 				=> tmt_customizer_elementor_library( 'library' ),
    ) ) );

    if(woo) {
        $wp_customize->add_setting( 'tmt_single_shop_page_template', array('default' => '0') );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tmt_single_shop_page_template', array(
            'label'	   				=> esc_html__( 'Single Shop Select Template', text_domain ),
            'description'	   		=> esc_html__( 'Choose a template created in Theme Panel > My Library.', text_domain ),
            'type' 					=> 'select',
            'section'  				=> 'single_settings',
            'settings' 				=> 'tmt_single_shop_page_template',
            'priority' 				=> 1,
            'choices' 				=> tmt_customizer_elementor_library( 'library' ),
        ) ) );
    }

    $wp_customize->add_setting( 'tmt_static_page_template', array('default' => '0') );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tmt_static_page_template', array(
        'label'	   				=> esc_html__( 'Static Page Select Template', text_domain ),
        'description'	   		=> esc_html__( 'Choose a template created in Theme Panel > My Library.', text_domain ),
        'type' 					=> 'select',
        'section'  				=> 'single_settings',
        'settings' 				=> 'tmt_static_page_template',
        'priority' 				=> 1,
        'choices' 				=> tmt_customizer_elementor_library( 'library' ),
    ) ) );


    // Error Settings
    $wp_customize->add_section( 'error_settings' , array(
        'title'       => __( '404 Error Page Settings', text_domain ),
        'priority'    => 30,
        'panel' => 'karauos_panel',
    ) );

    $wp_customize->add_setting( 'tmt_error_page_template', array('default' => '0') );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tmt_error_page_template', array(
        'label'	   				=> esc_html__( 'Error Page Select Template', text_domain ),
        'description'	   		=> esc_html__( 'Choose a template created in Theme Panel > My Library.', text_domain ),
        'type' 					=> 'select',
        'section'  				=> 'error_settings',
        'settings' 				=> 'tmt_error_page_template',
        'priority' 				=> 1,
        'choices' 				=> tmt_customizer_elementor_library( 'library' ),
    ) ) );

    /*
	* Login WP
	**/
    $wp_customize->add_section( 'wp_login', array(
        'title'       => __( 'WP Login', text_domain ),
        'priority'    => 30,
        'panel'       => 'karauos_panel',
    ) );
    $wp_customize->add_setting( 'login_logo' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'login_logo', array(
        'label'    => __( 'Login Logo', text_domain ),
        'section'  => 'wp_login',
        'settings' => 'login_logo',
    )));
    $wp_customize->add_setting( 'login_color_bg', array( 'default'   => '','transport' => 'refresh','sanitize_callback' => 'sanitize_hex_color',) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_color_bg', array(
    'section' => 'wp_login',
    'label'   => __( 'Login Background Color', text_domain ),
    ) ) );

    $wp_customize->add_setting( 'login_image_bg' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'login_image_bg', array(
        'label'    => __( 'Login Background image', text_domain ),
        'section'  => 'wp_login',
        'settings' => 'login_image_bg',
    )));
    $wp_customize->add_setting( 'login_color_link', array( 'default'   => '','transport' => 'refresh','sanitize_callback' => 'sanitize_hex_color',) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_color_link', array(
    'section' => 'wp_login',
    'label'   => __( 'Login Color Links', text_domain ),
    ) ) );
    $wp_customize->add_setting( 'login_background_color_submit', array( 'default'   => '','transport' => 'refresh','sanitize_callback' => 'sanitize_hex_color',) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_background_color_submit', array(
    'section' => 'wp_login',
    'label'   => __( 'Login Background Color Submit', text_domain ),
    ) ) );
    $wp_customize->add_setting( 'login_color_submit', array( 'default'   => '','transport' => 'refresh','sanitize_callback' => 'sanitize_hex_color',) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_color_submit', array(
    'section' => 'wp_login',
    'label'   => __( 'Login Color Text Submit', text_domain ),
    ) ) );
    $wp_customize->add_setting( 'login_background_color_submit_hover', array( 'default'   => '','transport' => 'refresh','sanitize_callback' => 'sanitize_hex_color',) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_background_color_submit_hover', array(
    'section' => 'wp_login',
    'label'   => __( 'Login Background Color Submit Hover', text_domain ),
    ) ) );
    $wp_customize->add_setting( 'login_color_submit_hover', array( 'default'   => '','transport' => 'refresh','sanitize_callback' => 'sanitize_hex_color',) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_color_submit_hover', array(
    'section' => 'wp_login',
    'label'   => __( 'Login Text Color Submit Hover', text_domain ),
    ) ) );

    /*
	*  Main Color Option
	**/
    $wp_customize->add_section( 'colors', array(
        'title'       => __( 'Colors', text_domain ),
        'priority'    => 30,
        'panel'       => 'karauos_panel',
    ) );
    $wp_customize->add_setting( 'select_text_color', array( 'default'   => '#fff','transport' => 'refresh','sanitize_callback' => 'sanitize_hex_color',) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'select_text_color', array(
    'section' => 'colors',
    'label'   => __( 'Select Text Color', text_domain ),
    ) ) );
    $wp_customize->add_setting( 'select_bg_color', array( 'default'   => '#eead16','transport' => 'refresh','sanitize_callback' => 'sanitize_hex_color',) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'select_bg_color', array(
    'section' => 'colors',
    'label'   => __( 'Select Background Color', text_domain ),
    ) ) );
    $wp_customize->add_setting( 'link_color', array( 'default'   => '#eead16','transport' => 'refresh','sanitize_callback' => 'sanitize_hex_color',) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
    'section' => 'colors',
    'label'   => __( 'Link Color', text_domain ),
    ) ) );
    $wp_customize->add_setting( 'mobile_color', array( 'default'   => '#eead16','transport' => 'refresh','sanitize_callback' => 'sanitize_hex_color',) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_color', array(
    'section' => 'colors',
    'label'   => __( 'Mobile Tab Color', text_domain ),
    ) ) );
    


    /*
    *  Fonts
    **/
    $wp_customize->add_section( 'custom_fonts_section', array(
            'title'    => __( 'Template Fonts', text_domain ),
            'description'	   		=> '<a href="https://www.themento.net/fa/2656/" target="_blank">برای قرار دادن فونت اختصاصی کلیک کنید تا آموزش را مشاهده کنید.</a>',
            'panel'    => 'karauos_panel',
            'priority' => 50,
        )
    );

    $wp_customize->add_setting( 'custom_font', array(
        'sanitize_callback' => 'customizer_repeater_sanitize'
     ));
     $wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'custom_font', array(
        'label'   => __('Fonts',text_domain),
        'section' => 'custom_fonts_section',
        'priority' => 1,
    ) ) );
        

    /*
	*  Custom codes
	**/
    $wp_customize->add_section( 'custom_codes', array(
        'title'       => __( 'Custom codes', text_domain ),
        'priority'    => 30,
        'panel'       => 'karauos_panel',
    ) );

    $wp_customize->add_setting( 'custom_css', array('default' => '', 'transport' => 'refresh',));
    $wp_customize->add_control( 'custom_css',
        array(
            'label' => __( 'Custom CSS', text_domain ),
            'section' => 'custom_codes',
            'priority' => 10, // Optional. Order priority to load the control. Default: 10
            'type' => 'textarea',
            'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
        )
    );

    $wp_customize->add_setting( 'custom_js', array('default' => '', 'transport' => 'refresh',));
    $wp_customize->add_control( 'custom_js',
        array(
            'label' => __( 'Custom JS', text_domain ),
            'section' => 'custom_codes',
            'priority' => 10, // Optional. Order priority to load the control. Default: 10
            'type' => 'textarea',
            'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
        )
    );

    $wp_customize->add_setting( 'before_closing_head', array('default' => '', 'transport' => 'refresh',));
    $wp_customize->add_control( 'before_closing_head',
        array(
            'label' => __( 'Before Closing Head Tag', text_domain ),
            'section' => 'custom_codes',
            'priority' => 10, // Optional. Order priority to load the control. Default: 10
            'type' => 'textarea',
            'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
        )
    );

    $wp_customize->add_setting( 'before_closing_body', array('default' => '', 'transport' => 'refresh',));
    $wp_customize->add_control( 'before_closing_body',
        array(
            'label' => __( 'Before Closing Body Tag', text_domain ),
            'section' => 'custom_codes',
            'priority' => 10, // Optional. Order priority to load the control. Default: 10
            'type' => 'textarea',
            'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
        )
    );

}

add_action( 'customize_register', 'karauos_customize_register' );


add_filter('upload_mimes', 'add_custom_upload_mimes');
function add_custom_upload_mimes($existing_mimes) {
  	$existing_mimes['woff2'] = 'application/x-font-woff2';
  	$existing_mimes['woff'] = 'application/x-font-woff';
  	$existing_mimes['ttf'] = 'application/x-font-ttf';
  	$existing_mimes['svg'] = 'image/svg+xml';
  	$existing_mimes['eot'] = 'application/vnd.ms-fontobject';
  	return $existing_mimes;
}


function karauos_customize_css($output) {
    $select_text_color = get_theme_mod( 'select_text_color', '#FFF');
    $select_bg_color = get_theme_mod( 'select_bg_color', '#eead16');
    $link_color = get_theme_mod( 'link_color', '#eead16');
    $custom_css = get_theme_mod( 'custom_css' );
    $custom_font = get_theme_mod('custom_font', json_encode( array()) );
    $custom_font_decoded = json_decode($custom_font);
    $EOT_url = $TTF_url = $WOFF_url = $css = '';
    if(!empty($custom_font_decoded)) {foreach($custom_font_decoded as $repeater_item){$EOT_url = $repeater_item->EOT_url;$TTF_url = $repeater_item->TTF_url;$WOFF_url = $repeater_item->WOFF_url;}}
    if(!empty($EOT_url) || !empty($TTF_url) || !empty($WOFF_url)) {
        foreach($custom_font_decoded as $repeater_item){
            $font_weight = $repeater_item->font_weight;
            $EOT_url = $repeater_item->EOT_url;
            $TTF_url = $repeater_item->TTF_url;
            $WOFF_url = $repeater_item->WOFF_url;
            $WOFF2_url = $repeater_item->WOFF2_url;
            $SVG_url = $repeater_item->SVG_url;
            $css .= "@font-face {font-family: TMT;font-style: normal;font-weight: $font_weight;";
            if(!empty($EOT_url)) {$css .= "src: url($EOT_url);";}
            $css .= "src: ";
            $fonts = array();
            if(!empty($EOT_url)) {array_push($fonts, "url($EOT_url?#iefix) format('embedded-opentype')");}
            if(!empty($WOFF2_url)) {array_push($fonts, "url($WOFF2_url) format('woff2')");}
            if(!empty($WOFF_url)) {array_push($fonts, "url($WOFF_url) format('woff')");}
            if(!empty($TTF_url)) {array_push($fonts, "url($TTF_url) format('truetype')");}
            if(!empty($SVG_url)) {array_push($fonts, "url($SVG_url) format('svg')");}
            $css .= implode(",",$fonts);
            $css .= ";}";
        }
        $css .= 'h1, h2, h3, h4, h5, h6 {font-family:TMT;}';
        $css .= 'body, button, input, select, textarea {font-family:TMT;}';
    } else {
        $css .= "@font-face {font-family: IRANSans;font-style: normal;font-weight: bold;src: url('". wp_directory_uri ."/assets/fonts/IRANSansWeb_Bold.eot');src: url('". wp_directory_uri ."/assets/fonts/IRANSansWeb_Bold.eot?#iefix') format('embedded-opentype'),url('". wp_directory_uri ."/assets/fonts/IRANSansWeb_Bold.woff2') format('woff2'),url('". wp_directory_uri ."/assets/fonts/IRANSansWeb_Bold.woff') format('woff'),url('". wp_directory_uri ."/assets/fonts/IRANSansWeb_Bold.ttf') format('truetype');}@font-face {font-family: IRANSans;font-style: normal;font-weight: normal;src: url('". wp_directory_uri ."/assets/fonts/IRANSansWeb.eot');src: url('". wp_directory_uri ."/assets/fonts/IRANSansWeb.eot?#iefix') format('embedded-opentype'),url('". wp_directory_uri ."/assets/fonts/IRANSansWeb.woff2') format('woff2'),url('". wp_directory_uri ."/assets/fonts/IRANSansWeb.woff') format('woff'),url('". wp_directory_uri ."/assets/fonts/IRANSansWeb.ttf') format('truetype');}";
        $css .= 'body, button, input, select, textarea, h1, h2, h3, h4, h5, h6,.irs-from,.irs-to {font-family:IRANSans;}';
    }

    $css .= 'body:not(.rtl) h1,body:not(.rtl) h2,body:not(.rtl) h3,body:not(.rtl) h4,body:not(.rtl) h5,body:not(.rtl) h6 {font-family: "Open Sans",serif !important;}';
    $css .= 'body:not(.rtl),body:not(.rtl) button,body:not(.rtl) input,body:not(.rtl) select,body:not(.rtl) textarea {font-family: "Open Sans",serif !important;}';
    
    $css .= 'a {color:'. $link_color .';}';
    $css .= '::-moz-selection {color:'. $select_text_color .';background:'. $select_bg_color .';}::selection {color:'. $select_text_color .';background:'. $select_bg_color .';}';
    if(wp_is_mobile()) {$css .= 'html {overflow-x:hidden}';}

    $css .= 'a {color:'. $link_color .';}';
    $checkbox = get_theme_mod( 'checkbox_setting_id_mobile' );
    if($checkbox == false){$css .= "@media (max-width: 767px) {.position-header {position: relative;}}";}
    if(!empty($custom_css)) {$css .= "$custom_css";}

    if ( ! empty( $css ) ) {
        if ( is_customize_preview() ) {
            echo "<style type='text/css'>$css</style>";
        } else {
            $output .= '/** === General CSS === **/'. $css;
        }
    }
    return $output;
    
}
add_filter( 'tmt_head_css','karauos_customize_css' );

function custom_admin_font() {
    echo "<style type='text/css'>@font-face {font-family: IRANSans;font-style: normal;font-weight: bold;src: url('". wp_directory_uri ."/assets/fonts/IRANSansWeb_Bold.eot');src: url('". wp_directory_uri ."/assets/fonts/IRANSansWeb_Bold.eot?#iefix') format('embedded-opentype'),url('". wp_directory_uri ."/assets/fonts/IRANSansWeb_Bold.woff2') format('woff2'),url('". wp_directory_uri ."/assets/fonts/IRANSansWeb_Bold.woff') format('woff'),url('". wp_directory_uri ."/assets/fonts/IRANSansWeb_Bold.ttf') format('truetype');}@font-face {font-family: IRANSans;font-style: normal;font-weight: normal;src: url('". wp_directory_uri ."/assets/fonts/IRANSansWeb.eot');src: url('". wp_directory_uri ."/assets/fonts/IRANSansWeb.eot?#iefix') format('embedded-opentype'),url('". wp_directory_uri ."/assets/fonts/IRANSansWeb.woff2') format('woff2'),url('". wp_directory_uri ."/assets/fonts/IRANSansWeb.woff') format('woff'),url('". wp_directory_uri ."/assets/fonts/IRANSansWeb.ttf') format('truetype');}body.rtl, #wpadminbar *:not([class='ab-icon']), .wp-core-ui, .media-menu, .media-frame *, .media-modal *,.rtl h1, .rtl h2, .rtl h3, .rtl h4, .rtl h5, .rtl h6,.elementor-panel,.elementor-button,body,input#elementor-template-library-save-template-name,input#elementor-panel-elements-search-input,.wp-picker-clear.button,.elementor-templates-modal .dialog-widget-content,select,textarea,.tipsy-inner,.elementor-add-section-drag-title,.elementor-add-section-drag-title,.elementor-safe-mode-toast .elementor-toast-content,.elementor-safe-mode-toast header h2,#elementor-finder__search__input,#elementor-template-library-filter-text,.elementor-element-title-wrapper .title,.elementor-add-section-drag-title,.elementor-select-preset-title,.elementor-color-picker__saved-colors-edit,input.pcr-clear,.elementor-color-picker__header,.elementor-color-picker__saved-colors-title,.yoast-title,#elementor-try-safe-mode .elementor-safe-mode-button,button.dialog-button.dialog-cancel.dialog-confirm-cancel,button.dialog-button.dialog-ok.dialog-confirm-ok,input.tooltip-target.elementor-control-tag-area,input.elementor-control-tag-area.elementor-input.ui-autocomplete-input {font-family:IRANSans !important;}.php-error #adminmenuback, .php-error #adminmenuwrap {margin-top: 0 !important;}.elementor-loading-title{letter-spacing:0px!important;font-size:13px!important}#elementor-template-library-filter .select2-selection__rendered,#select2-elementor-template-library-filter-subtype-results .select2-results__option{text-align:right}.e-global__color-hex,.e-global-colors__color-value {font-family: Roboto,Arial,Helvetica,Verdana,sans-serif;}#sub-accordion-section-custom_codes textarea {direction: ltr;}</style>". PHP_EOL;
}
add_action( 'admin_head', 'custom_admin_font' );
add_action( 'customize_controls_print_styles', 'custom_admin_font');
add_action( 'elementor/editor/before_enqueue_scripts', 'custom_admin_font');

add_filter('login_headerurl','ag_login_link');
function ag_login_link() {return home_url();}

add_action( 'login_enqueue_scripts', 'ag_login_logo' );
function ag_login_logo() {
    $login_logo = get_theme_mod( 'login_logo' );
    $login_background_color_submit = get_theme_mod( 'login_background_color_submit' );
    $login_color_submit = get_theme_mod( 'login_color_submit' );
    $login_background_color_submit_hover = get_theme_mod( 'login_background_color_submit_hover' );
    $login_color_submit_hover = get_theme_mod( 'login_color_submit_hover' );
    $login_image_bg = get_theme_mod( 'login_image_bg' );
    $login_color_bg = get_theme_mod( 'login_color_bg' );
    $login_color_link = get_theme_mod( 'login_color_link' );

    echo "<style type='text/css'>"
        . "#login {width: 364px !important;}"
        . "#login h1 {background: transparent;padding: 20px;}";
        if ($login_logo) {echo "#login h1 a {background: url($login_logo)  no-repeat center center/contain;height:100px;margin: 0 auto;width:auto;max-width: 100%}";}
        if (!empty($login_background_color_submit || $login_color_submit)) {echo ".wp-core-ui .button-group.button-large .button, .wp-core-ui .button.button-large {background:$login_background_color_submit;color:$login_color_submit;border: 0;border-radius: 0;box-shadow: none;font-weight: 700;height: 30px;line-height: 28px;padding: 1px 12px 2px;text-shadow: none;text-transform: uppercase;}";}
        if (!empty($login_background_color_submit_hover || $login_color_submit_hover)) {echo ".wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover {background:$login_background_color_submit_hover !important;color:$login_color_submit_hover !important;}";}
        if (!empty($login_image_bg)) {echo "body {background: url($login_image_bg)  no-repeat center center/cover !important;width: 100%;height: 100%}";}
        elseif (!empty($login_color_bg)) {echo "body {background:$login_color_bg !important;}";}
        if(!empty($login_color_link)) {echo "#nav a ,#backtoblog a {color:$login_color_link;!important;}";}
    echo "</style>";
}