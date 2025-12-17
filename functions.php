<?php
/**
 * MISEN Theme Functions and Definitions
 *
 * @package MISEN
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Theme Constants
define('MISEN_VERSION', '1.0.0');
define('MISEN_THEME_DIR', get_template_directory());
define('MISEN_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function misen_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu()
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'misen'),
        'footer'  => __('Footer Menu', 'misen'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add support for editor styles
    add_theme_support('editor-styles');
}
add_action('after_setup_theme', 'misen_theme_setup');

/**
 * Enqueue Scripts and Styles
 */
function misen_enqueue_scripts() {
    // Tailwind CSS CDN
    wp_enqueue_script('tailwindcss', 'https://cdn.tailwindcss.com', array(), null, false);
    
    // Theme stylesheet
    wp_enqueue_style('misen-style', get_stylesheet_uri(), array(), MISEN_VERSION);
    
    // Custom theme CSS
    wp_enqueue_style('misen-custom', MISEN_THEME_URI . '/assets/css/theme.css', array('misen-style'), MISEN_VERSION);
    
    // Custom theme JS
    wp_enqueue_script('misen-main', MISEN_THEME_URI . '/assets/js/main.js', array('jquery'), MISEN_VERSION, true);
    
    // Localize script for AJAX
    wp_localize_script('misen-main', 'misenAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('misen-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'misen_enqueue_scripts');

/**
 * Register Widget Areas
 */
function misen_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'misen'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'misen'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 1', 'misen'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'misen'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="text-white font-semibold mb-4">',
        'after_title'   => '</h5>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 2', 'misen'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in your footer.', 'misen'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="text-white font-semibold mb-4">',
        'after_title'   => '</h5>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 3', 'misen'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here to appear in your footer.', 'misen'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="text-white font-semibold mb-4">',
        'after_title'   => '</h5>',
    ));
}
add_action('widgets_init', 'misen_widgets_init');

/**
 * Include Custom Post Types
 */
require_once MISEN_THEME_DIR . '/inc/custom-post-types.php';

/**
 * Include ACF Custom Fields
 */
require_once MISEN_THEME_DIR . '/inc/custom-fields.php';

/**
 * Custom Excerpt Length
 */
function misen_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'misen_excerpt_length', 999);

/**
 * Custom Excerpt More
 */
function misen_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'misen_excerpt_more');

/**
 * Add custom image sizes
 */
add_image_size('job-thumbnail', 800, 450, true);
add_image_size('job-hero', 1200, 600, true);

/**
 * Custom Body Classes
 */
function misen_body_classes($classes) {
    // Add class for singular pages
    if (is_singular()) {
        $classes[] = 'singular';
    }

    // Add class for job posts
    if (is_singular('job')) {
        $classes[] = 'single-job-page';
    }

    // Add class for job archive
    if (is_post_type_archive('job')) {
        $classes[] = 'jobs-archive-page';
    }

    return $classes;
}
add_filter('body_class', 'misen_body_classes');

/**
 * Get Featured Jobs for Homepage
 */
function misen_get_featured_jobs($limit = 5) {
    $args = array(
        'post_type'      => 'job',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => 'featured',
                'value'   => '1',
                'compare' => '='
            )
        ),
        'orderby'        => 'date',
        'order'          => 'DESC'
    );

    return new WP_Query($args);
}

/**
 * Get Job Count
 */
function misen_get_job_count() {
    $count = wp_count_posts('job');
    return isset($count->publish) ? $count->publish : 0;
}

/**
 * AJAX Job Search
 */
function misen_ajax_job_search() {
    check_ajax_referer('misen-nonce', 'nonce');

    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $department = isset($_POST['department']) ? sanitize_text_field($_POST['department']) : '';

    $args = array(
        'post_type'      => 'job',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        's'              => $search,
    );

    if (!empty($department) && $department !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'department',
                'field'    => 'slug',
                'terms'    => $department,
            )
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'job-card');
        }
        $output = ob_get_clean();
        wp_send_json_success(array('html' => $output, 'count' => $query->post_count));
    } else {
        wp_send_json_error(array('message' => 'No jobs found'));
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_misen_job_search', 'misen_ajax_job_search');
add_action('wp_ajax_nopriv_misen_job_search', 'misen_ajax_job_search');

/**
 * Customize Login Page
 */
function misen_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo MISEN_THEME_URI; ?>/assets/images/logo.png);
            height: 65px;
            width: 320px;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'misen_login_logo');

/**
 * Change Login Logo URL
 */
function misen_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'misen_login_logo_url');

/**
 * Change Login Logo Title
 */
function misen_login_logo_url_title() {
    return 'MISEN - Cross-border E-commerce';
}
add_filter('login_headertext', 'misen_login_logo_url_title');
