<?php
/**
 * Custom Post Types for MISEN Theme
 *
 * @package MISEN
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

function misen_register_job_post_type() {
    $labels = array(
        'name'                  => _x('Jobs', 'Post Type General Name', 'misen'),
        'singular_name'         => _x('Job', 'Post Type Singular Name', 'misen'),
        'menu_name'             => __('Jobs', 'misen'),
        'name_admin_bar'        => __('Job', 'misen'),
        'archives'              => __('Job Archives', 'misen'),
        'attributes'            => __('Job Attributes', 'misen'),
        'parent_item_colon'     => __('Parent Job:', 'misen'),
        'all_items'             => __('All Jobs', 'misen'),
        'add_new_item'          => __('Add New Job', 'misen'),
        'add_new'               => __('Add New', 'misen'),
        'new_item'              => __('New Job', 'misen'),
        'edit_item'             => __('Edit Job', 'misen'),
        'update_item'           => __('Update Job', 'misen'),
        'view_item'             => __('View Job', 'misen'),
        'view_items'            => __('View Jobs', 'misen'),
        'search_items'          => __('Search Job', 'misen'),
        'not_found'             => __('Not found', 'misen'),
        'not_found_in_trash'    => __('Not found in Trash', 'misen'),
        'featured_image'        => __('Featured Image', 'misen'),
        'set_featured_image'    => __('Set featured image', 'misen'),
        'remove_featured_image' => __('Remove featured image', 'misen'),
        'use_featured_image'    => __('Use as featured image', 'misen'),
        'insert_into_item'      => __('Insert into job', 'misen'),
        'uploaded_to_this_item' => __('Uploaded to this job', 'misen'),
        'items_list'            => __('Jobs list', 'misen'),
        'items_list_navigation' => __('Jobs list navigation', 'misen'),
        'filter_items_list'     => __('Filter jobs list', 'misen'),
    );

    $args = array(
        'label'                 => __('Job', 'misen'),
        'description'           => __('Job Listings', 'misen'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'taxonomies'            => array('department', 'location', 'job_type'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-businessperson',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'careers',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'job', 'with_front' => false),
    );

    register_post_type('job', $args);
}
add_action('init', 'misen_register_job_post_type', 0);

function misen_register_department_taxonomy() {
    $labels = array(
        'name'                       => _x('Departments', 'Taxonomy General Name', 'misen'),
        'singular_name'              => _x('Department', 'Taxonomy Singular Name', 'misen'),
        'menu_name'                  => __('Departments', 'misen'),
        'all_items'                  => __('All Departments', 'misen'),
        'parent_item'                => __('Parent Department', 'misen'),
        'parent_item_colon'          => __('Parent Department:', 'misen'),
        'new_item_name'              => __('New Department Name', 'misen'),
        'add_new_item'               => __('Add New Department', 'misen'),
        'edit_item'                  => __('Edit Department', 'misen'),
        'update_item'                => __('Update Department', 'misen'),
        'view_item'                  => __('View Department', 'misen'),
        'separate_items_with_commas' => __('Separate departments with commas', 'misen'),
        'add_or_remove_items'        => __('Add or remove departments', 'misen'),
        'choose_from_most_used'      => __('Choose from the most used', 'misen'),
        'popular_items'              => __('Popular Departments', 'misen'),
        'search_items'               => __('Search Departments', 'misen'),
        'not_found'                  => __('Not Found', 'misen'),
        'no_terms'                   => __('No departments', 'misen'),
        'items_list'                 => __('Departments list', 'misen'),
        'items_list_navigation'      => __('Departments list navigation', 'misen'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'department'),
    );

    register_taxonomy('department', array('job'), $args);
}
add_action('init', 'misen_register_department_taxonomy', 0);

function misen_register_location_taxonomy() {
    $labels = array(
        'name'                       => _x('Locations', 'Taxonomy General Name', 'misen'),
        'singular_name'              => _x('Location', 'Taxonomy Singular Name', 'misen'),
        'menu_name'                  => __('Locations', 'misen'),
        'all_items'                  => __('All Locations', 'misen'),
        'parent_item'                => __('Parent Location', 'misen'),
        'parent_item_colon'          => __('Parent Location:', 'misen'),
        'new_item_name'              => __('New Location Name', 'misen'),
        'add_new_item'               => __('Add New Location', 'misen'),
        'edit_item'                  => __('Edit Location', 'misen'),
        'update_item'                => __('Update Location', 'misen'),
        'view_item'                  => __('View Location', 'misen'),
        'separate_items_with_commas' => __('Separate locations with commas', 'misen'),
        'add_or_remove_items'        => __('Add or remove locations', 'misen'),
        'choose_from_most_used'      => __('Choose from the most used', 'misen'),
        'popular_items'              => __('Popular Locations', 'misen'),
        'search_items'               => __('Search Locations', 'misen'),
        'not_found'                  => __('Not Found', 'misen'),
        'no_terms'                   => __('No locations', 'misen'),
        'items_list'                 => __('Locations list', 'misen'),
        'items_list_navigation'      => __('Locations list navigation', 'misen'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'location'),
    );

    register_taxonomy('location', array('job'), $args);
}
add_action('init', 'misen_register_location_taxonomy', 0);

function misen_register_job_type_taxonomy() {
    $labels = array(
        'name'                       => _x('Job Types', 'Taxonomy General Name', 'misen'),
        'singular_name'              => _x('Job Type', 'Taxonomy Singular Name', 'misen'),
        'menu_name'                  => __('Job Types', 'misen'),
        'all_items'                  => __('All Job Types', 'misen'),
        'parent_item'                => __('Parent Job Type', 'misen'),
        'parent_item_colon'          => __('Parent Job Type:', 'misen'),
        'new_item_name'              => __('New Job Type Name', 'misen'),
        'add_new_item'               => __('Add New Job Type', 'misen'),
        'edit_item'                  => __('Edit Job Type', 'misen'),
        'update_item'                => __('Update Job Type', 'misen'),
        'view_item'                  => __('View Job Type', 'misen'),
        'separate_items_with_commas' => __('Separate job types with commas', 'misen'),
        'add_or_remove_items'        => __('Add or remove job types', 'misen'),
        'choose_from_most_used'      => __('Choose from the most used', 'misen'),
        'popular_items'              => __('Popular Job Types', 'misen'),
        'search_items'               => __('Search Job Types', 'misen'),
        'not_found'                  => __('Not Found', 'misen'),
        'no_terms'                   => __('No job types', 'misen'),
        'items_list'                 => __('Job Types list', 'misen'),
        'items_list_navigation'      => __('Job Types list navigation', 'misen'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'job-type'),
    );

    register_taxonomy('job_type', array('job'), $args);
}
add_action('init', 'misen_register_job_type_taxonomy', 0);

function misen_rewrite_flush() {
    misen_register_job_post_type();
    misen_register_department_taxonomy();
    misen_register_location_taxonomy();
    misen_register_job_type_taxonomy();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'misen_rewrite_flush');
