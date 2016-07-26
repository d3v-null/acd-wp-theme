<?php
/** Start the engine */
require_once( get_template_directory() . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Legacy Theme' );
define( 'CHILD_THEME_URL', 'http://market.studiopress.com/themes/legacy' );

/** Create additional color style options */
add_theme_support( 'genesis-style-selector', array( 'legacy-blue' => 'Blue', 'legacy-green' => 'Green', 'legacy-orange' => 'Orange', 'legacy-purple' => 'Purple', 'legacy-red' => 'Red', 'legacy-silver' => 'Silver', ) );

// Woocommerce New Customer Admin Notification Email
add_action('woocommerce_created_customer', 'admin_email_on_registration');
function admin_email_on_registration() {
    $user_id = get_current_user_id();
    wp_new_user_notification( $user_id );
}

add_theme_support( 'genesis-connect-woocommerce' );

/** Add support for custom background */
add_custom_background();

/** Add new image sizes */
add_image_size( 'home-bottom', 290, 150, TRUE );
add_image_size( 'portfolio-thumbnail', 210, 130, TRUE );
add_image_size( 'Mini Square', 70, 70, TRUE );
add_image_size( 'Square', 110, 110, TRUE );
add_image_size( 'Large Square', 150, 150, TRUE );

/** Add Viewport meta tag for mobile browsers */
add_action( 'genesis_meta', 'legacy_viewport_meta_tag' );
function legacy_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 100 ) );

/** Reposition the Secondary Navigation */
remove_action( 'genesis_after_header', 'genesis_do_subnav' ) ;
add_action( 'genesis_before_header', 'genesis_do_subnav' );

/** Add support for 4-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 4 );

/** Add Portfolio Settings box to Genesis Theme Settings */
add_action( 'admin_menu', 'legacy_add_portfolio_settings_box', 11 );
function legacy_add_portfolio_settings_box() {
    global $_genesis_theme_settings_pagehook;
    add_meta_box('genesis-theme-settings-legacy-portfolio', __('Portfolio Page Settings', 'legacy'), 'legacy_theme_settings_portfolio',     'toplevel_page_genesis', 'column2');
}

