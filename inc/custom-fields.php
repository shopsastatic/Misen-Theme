<?php
/**
 * ACF Custom Fields for Job Post Type
 *
 * @package MISEN
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register ACF Fields for Jobs
 * Note: This requires ACF PRO plugin to be installed
 */
function misen_register_job_fields() {
    
    if (function_exists('acf_add_local_field_group')) {
        
        acf_add_local_field_group(array(
            'key' => 'group_job_details',
            'title' => 'Job Details',
            'fields' => array(
                // Experience Required
                array(
                    'key' => 'field_experience_required',
                    'label' => 'Experience Required',
                    'name' => 'experience_required',
                    'type' => 'text',
                    'instructions' => 'e.g., 3-5 years',
                    'required' => 0,
                    'wrapper' => array(
                        'width' => '50',
                    ),
                    'default_value' => '',
                    'placeholder' => 'e.g., 3-5 years',
                ),
                
                // Salary Range
                array(
                    'key' => 'field_salary_range',
                    'label' => 'Salary Range',
                    'name' => 'salary_range',
                    'type' => 'text',
                    'instructions' => 'e.g., $60,000 - $80,000',
                    'required' => 0,
                    'wrapper' => array(
                        'width' => '50',
                    ),
                    'default_value' => '',
                    'placeholder' => 'e.g., $60,000 - $80,000',
                ),
                
                // External Apply URL
                array(
                    'key' => 'field_external_apply_url',
                    'label' => 'External Apply URL',
                    'name' => 'external_apply_url',
                    'type' => 'url',
                    'instructions' => 'Optional: Link to external application form',
                    'required' => 0,
                    'placeholder' => 'https://...',
                ),
                
                // Responsibilities
                array(
                    'key' => 'field_responsibilities',
                    'label' => 'Responsibilities',
                    'name' => 'responsibilities',
                    'type' => 'textarea',
                    'instructions' => 'Enter each responsibility on a new line',
                    'required' => 0,
                    'rows' => 8,
                    'placeholder' => 'One item per line',
                ),
                
                // Requirements
                array(
                    'key' => 'field_requirements',
                    'label' => 'Requirements',
                    'name' => 'requirements',
                    'type' => 'textarea',
                    'instructions' => 'Enter each requirement on a new line',
                    'required' => 0,
                    'rows' => 8,
                    'placeholder' => 'One item per line',
                ),
                
                // Benefits
                array(
                    'key' => 'field_benefits',
                    'label' => 'Benefits',
                    'name' => 'benefits',
                    'type' => 'textarea',
                    'instructions' => 'Enter each benefit on a new line',
                    'required' => 0,
                    'rows' => 8,
                    'placeholder' => 'One item per line',
                ),
                
                // Featured Job
                array(
                    'key' => 'field_featured',
                    'label' => 'Featured Job',
                    'name' => 'featured',
                    'type' => 'true_false',
                    'instructions' => 'Display this job on the homepage',
                    'required' => 0,
                    'message' => 'Yes, feature this job on homepage',
                    'default_value' => 0,
                    'ui' => 1,
                ),
                
                // Posted Date
                array(
                    'key' => 'field_posted_date',
                    'label' => 'Posted Date',
                    'name' => 'posted_date',
                    'type' => 'date_picker',
                    'instructions' => 'When was this job posted?',
                    'required' => 0,
                    'display_format' => 'F j, Y',
                    'return_format' => 'Y-m-d',
                    'first_day' => 1,
                ),
                
                // Application Deadline
                array(
                    'key' => 'field_application_deadline',
                    'label' => 'Application Deadline',
                    'name' => 'application_deadline',
                    'type' => 'date_picker',
                    'instructions' => 'Optional: Last date to apply',
                    'required' => 0,
                    'display_format' => 'F j, Y',
                    'return_format' => 'Y-m-d',
                    'first_day' => 1,
                ),
                
                // Remote Work
                array(
                    'key' => 'field_remote_work',
                    'label' => 'Remote Work',
                    'name' => 'remote_work',
                    'type' => 'select',
                    'instructions' => 'Is remote work available?',
                    'required' => 0,
                    'choices' => array(
                        'no' => 'No',
                        'yes' => 'Yes',
                        'hybrid' => 'Hybrid',
                    ),
                    'default_value' => 'no',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 1,
                    'return_format' => 'value',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'job',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'left',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => 'Custom fields for job listings',
        ));
    }
}
add_action('acf/init', 'misen_register_job_fields');

/**
 * Helper function to get job field
 */
function misen_get_job_field($field_name, $post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    if (function_exists('get_field')) {
        return get_field($field_name, $post_id);
    }
    
    return get_post_meta($post_id, $field_name, true);
}

/**
 * Get job posted time ago
 */
function misen_get_job_posted_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $posted_date = misen_get_job_field('posted_date', $post_id);
    
    if ($posted_date) {
        $posted_timestamp = strtotime($posted_date);
    } else {
        $posted_timestamp = get_the_time('U', $post_id);
    }
    
    $time_diff = current_time('timestamp') - $posted_timestamp;
    
    if ($time_diff < 86400) { // Less than 1 day
        return 'Posted today';
    } elseif ($time_diff < 172800) { // Less than 2 days
        return 'Posted 1 day ago';
    } elseif ($time_diff < 604800) { // Less than 1 week
        $days = floor($time_diff / 86400);
        return 'Posted ' . $days . ' days ago';
    } elseif ($time_diff < 1209600) { // Less than 2 weeks
        return 'Posted 1 week ago';
    } elseif ($time_diff < 2592000) { // Less than 1 month
        $weeks = floor($time_diff / 604800);
        return 'Posted ' . $weeks . ' weeks ago';
    } else {
        $months = floor($time_diff / 2592000);
        return 'Posted ' . $months . ' month' . ($months > 1 ? 's' : '') . ' ago';
    }
}

/**
 * Get job departments as HTML
 */
function misen_get_job_departments($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $departments = get_the_terms($post_id, 'department');
    
    if (!$departments || is_wp_error($departments)) {
        return '';
    }
    
    $output = '';
    foreach ($departments as $department) {
        $output .= '<span class="job-tag">';
        $output .= '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
        $output .= '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>';
        $output .= '</svg>';
        $output .= esc_html($department->name);
        $output .= '</span>';
    }
    
    return $output;
}

/**
 * Get job locations as HTML
 */
function misen_get_job_locations($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $locations = get_the_terms($post_id, 'location');
    
    if (!$locations || is_wp_error($locations)) {
        return '';
    }
    
    $output = '';
    foreach ($locations as $location) {
        $output .= '<span class="job-tag">' . esc_html($location->name) . '</span>';
    }
    
    return $output;
}

/**
 * Get job types as HTML
 */
function misen_get_job_types($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $job_types = get_the_terms($post_id, 'job_type');
    
    if (!$job_types || is_wp_error($job_types)) {
        return '';
    }
    
    $output = '';
    foreach ($job_types as $job_type) {
        $output .= '<span class="flex items-center gap-1">';
        $output .= '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
        $output .= '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>';
        $output .= '</svg>';
        $output .= esc_html($job_type->name);
        $output .= '</span>';
    }
    
    return $output;
}
