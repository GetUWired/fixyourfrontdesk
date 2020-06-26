<?php

/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
include('svg-icons.php');

if (version_compare($GLOBALS['wp_version'], '5.2.4', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}


/**
 * Fire on the initialization of WordPress.
 */
function the_dramatist_fire_on_wp_initialization()
{
    /** to detect mobile  */
    function my_wp_is_mobile()
    {
        if (wp_is_mobile()) {
            static $is_mobile;

            if (isset($is_mobile))
                return $is_mobile;

            if (empty($_SERVER['HTTP_USER_AGENT'])) {
                $is_mobile = false;
            } elseif (
                strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
                || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
                || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
                || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
                || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
            ) {
                $is_mobile = true;
            } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
                $is_mobile = true;
            } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
                $is_mobile = false;
            } else {
                if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
                    $is_mobile = 'ie11';
                } else {
                    $is_mobile = false;
                }
            }
            return $is_mobile;
        }
    }
}
add_action('init', 'the_dramatist_fire_on_wp_initialization');




function new_excerpt_more($more)
{
    return ' <p><a class="read-more" href="' . get_permalink(get_the_ID()) . '"><span>' . __('Read Full Post', 'your-text-domain') . '</span></a></p>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function google_font_load_function()
{ ?>
    <script>
        WebFontConfig = {
            google: {
                families: ['Roboto:300,300i,400,400i,500,500i,700,700i,900,900i']
            }
        };

        (function() {
            var wf = document.createElement('script');
            wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
<?php
}
add_action('wp_footer', 'google_font_load_function');

if (!function_exists('twentynineteen_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function twentynineteen_setup()
    {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
        load_theme_textdomain('twentynineteen', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        /*
     * Enable support for Post Thumbnails on posts and pages.
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1568, 9999);

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            array(
                'main-navigation' => __('Primary', 'twentynineteen'),
                'membership-menu' => __('Membership Menu', 'twentynineteen'),
            )
        );

        /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        /**
         * Add support for core custom logo.
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'flex-width'  => false,
                'flex-height' => false,
            )
        );

        /* sticky logo */
        function stickylogo($wp_customize)
        {
            // add a setting
            $wp_customize->add_setting('sticky_logo');
            // Add a control to upload the hover logo
            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sticky_logo', array(
                'label' => 'Sticky Logo',
                'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
                'settings' => 'sticky_logo',
                'priority' => 8 // show it just below the custom-logo
            )));
        }
        add_action('customize_register', 'stickylogo');

        /* responsive logo*/
        function responsive_logo($wp_customize)
        {
            // add a setting
            $wp_customize->add_setting('responsive_logo');
            // Add a control to upload the hover logo
            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'responsive_logo', array(
                'label' => 'Reponsive Logo',
                'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
                'settings' => 'responsive_logo',
                'priority' => 9 // show it just below the custom-logo
            )));
        }
        add_action('customize_register', 'responsive_logo');

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Enqueue editor styles.
        add_editor_style('style-editor.css');

        // Add custom editor font sizes.
        // add_theme_support(
        //     'editor-font-sizes',
        //     array(
        //         array(
        //             'name'      => __( 'Small', 'twentynineteen' ),
        //             'shortName' => __( 'S', 'twentynineteen' ),
        //             'size'      => 15,
        //             'slug'      => 'small',
        //         ),
        //         array(
        //             'name'      => __( 'Normal', 'twentynineteen' ),
        //             'shortName' => __( 'M', 'twentynineteen' ),
        //             'size'      => 17,
        //             'slug'      => 'normal',
        //         ),
        //         array(
        //             'name'      => __( 'Large', 'twentynineteen' ),
        //             'shortName' => __( 'L', 'twentynineteen' ),
        //             'size'      => 20,
        //             'slug'      => 'large',
        //         ),
        //         array(
        //             'name'      => __( 'Huge', 'twentynineteen' ),
        //             'shortName' => __( 'XL', 'twentynineteen' ),
        //             'size'      => 24,
        //             'slug'      => 'huge',
        //         ),
        //     )
        // );

        // Editor color palette.
        // add_theme_support(
        //     'editor-color-palette',
        //     array(
        //         array(
        //             'name'  => __( 'Primary', 'twentynineteen' ),
        //             'slug'  => 'primary',
        //             'color' => '#252869',
        //         ),
        //         array(
        //             'name'  => __( 'Secondary', 'twentynineteen' ),
        //             'slug'  => 'secondary',
        //             'color' => '#8D3006',
        //         ),
        //         array(
        //             'name'  => __( 'Dark Gray', 'twentynineteen' ),
        //             'slug'  => 'dark-gray',
        //             'color' => '#111',
        //         ),
        //         array(
        //             'name'  => __( 'Light Gray', 'twentynineteen' ),
        //             'slug'  => 'light-gray',
        //             'color' => '#767676',
        //         ),
        //         array(
        //             'name'  => __( 'White', 'twentynineteen' ),
        //             'slug'  => 'white',
        //             'color' => '#FFF',
        //         ),
        //     )
        // );

        //add_theme_support( 'disable-custom-colors' );

        // Add support for responsive embedded content.
        //add_theme_support( 'responsive-embeds' );
    }
endif;
add_action('after_setup_theme', 'twentynineteen_setup');

// function tabor_gutenberg_disable_custom_colors() {
//
// }
// add_action( 'after_setup_theme', 'tabor_gutenberg_disable_custom_colors' );


if (function_exists('add_image_size')) {
    add_image_size('staff-thumb', 400, 450, true);
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init()
{

    register_sidebar(array(
        'name'          => __('Content Sidebar', 'twentynineteen'),
        'id'            => 'sidebar-1',
        'description'   => __('Additional sidebar that appears on the right.', 'twentynineteen'),
        'before_widget' => '<li id="%1$s" class="widget %2$s pb-0 bg-white">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle text-24 text-white px-15 py-10 mb-0">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => __('Posts Widget Area', 'twentynineteen'),
        'id' => 'posts_widgets',
        'description' => __('Appears in the Blog Page of the site.', ' '),
        'before_widget' => '<li id="%1$s" class="widget %2$s pb-0 bg-white">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle text-24 text-white px-15 py-10 mb-0">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'twentynineteen_widgets_init');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('twentynineteen_content_width', 640);
}
add_action('after_setup_theme', 'twentynineteen_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function site_styles()
{
    //wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

    if (is_front_page()) {
        wp_enqueue_style('herostencil-style', get_template_directory_uri() . '/assets/css/style.css', array(), wp_get_theme()->get('Version'));
    } else {
        wp_enqueue_style('herostencil-style', get_template_directory_uri() . '/assets/css/inner-styles.css', array(), wp_get_theme()->get('Version'));
    }
    wp_style_add_data('twentynineteen-style', 'rtl', 'replace');

    if (has_nav_menu('menu-1')) {
        wp_enqueue_script('twentynineteen-priority-menu', get_theme_file_uri('/js/priority-menu.js'), array(), '1.0', true);
        wp_enqueue_script('twentynineteen-touch-navigation', get_theme_file_uri('/js/touch-keyboard-navigation.js'), array(), '1.0', true);
    }

    //wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    //wp_enqueue_style( 'slick-slider-css', get_theme_file_uri() . '/assets/vendors/slick.css', array(), wp_get_theme()->get( 'Version' ) );
    //wp_enqueue_style( 'fancy-css', get_theme_file_uri() . '/assets/css/jquery.fancybox.min.css', array(), wp_get_theme()->get( 'Version' ) );

    // human body css
    wp_register_style('bodyparts', get_theme_file_uri() . '/assets/css/bodyparts.css');
    wp_register_style('tax-bodyparts', get_theme_file_uri() . '/assets/css/taxonomy-body_parts.css');
    wp_register_style('faq-page', get_theme_file_uri() . '/assets/css/content-accordion-block.css');
    wp_register_style('content-patientinfo', get_theme_file_uri() . '/assets/css/content-patientinfo.css');
    wp_register_style('content-servicessources', get_theme_file_uri() . '/assets/css/content-servicessources.css');
    wp_register_style('pr-wired-app', get_theme_file_uri() . '/assets/css/page-pt-wired-app.css');

    // membership stylesheet
    wp_enqueue_style('course', get_theme_file_uri() . '/style-course.css'); 
    wp_enqueue_style('membership', get_theme_file_uri() . '/style-membership.css');  
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css');
}
add_action('wp_enqueue_scripts', 'site_styles');
//add_action( 'get_footer', 'site_styles' );

function site_script()
{
    wp_enqueue_script('jquery');
    wp_script_add_data('jquery', 'rtl', 'replace');
    wp_enqueue_script('cookie-script', get_theme_file_uri() . '/js/jquery.cookie.js', array(), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('slick-script', get_theme_file_uri() . '/js/slick.min.js', array(), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('matchheight-script', get_theme_file_uri() . '/js/jquery.matchheight.min.js', array(), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('fancy-script', get_theme_file_uri() . '/js/jquery.fancybox.min.js', array(), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('general-script', get_theme_file_uri() . '/js/general.js', array(), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('membership-nav', get_theme_file_uri() . '/js/membership-navigation.js', array(), wp_get_theme()->get('Version'), true);
    //wp_enqueue_script( 'map-script', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCxpFA4oFr0LaqBIuNiWvXu2wlLS3Zmq_s', array(), wp_get_theme()->get( 'Version' ) , true );
    wp_localize_script(
        'general-script',
        'frontend_ajax_object',
        array(
            'siteurl' => get_template_directory_uri(),
            'ajax_url' => admin_url('admin-ajax.php'),
        )
    );
}
add_action('wp_enqueue_scripts', 'site_script');

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix()
{
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
    ?>
    <script>
        /(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", function() {
            var t, e = location.hash.substring(1);
            /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus())
        }, !1);
    </script>
<?php
}
add_action('wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix');

/**
 * Enqueue supplemental block editor styles.
 */
// function twentynineteen_editor_customizer_styles() {
//
//     wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.0', 'all' );
//
//     if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
//         // Include color patterns.
//         require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
//         wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
//     }
// }
// add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
/*
function twentynineteen_colors_css_wrap() {

    // Only include custom colors in customizer or frontend.
    if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
        return;
    }

    require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

    $primary_color = 199;
    if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
        $primary_color = get_theme_mod( 'primary_color_hue', 199 );
    }
?>

<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
    <?php echo twentynineteen_custom_colors_css(); ?>
</style>
<?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );
*/
/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/** ACF Options page Single choice */
/*if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}*/


/* ACF Options page Multiple choices */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'     => 'Theme General Options',
        'menu_title'    => 'Theme options',
        'menu_slug'     => 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Theme Header Options',
        'menu_title'    => 'Header',
        'parent_slug'    => 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Theme Footer Options',
        'menu_title'    => 'Footer',
        'parent_slug'    => 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Theme Sidebar Options',
        'menu_title'    => 'Sidebar',
        'parent_slug'    => 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Theme Social Options',
        'menu_title'    => 'Social',
        'parent_slug'    => 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Theme 404 Options',
        'menu_title'    => '404',
        'parent_slug'    => 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Theme Pop up',
        'menu_title'    => 'General',
        'parent_slug'    => 'theme-general-options',
    ));
}

/* section wise css */
add_action('init', 'action__init');
function action__init()
{

    /* scripts */
    wp_register_script('isotop-lib', get_stylesheet_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), 'init');
    wp_register_script('isotop-function', get_stylesheet_directory_uri() . '/js/isotop-function.js', array('isotop-lib'), 'init');

    wp_register_script('patient-intake-function', get_stylesheet_directory_uri() . '/js/patient-intake-function.js', array('jquery'), 'init');
}





/** svg file upload permission */
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Enqueue SVG javascript and stylesheet in admin
 * @author fadupla
 */

function fadupla_svg_enqueue_scripts($hook)
{
    wp_enqueue_style('fadupla-svg-style', get_theme_file_uri('assets/css/svg.css'));
    wp_enqueue_script('fadupla-svg-script', get_theme_file_uri('/js/svg.js'), 'jquery');
    wp_localize_script(
        'fadupla-svg-script',
        'script_vars',
        array('AJAXurl' => admin_url('admin-ajax.php'))
    );
}

add_action('admin_enqueue_scripts', 'fadupla_svg_enqueue_scripts');


/**
 * Ajax get_attachment_url_media_library
 * @author fadupla
 */
function fadupla_get_attachment_url_media_library()
{

    $url          = '';
    $attachmentID = isset($_REQUEST['attachmentID']) ? $_REQUEST['attachmentID'] : '';
    if ($attachmentID) {
        $url = wp_get_attachment_url($attachmentID);
    }

    echo $url;

    die();
}

add_action('wp_ajax_svg_get_attachment_url', 'fadupla_get_attachment_url_media_library');


/** Admin Logo */
function my_login_logo()
{ ?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/admin-logo.png);
            height: 100px;
            width: 100%;
            background-size: contain;
            background-repeat: no-repeat;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');
add_filter('login_headerurl', 'custom_loginlogo_url');
function custom_loginlogo_url($url)
{
    return site_url();
}

function cptui_register_my_cpts()
{

    /**
     * Post Type: Testimonials.
     */

    $labels = array(
        "name" => __("Testimonials"),
        "singular_name" => __("Testimonia"),
    );

    $args = array(
        "label" => __("Testimonials"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "testimonial", "with_front" => true),
        "query_var" => true,
        "supports" => array("title", "editor", "thumbnail", "excerpt", "page-attributes"),
    );

    register_post_type("testimonial", $args);

    /**
     * Post Type: Story.
     */

    $labels = array(
        "name" => __("Story"),
        "singular_name" => __("Story"),
    );

    $args = array(
        "label" => __("Story"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "story", "with_front" => true),
        "query_var" => true,
        "supports" => array("title", "editor", "thumbnail", "excerpt", "page-attributes"),
    );

    register_post_type("story", $args);

    /**
     * Post Type: Our Staffs.
     */

    $labels = array(
        "name" => __("Our Staffs"),
        "singular_name" => __("Our Staff"),
    );

    $args = array(
        "label" => __("Our Staffs"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array("slug" => "our-team", "with_front" => true),
        "query_var" => true,
        "supports" => array("title", "editor", "thumbnail"),
        "taxonomies" => array("staff_category"),
    );

    register_post_type("our_staff", $args);
}

add_action('init', 'cptui_register_my_cpts');

function cptui_register_my_taxes()
{

    /**
     * Taxonomy: Staff Categories.
     */

    $labels = array(
        "name" => __("Staff Categories"),
        "singular_name" => __("Staff Categories"),
    );

    $args = array(
        "label" => __("Staff Categories"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'staff_category', 'with_front' => true,),
        "show_admin_column" => false,
        "show_in_rest" => true,
        "rest_base" => "staff_category",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
    );
    register_taxonomy("staff_category", array("our_staff"), $args);


    /**
     * Taxonomy: Staff Location.
     */

    $labels = array(
        "name" => __("Staff Locations"),
        "singular_name" => __("Staff Locations"),
    );

    $args = array(
        "label" => __("Staff Locations"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'staff_location', 'with_front' => true,),
        "show_admin_column" => false,
        "show_in_rest" => true,
        "rest_base" => "staff_location",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
    );
    register_taxonomy("staff_location", array("our_staff"), $args);

    /**
     * Taxonomy: Testimonial Categories.
     */

    $labels = array(
        "name" => __("Testimonial Categories"),
        "singular_name" => __("Testimonial Category"),
    );

    $args = array(
        "label" => __("Testimonial Categories"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => array('slug' => 'test_cats', 'with_front' => true,),
        "show_admin_column" => false,
        "show_in_rest" => true,
        "rest_base" => "test_cats",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
    );
    register_taxonomy("test_cats", array("testimonial"), $args);
}
add_action('init', 'cptui_register_my_taxes');



function my_special_nav_class($classes, $item)
{

    if (is_singular('post') && ($item->title == 'Blog' || $item->title == 'Blog')) {
        $classes[] = 'current-menu-item';
    } else if (is_category() && ($item->title == 'Blog' || $item->title == 'Blog')) {
        $classes[] = 'current-menu-item';
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'my_special_nav_class', 10, 2);


/*function max_entries_per_sitemap() {
    return 100;
}
add_filter( 'wpseo_sitemap_entries_per_page', 'max_entries_per_sitemap' );*/


/* Add External Sitemap to Yoast Sitemap Index
 * Credit: Paul https://wordpress.org/support/users/paulmighty/
 * Last Tested: Aug 25 2017 using Yoast SEO 5.3.2 on WordPress 4.8.1
 *********
 * This code adds two external sitemaps and must be modified before using.
 * Replace http://www.example.com/external-sitemap-#.xml
   with your external sitemap URL.
 * Replace 2018-01-30T23:12:27+00:00
   with the time and date your external sitemap was last updated.
   Format: yyyy-MM-dd'T'HH:mm:ssZ
 * If you have more/less sitemaps, add/remove the additional section.
 *********
 * Please note that changes will be applied upon next sitemap update.
 * To manually refresh the sitemap, please disable and enable the sitemaps.
 */
add_filter('wpseo_sitemap_index', 'add_sitemap_custom_items');
function add_sitemap_custom_items()
{
    $sitemap_custom_items = '<sitemap><loc>https://herostencil2k19.ythzzv9z-liquidwebsites.com/page-sitemap.xml</loc><lastmod>2017-05-22T23:12:27+00:00</lastmod></sitemap>';

    /* DO NOT REMOVE ANYTHING BELOW THIS LINE
 * Send the information to Yoast SEO
 */
    return $sitemap_custom_items;
}


/* registering Gutenberg block */
add_action('acf/init', 'my_acf_initpatient');
function my_acf_initpatient()
{

    // check function exists
    if (function_exists('acf_register_block')) {
        // register a patient info block
        acf_register_block(array(
            'name'              => 'patientinfo',
            'title'             => __('Patient Info'),
            'description'       => __('A custom patientinfo block.'),
            'render_callback'   => 'my_acf_block_render_callback_function',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array('patientinfo', 'quote'),
        ));

        // register a services sources block
        acf_register_block(array(
            'name'              => 'servicessources',
            'title'             => __('Services Sources'),
            'description'       => __('A custom Services Sources Links block.'),
            'render_callback'   => 'my_acf_block_render_callback_function',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array('servicessources', 'services'),
        ));

        // register a patient intake script block
        acf_register_block(array(
            'name'              => 'patient-intake-form',
            'title'             => __('patient Intake Form'),
            'description'       => __('A custom Patient Intake Script Links block.'),
            'render_callback'   => 'my_acf_block_render_callback_function',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array('patient intake', 'intake'),
        ));

        // register a accordion script block
        acf_register_block(array(
            'name'              => 'accordion-block',
            'title'             => __('Accordion Block'),
            'description'       => __('A custom Accordion Script block.'),
            'render_callback'   => 'my_acf_block_render_callback_function',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array('accordion-block', 'accordion'),
        ));
    }
}

function my_acf_block_render_callback_function($block)
{
    $slug = str_replace('acf/', '', $block['name']);
    if (file_exists(get_theme_file_path("/template-parts/block/content-{$slug}.php"))) {
        include(get_theme_file_path("/template-parts/block/content-{$slug}.php"));
    }
}

/* hex code to rgba converter */
function hex2rgb($colour)
{
    if ($colour[0] == '#') {
        $colour = substr($colour, 1);
    }
    if (strlen($colour) == 6) {
        list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
    } elseif (strlen($colour) == 3) {
        list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
    } else {
        return false;
    }
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    return $r . ',' . $g . ',' . $b;
    //return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/* feature image overlay for top banner position */
function featureImageOverlay()
{
    $gradOverlayCondition = get_field('do_you_want_to_add_gradient_overlay_on_feature_image', 'options');
    if ("yes" == $gradOverlayCondition) {
        $gradProperties = get_field('set_gradient_properties', 'options');
        $gradDir = $gradProperties['gradient_direction'];
        $gradColor1 = $gradProperties['gradient_top__left_color'];
        $gradColor2 = $gradProperties['gradient_bottom__right_color'];
        $gradOpacity1 = $gradProperties['left_top_overlay_opacity'];
        $gradOpacity2 = $gradProperties['bottom_right_overlay_opacity'];
        $rgb1 = hex2rgb($gradColor1) . ' , ' . $gradOpacity1;
        $rgb2 = hex2rgb($gradColor2) . ' , ' . $gradOpacity2;
        return '<span class="overlay shadow-inner" style="background-image:linear-gradient(' . $gradDir . ', rgba(' . $rgb1 . '), rgba(' . $rgb2 . '))"></span>';
    }
}
/* Additonal Column for workshop date*/
function set_custom_columns_to_cpt($columns)
{
    $columns['workshop_date'] = __('Workshop Date', 'twentynineteen');
    return $columns;
}
add_filter('manage_workshop_posts_columns', 'set_custom_columns_to_cpt');

function custom_column_data($column, $post_id)
{
    switch ($column) {
        case 'workshop_date':
            $workshop_date = get_field('date');
            $workshop_date_obj = new DateTime($workshop_date);

            if (is_string($workshop_date))
                echo $workshop_date_obj->format('j M Y');
            else
                _e('Unable to get data', 'twentynineteen');
            break;
    }
}
add_action('manage_workshop_posts_custom_column', 'custom_column_data', 10, 2);


add_filter('the_posts', 'show_future_posts');

function show_future_posts($posts)
{
    global $wp_query, $wpdb;

    if (is_single() && $wp_query->post_count == 0) {
        $posts = $wpdb->get_results($wp_query->request);
    }

    return $posts;
}

/* site url for terms of use and privacy policy page */
function siteUrlFunction()
{
    $siteUrlHtml = '<a class="link" href="' . site_url() . '">' . get_bloginfo('name') . '</a>';
    return $siteUrlHtml;
}
add_shortcode('site-url', 'siteUrlFunction');

/* site name for terms of use and privacy policy page */
function siteNameFunction()
{
    $siteNameHTML = get_bloginfo('name');
    return $siteNameHTML;
}
add_shortcode('site-name', 'siteNameFunction');

/* privacy policy for terms of use */
function privacyPolicyUrl($atts, $content = null)
{
    $privacyPolicyHTML = '<a class="link" href="' . site_url() . '/privacy-policy">' . $content . '</a>';
    return $privacyPolicyHTML;
}
add_shortcode('privacy-policy', 'privacyPolicyUrl');

/* state name for terms of use page */
function siteTermsState()
{
    $stateHtml = get_field('terms_of_use_state', 'options');
    if ($stateHtml) {
        return $stateHtml;
    }
}
add_shortcode('state-name', 'siteTermsState');



/* Biweekly Cron for form submission */
function ninja_cron_schedules($schedules)
{
    if (!isset($schedules["every_one_day"])) {
        $schedules["every_one_day"] = array(
            'interval' => 86400,
            'display' => __('Every Day')
        );
    }
    return $schedules;
}
add_filter('cron_schedules', 'ninja_cron_schedules');


if (!wp_next_scheduled('ninja_cron_task_hook')) {
    wp_schedule_event(time(), 'every_one_day', 'ninja_cron_task_hook');
}


add_action('ninja_cron_task_hook', 'ninja_cron_task_function');
function ninja_cron_task_function()
{
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_date  < DATE_SUB(NOW() , INTERVAL 15 DAY) AND post_type='nf_sub'");
    if (!empty($results)) {
        foreach ($results as $row) {
            $post_id = $row->ID;
            $wpdb->query("DELETE FROM $wpdb->posts WHERE ID = $post_id");
            $wpdb->query("DELETE FROM $wpdb->postmeta WHERE post_id = $post_id");
        }
    }
}

/** Social Media Function Start */
function social_media_options()
{
    ob_start();
    global $facebook;
    global $insta;
    global $twitter;
    global $youtube;
    global $linkedin;
    global $yelp;
    if (have_rows('social_media', 'options')) {
        echo '<div class="socialmedialinks"><ul class="justify-content-start">';
        while (have_rows('social_media', 'options')) : the_row();
            $icon = get_sub_field('social_media_name', 'options');
            echo '<li class="p-0">' .
                '<a href="' . get_sub_field('social_media_link', 'options') . '" target="_blank" class="' . get_sub_field('social_media_name', 'options') . '">';
            if ($icon == "facebook") {
                echo $facebook;
            } else if ($icon == "insta") {
                echo $insta;
            } else if ($icon == "twitter") {
                echo $twitter;
            } else if ($icon == "youtube") {
                echo $youtube;
            } else if ($icon == "linkedin") {
                echo $linkedin;
            } else if ($icon == "yelp") {
                echo $yelp;
            }
            echo '</a>' .
                '</li>';
        endwhile;
        echo '</ul></div>';
    }
    return ob_get_clean();
}
/** Social Media Function End */


/** Social Media Locations Function Start */
function social_media_locations()
{
    ob_start();
    global $facebook;
    global $insta;
    global $twitter;
    global $youtube;
    global $linkedin;
    global $yelp;
    if (have_rows('social_media')) {
        echo '<div class="socialmedialinks"><ul class="justify-content-start">';
        while (have_rows('social_media')) : the_row();
            $icon = get_sub_field('social_media_name');
            echo '<li class="p-0">' .
                '<a href="' . get_sub_field('social_media_link') . '" target="_blank" class="' . get_sub_field('social_media_name') . '">';
            if ($icon == "facebook") {
                echo $facebook;
            } else if ($icon == "insta") {
                echo $insta;
            } else if ($icon == "twitter") {
                echo $twitter;
            } else if ($icon == "youtube") {
                echo $youtube;
            } else if ($icon == "linkedin") {
                echo $linkedin;
            } else if ($icon == "yelp") {
                echo $yelp;
            }
            echo '</a>' .
                '</li>';
        endwhile;
        echo '</ul></div>';
    }
    return ob_get_clean();
}
add_shortcode('location-social-media', 'social_media_locations');
/** Social Media Locations Function End */

/** For blog post ordering */
add_filter('pto/posts_orderby/ignore', 'stop_sort_order_pto', 10, 3);
function stop_sort_order_pto($ignore, $orderBy, $query)
{
    if ((!is_array($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'post') || (is_array($query->query_vars)   &&  in_array('post', $query->query_vars))
    )
        $ignore = TRUE;
    return $ignore;
}


add_filter('post_class', function ($classes) {
    global $wp_query;

    if (($wp_query->current_post + 1) == $wp_query->post_count)
        $classes[] = ' last-post ';
    return $classes;
});


/** stop autoupdate wp-scss plugin  */
function my_filter_plugin_updates($value)
{
    if (isset($value->response['WP-SCSS-1.2.4/wp-scss.php'])) {
        unset($value->response['WP-SCSS-1.2.4/wp-scss.php']);
    }
    return $value;
}
add_filter('site_transient_update_plugins', 'my_filter_plugin_updates');



/* contact details in privacy page and terms of use page */
function contact_details()
{
    $contactDetails = '';
    $argsContactDetails = array(
        'post_type' => 'location',
        'posts_per_page' => -1
    );
    $obituary_queryContactDetails = new WP_Query($argsContactDetails);
    if ($obituary_queryContactDetails->have_posts()) {
        $contactDetails .= '<div class="contact-details-sec">' . '<ul>';
        while ($obituary_queryContactDetails->have_posts()) : $obituary_queryContactDetails->the_post();
            $contactDetails .= '<li>' .
                do_shortcode('[location-custom-title]') .
                do_shortcode('[location-phone]') .
                do_shortcode('[location-fax]') .
                do_shortcode('[location-email]') .
                '</li>';
        endwhile;
        wp_reset_postdata();
        wp_reset_query();
        $contactDetails .= '</ul>' . '</div>';
        return $contactDetails;
    }
}
add_shortcode('contact-details', 'contact_details');

function is_device_check()
{

    static $is_device;

    if (isset($is_device))
        return $is_device;

    if (empty($_SERVER['HTTP_USER_AGENT'])) {
        $is_device = false;
    } elseif (
        strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
    ) {
        $is_device = 'Android';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
        $is_device = 'iPhone';
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
        $is_device = 'iPad';
    } else {
        if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
            $is_device = 'ie11';
        } else {
            $is_device = false;
        }
    }

    return $is_device;
}
add_shortcode('is_device', 'is_device_check');



// custom menu example @ https://digwp.com/2011/11/html-formatting-custom-menus/
function clean_custom_menus()
{
    $menu_name = 'main-navigation'; // specify custom menu slug
    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
        $menu = wp_get_nav_menu_object($locations[$menu_name]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        //display this element (THESE ARE NOT THE LINES)


        $menu_list = '<nav>' . "\n";
        $menu_list .= "\t\t\t\t" . '<ul>' . "\n";
        echo '<pre>';
        print_r($menu);
        echo '</pre>';
        // foreach ((array) $menu_items as $key => $menu_item) {
        // 	$title = $menu_item->title;
        // 	$url = $menu_item->url;
        // 	$menu_list .= "\t\t\t\t\t". '<li><a href="'. $url .'">'. $title .'</a></li>' ."\n";
        // }
        $menu_list .= "\t\t\t\t" . '</ul>' . "\n";
        $menu_list .= "\t\t\t" . '</nav>' . "\n";
    } else {
        // $menu_list = '<!-- no list defined -->';
    }
    echo $menu_list;
}

class description_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

        $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url) . '"' : '';

        $prepend = '<strong>';
        $append = '</strong>';
        $description  = !empty($item->description) ? '<span>' . esc_attr($item->description) . '</span>' : '';

        if ($depth != 1) {
            $description = $append = $prepend = "";
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $prepend . apply_filters('the_title', $item->title, $item->ID) . $append;
        $item_output .= $description . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

        if ($item->menu_order == 1) {
            $classes[] = 'first';
        }
    }
}

/** main navigation */
function main_navigation()
{
    ob_start();
    wp_nav_menu(
        array(
            'theme_location' => 'main-navigation',
            'menu_class' => 'nav_menu',
        )
    );
    return ob_get_clean();
}