function legacy_theme_settings_portfolio() {
?>
    <p><?php _e("Display which category:", 'genesis'); ?>
    <?php wp_dropdown_categories(array('selected' => genesis_get_option('legacy_portfolio_cat'), 'name' => GENESIS_SETTINGS_FIELD.'[legacy_portfolio_cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("All Categories", 'genesis'), 'hide_empty' => '0' )); ?></p>

    <p><?php _e("Exclude the following Category IDs:", 'genesis'); ?><br />
    <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[legacy_portfolio_cat_exclude]" value="<?php echo esc_attr( genesis_get_option('legacy_portfolio_cat_exclude') ); ?>" size="40" /><br />
    <small><strong><?php _e("Comma separated - 1,2,3 for example", 'genesis'); ?></strong></small></p>

    <p><?php _e('Number of Posts to Show', 'genesis'); ?>:
    <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[legacy_portfolio_cat_num]" value="<?php echo esc_attr( genesis_option('legacy_portfolio_cat_num') ); ?>" size="2" /></p>

    <p><span class="description"><?php _e('<b>NOTE:</b> The Portfolio Page displays the "Portfolio Page" image size plus the excerpt or full content as selected below.', 'legacy'); ?></span></p>

    <p><?php _e("Select one of the following:", 'genesis'); ?>
    <select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[legacy_portfolio_content]">
        <option style="padding-right:10px;" value="full" <?php selected('full', genesis_get_option('legacy_portfolio_content')); ?>><?php _e("Display post content", 'genesis'); ?></option>
        <option style="padding-right:10px;" value="excerpts" <?php selected('excerpts', genesis_get_option('legacy_portfolio_content')); ?>><?php _e("Display post excerpts", 'genesis'); ?></option>
    </select></p>

    <p><label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[legacy_portfolio_content_archive_limit]"><?php _e('Limit content to', 'genesis'); ?></label> <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[legacy_portfolio_content_archive_limit]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[legacy_portfolio_content_archive_limit]" value="<?php echo esc_attr( genesis_option('legacy_portfolio_content_archive_limit') ); ?>" size="3" /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[legacy_portfolio_content_archive_limit]"><?php _e('characters', 'genesis'); ?></label></p>

    <p><span class="description"><?php _e('<b>NOTE:</b> Using this option will limit the text and strip all formatting from the text displayed. To use this option, choose "Display post content" in the select box above.', 'genesis'); ?></span></p>
<?php
}

/** Register widget areas */
genesis_register_sidebar( array(
    'id'            => 'slider',
    'name'          => __( 'Slider', 'legacy' ),
    'description'   => __( 'This is the slider widget section of the homepage.', 'legacy' ),
) );
genesis_register_sidebar( array(
    'id'            => 'welcome',
    'name'          => __( 'Welcome', 'legacy' ),
    'description'   => __( 'This is the welcome section of the homepage.', 'legacy' ),
) );
genesis_register_sidebar( array(
    'id'            => 'home-middle-top-0',
    'name'          => __( 'Home Middle Top', 'legacy' ),
    'description'   => __( 'This is the top of the middle section of the homepage.', 'legacy' ),
) );
// genesis_register_sidebar( array(
//  'id'            => 'home-middle-top-1',
//  'name'          => __( 'Home Middle Top #1', 'legacy' ),
//  'description'   => __( 'This is the first column of the middle section of the homepage.', 'legacy' ),
// ) );
// genesis_register_sidebar( array(
//  'id'            => 'home-middle-top-2',
//  'name'          => __( 'Home Middle Top #2', 'legacy' ),
//  'description'   => __( 'This is the second column of the middle section of the homepage.', 'legacy' ),
// ) );
// genesis_register_sidebar( array(
//  'id'            => 'home-middle-center-1',
//  'name'          => __( 'Home Middle Center #1', 'legacy' ),
//  'description'   => __( 'This is the first column of the middle section of the homepage.', 'legacy' ),
// ) );
// genesis_register_sidebar( array(
//  'id'            => 'home-middle-center-2',
//  'name'          => __( 'Home Middle Center #2', 'legacy' ),
//  'description'   => __( 'This is the second column of the middle section of the homepage.', 'legacy' ),
// ) );
// genesis_register_sidebar( array(
//  'id'            => 'home-middle-center-3',
//  'name'          => __( 'Home Middle Center #3', 'legacy' ),
//  'description'   => __( 'This is the third column of the middle section of the homepage.', 'legacy' ),
// ) );
// genesis_register_sidebar( array(
//  'id'            => 'home-middle-center-4',
//  'name'          => __( 'Home Middle Center #4', 'legacy' ),
//  'description'   => __( 'This is the forth column of the middle section of the homepage.', 'legacy' ),
// ) );
genesis_register_sidebar( array(
    'id'            => 'home-middle-bottom-1',
    'name'          => __( 'Home Middle Bottom #1', 'legacy' ),
    'description'   => __( 'This is the second column of the middle section of the homepage.', 'legacy' ),
) );
genesis_register_sidebar( array(
    'id'            => 'home-middle-bottom-2',
    'name'          => __( 'Home Middle Bottom #2', 'legacy' ),
    'description'   => __( 'This is the third column of the middle section of the homepage.', 'legacy' ),
) );
genesis_register_sidebar( array(
    'id'            => 'home-bottom-message',
    'name'          => __( 'Home Bottom Message', 'legacy' ),
    'description'   => __( 'This is the bottom section of the homepage right before the footer.', 'legacy' ),
) );


// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 16;' ), 20 );

function replace_howdy( $wp_admin_bar ) {
 $my_account=$wp_admin_bar->get_node('my-account');
 $newtitle = str_replace( 'Howdy,', 'Hello ', $my_account->title );
 $wp_admin_bar->add_node( array(
 'id' => 'my-account',
 'title' => $newtitle,
 ) );
 }
 add_filter( 'admin_bar_menu', 'replace_howdy',25 );


 add_filter('woocommerce_sale_flash', 'my_custom_sale_flash', 10, 3);
function my_custom_sale_flash($text, $post, $_product) {
return '<span class="onsale"> SALE! </span>';
}

add_filter('genesis_get_image', 'default_image_fallback', 10, 2);
function default_image_fallback($output, $args) {

    global $post;

    if( $output || $args['size'] == 'full' || $args['size'] == 'medium' )
        return $output;

    switch($args['size']) {

        case 'Mini Square' :
            // Create file. Must be 70x70 pixels
            $thumbnail = get_bloginfo('stylesheet_directory').'/images/thumbnail-70.png';
            break;
        case 'Square' :
            // Create file. Must be 110x110 pixels
            $thumbnail = get_bloginfo('stylesheet_directory').'/images/thumbnail-110.png';
            break;
        case 'Large Square' :
            // Create file. Must be 150x150 pixels
            $thumbnail = get_bloginfo('stylesheet_directory').'/images/thumbnail-150.png';
            break;
        default :
            // Create file. Must be 150x150 pixels
            $thumbnail = get_bloginfo('stylesheet_directory').'/images/thumbnail-70.png';
            break;

    }

    switch($args['format']) {

        case 'html' :
            return '<img src="'.$thumbnail.'" alt="'. get_the_title($post->ID) .'" style="border:1px solid #DDDDDD;padding: 4px; margin: 5px 0px 5px 0px; display: inline; float: left;" />';
            break;
        case 'url' :
            return $thumbnail;
            break;
        default :
            return $output;
            break;

    }
}


        add_filter(
            'woocommerce-google-analytics-integration-tracking-code-before-send',
            function($code){
                $code .= "ga('require', 'displayfeatures');\n";
                return $code;
            }
        );



//Stop from sharing posts automatically

function derwent_display_free_shipping_text() {
    echo __('Free shipping on Australian retail orders over $100');
}

function derwent_google_fonts() {
    if(is_admin()){return;}
	$query_args = array(
		'family' => 'Yanone+Kaffeesatz:400,700:latin|IM+Fell+DW+Pica:400|IM+Fell+DW+Pica+SC:400',
		// 'family' => 'Teko:400,500,600|Yanone+Kaffeesatz:400,700:latin',
	);
	wp_register_style( 'google_fonts_derwent', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
    wp_enqueue_style('google_fonts_derwent');
}

add_action('init', 'derwent_google_fonts');

/* <div style="width: 100%;max-width: 960px;display: block;margin: 0 auto;"><img class="free_freight_img" src="http://www.annachandler.com/wp-content/uploads/free-shipping-banner2.jpg"/ width="960" height="44" alt_text="<?php derwent_display_free_shipping_text();
?>"></div> */

function derwent_display_free_shipping_banner() {
    ?>
    <div class="free_shipping_banner_container">
        <span class="free_shipping_banner">
            <?php
            derwent_display_free_shipping_text();
            ?>
        </span>
    </div>
    <?php
}

/** print woocommerce shipping notice */


add_filter( 'woocommerce_shipping_fields', 'derwent_add_international_checkout_notice', 11, 1 );
// add_action( 'woocommerce_review_order_before_payment', 'derwent_add_international_checkout_notice', 11);
// add_action( 'init', 'derwent_add_international_checkout_notice');
function derwent_add_international_checkout_notice($address_felds=null) {
    if(class_exists('WC_Customer')){
        global $woocommerce; $customer = $woocommerce->customer;
        $base_location = wc_get_base_location();
        $base_country = apply_filters( 'woocommerce_countries_base_country', $base_location['country'] );
        if( $customer->get_country() != $base_country){
            wc_print_notice( __( 'International customers please note that when you place
your order we will contact you with a qyote to ship your items and we will only charge
your credit card once you have approved this charge. Thank you for your understanding',
                'woocommerce' ), 'notice' );
            error_log("printing message");
        } else {
            error_log("no message: domestic");
        }
    } else {
        error_log("no message: no WC_Customer");
    }
    return $address_felds;
}
