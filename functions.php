<?php
/**
 * Driveria Theme Functions and Definitions
 *
 * @package Driveria
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function driveria_theme_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');
    add_image_size('driveria-course-thumb', 600, 400, true);
    add_image_size('driveria-instructor-thumb', 400, 400, true);

    // Register Navigation Menus
    register_nav_menus(array(
        'primary'         => esc_html__('Primary Header Menu', 'driveria'),
        'footer_quick'    => esc_html__('Footer Quick Links Menu', 'driveria'),
        'footer_programs' => esc_html__('Footer Driving Programs Menu', 'driveria'),
    ));

    // Switch default core markup to output valid HTML5.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Support Elementor & Gutenberg Block Styles
    add_theme_support('elementor');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'driveria_theme_setup');

/**
 * Enqueue Scripts and Styles
 */
function driveria_enqueue_scripts() {
    // Swiper CSS & JS for Course & Testimonial Sliders
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true);

    // Theme Core Stylesheet
    wp_enqueue_style('driveria-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('driveria-main', get_template_directory_uri() . '/assets/css/main.css', array('swiper-css'), filemtime(get_template_directory() . '/assets/css/main.css'));

    // Theme JS
    wp_enqueue_script('driveria-main-js', get_template_directory_uri() . '/assets/js/main.js', array('swiper-js'), filemtime(get_template_directory() . '/assets/js/main.js'), true);

    // Localize AJAX URL for Booking Form
    $payment_url = get_theme_mod('driveria_payment_redirect_url', '');
    if (empty($payment_url) && function_exists('wc_get_checkout_url')) {
        $payment_url = wc_get_checkout_url();
    } elseif (empty($payment_url)) {
        $payment_url = home_url('/checkout/');
    }

    $enable_redirect = get_theme_mod('driveria_enable_payment_redirect', true);

    wp_localize_script('driveria-main-js', 'driveria_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'redirect_url' => $payment_url,
        'enable_redirect' => $enable_redirect
    ));
}
add_action('wp_enqueue_scripts', 'driveria_enqueue_scripts');

/**
 * Performance Optimization: Add defer attribute to non-critical JavaScript files
 */
function driveria_add_defer_attribute($tag, $handle) {
    if (is_admin()) {
        return $tag;
    }
    if (in_array($handle, array('swiper-js', 'driveria-main-js'))) {
        if (false === strpos($tag, 'defer')) {
            return str_replace(' src', ' defer src', $tag);
        }
    }
    return $tag;
}
add_filter('script_loader_tag', 'driveria_add_defer_attribute', 10, 2);

/**
 * Register Custom Post Types for Courses and Instructors
 */
function driveria_register_custom_post_types() {
    // 1. Driving Courses Post Type
    register_post_type('driveria_course', array(
        'labels' => array(
            'name'          => __('Driving Courses', 'driveria'),
            'singular_name' => __('Course', 'driveria'),
            'add_new_item'  => __('Add New Course', 'driveria'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-car',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    ));

    // 2. Instructors Post Type
    register_post_type('driveria_instructor', array(
        'labels' => array(
            'name'          => __('Instructors', 'driveria'),
            'singular_name' => __('Instructor', 'driveria'),
            'add_new_item'  => __('Add New Instructor', 'driveria'),
        ),
        'public'       => true,
        'has_archive'  => false,
        'menu_icon'    => 'dashicons-groups',
        'supports'     => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));

    // 3. Student Bookings Post Type (Saves all form submissions in WP Admin Dashboard)
    register_post_type('driveria_booking', array(
        'labels' => array(
            'name'          => __('Student Bookings', 'driveria'),
            'singular_name' => __('Booking Entry', 'driveria'),
            'add_new_item'  => __('Add New Booking', 'driveria'),
        ),
        'public'       => false,
        'show_ui'      => true,
        'menu_icon'    => 'dashicons-clipboard',
        'supports'     => array('title', 'editor', 'custom-fields'),
        'show_in_rest' => false,
    ));

    // 4. Course Category Taxonomy (Supports both 'course_category' & 'driveria_course_category')
    $tax_labels = array(
        'name'              => __('Course Categories', 'driveria'),
        'singular_name'     => __('Course Category', 'driveria'),
        'search_items'      => __('Search Categories', 'driveria'),
        'all_items'         => __('All Categories', 'driveria'),
        'edit_item'         => __('Edit Category', 'driveria'),
        'update_item'       => __('Update Category', 'driveria'),
        'add_new_item'      => __('Add New Category', 'driveria'),
        'new_item_name'     => __('New Category Name', 'driveria'),
        'menu_name'         => __('Categories', 'driveria'),
    );

    register_taxonomy('course_category', array('driveria_course'), array(
        'labels'            => $tax_labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'course-category'),
        'show_in_rest'      => true,
    ));

    register_taxonomy('driveria_course_category', array('driveria_course'), array(
        'labels'            => $tax_labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'driveria-course-category'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'driveria_register_custom_post_types');

/**
 * Helper to render dynamic Course Options for all form dropdowns
 * Fetches published posts strictly from 'driveria_course' Custom Post Type.
 */
function driveria_render_course_options($selected_title = '') {
    $courses_query = new WP_Query(array(
        'post_type'      => 'driveria_course',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
    ));

    $output = '';

    if ($courses_query->have_posts()) {
        while ($courses_query->have_posts()) {
            $courses_query->the_post();
            $title = get_the_title();
            $is_selected = selected($selected_title, $title, false);
            $output .= '<option value="' . esc_attr($title) . '" ' . $is_selected . '>' . esc_html($title) . '</option>';
        }
        wp_reset_postdata();
    } else {
        // Fallback options if no CPT posts are created in backend yet
        $default_courses = array(
            'Teen & Youth License Training',
            'Adult Highway & DMV Test Prep',
            'Defensive & Winter Driving Masterclass',
            'Automatic Gear Specialist',
            'Manual Gearbox Specialist',
            'Refresher & Highway Driving'
        );
        foreach ($default_courses as $d_course) {
            $is_selected = selected($selected_title, $d_course, false);
            $output .= '<option value="' . esc_attr($d_course) . '" ' . $is_selected . '>' . esc_html($d_course) . '</option>';
        }
    }

    return $output;
}

/**
 * Custom Admin Columns for Student Bookings
 */
function driveria_booking_columns($columns) {
    $columns = array(
        'cb'              => '<input type="checkbox" />',
        'title'           => __('Student Name / Entry', 'driveria'),
        'student_email'   => __('Email', 'driveria'),
        'student_phone'   => __('Phone', 'driveria'),
        'course_selected' => __('Course Registered', 'driveria'),
        'payment_method'  => __('Payment Method', 'driveria'),
        'preferred_date'  => __('Preferred Date', 'driveria'),
        'form_source'     => __('Form Source', 'driveria'),
        'date'            => __('Submitted Date', 'driveria'),
    );
    return $columns;
}
add_filter('manage_driveria_booking_posts_columns', 'driveria_booking_columns');

function driveria_booking_custom_column($column, $post_id) {
    switch ($column) {
        case 'student_email':
            echo esc_html(get_post_meta($post_id, '_student_email', true) ?: 'N/A');
            break;
        case 'student_phone':
            echo esc_html(get_post_meta($post_id, '_student_phone', true) ?: 'N/A');
            break;
        case 'course_selected':
            echo esc_html(get_post_meta($post_id, '_course_selected', true) ?: 'N/A');
            break;
        case 'payment_method':
            $pm = get_post_meta($post_id, '_payment_method', true) ?: 'Pending';
            echo '<span class="badge" style="background:#2563EB; color:#fff; padding:3px 8px; border-radius:10px; font-size:11px; font-weight:700;">' . esc_html($pm) . '</span>';
            break;
        case 'preferred_date':
            echo esc_html(get_post_meta($post_id, '_preferred_date', true) ?: 'N/A');
            break;
        case 'form_source':
            echo esc_html(get_post_meta($post_id, '_form_source', true) ?: 'Website Form');
            break;
    }
}
add_action('manage_driveria_booking_posts_custom_column', 'driveria_booking_custom_column', 10, 2);

/**
 * Register Meta Box to display full booking details inside WP Admin edit post screen
 */
function driveria_add_booking_details_meta_box() {
    add_meta_box(
        'driveria_booking_meta_box',
        __('Complete Student Booking Details', 'driveria'),
        'driveria_render_booking_details_meta_box',
        'driveria_booking',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'driveria_add_booking_details_meta_box');

function driveria_render_booking_details_meta_box($post) {
    $name           = get_post_meta($post->ID, '_student_name', true);
    $email          = get_post_meta($post->ID, '_student_email', true);
    $phone          = get_post_meta($post->ID, '_student_phone', true);
    $address        = get_post_meta($post->ID, '_student_address', true);
    $city           = get_post_meta($post->ID, '_student_city', true);
    $state          = get_post_meta($post->ID, '_student_state', true);
    $zip            = get_post_meta($post->ID, '_student_zip', true);
    $course         = get_post_meta($post->ID, '_course_selected', true);
    $preferred_date = get_post_meta($post->ID, '_preferred_date', true);
    $preferred_time = get_post_meta($post->ID, '_preferred_time', true);
    $age_group      = get_post_meta($post->ID, '_student_age_group', true);
    $gender         = get_post_meta($post->ID, '_student_gender', true);
    $permit         = get_post_meta($post->ID, '_has_permit', true);
    $notes          = get_post_meta($post->ID, '_notes', true);
    $form_source    = get_post_meta($post->ID, '_form_source', true);
    ?>
    <table class="widefat striped" style="margin-top: 10px;">
        <tbody>
            <tr><th style="width: 200px;">Form Source</th><td><strong><?php echo esc_html($form_source ?: 'Website Form'); ?></strong></td></tr>
            <tr><th>Student Name</th><td><?php echo esc_html($name ?: 'N/A'); ?></td></tr>
            <tr><th>Email Address</th><td><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email ?: 'N/A'); ?></a></td></tr>
            <tr><th>Phone Number</th><td><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone ?: 'N/A'); ?></a></td></tr>
            <tr><th>Street / Pickup Address</th><td><strong><?php echo esc_html($address ?: 'N/A'); ?></strong></td></tr>
            <tr><th>City</th><td><?php echo esc_html($city ?: 'N/A'); ?></td></tr>
            <tr><th>State</th><td><?php echo esc_html($state ?: 'N/A'); ?></td></tr>
            <tr><th>Course Selected</th><td><strong><?php echo esc_html($course ?: 'N/A'); ?></strong></td></tr>
            <tr><th>Preferred Date</th><td><?php echo esc_html($preferred_date ?: 'N/A'); ?></td></tr>
            <tr><th>Preferred Time Slot</th><td><?php echo esc_html($preferred_time ?: 'N/A'); ?></td></tr>
            <tr><th>Zip / Postal Code</th><td><?php echo esc_html($zip ?: 'N/A'); ?></td></tr>
            <tr><th>Age Group</th><td><?php echo esc_html($age_group ?: 'N/A'); ?></td></tr>
            <tr><th>Gender</th><td><?php echo esc_html($gender ?: 'N/A'); ?></td></tr>
            <tr><th>Has Learner's Permit?</th><td><?php echo esc_html($permit ?: 'N/A'); ?></td></tr>
            <tr><th>Notes / Message</th><td><pre style="white-space: pre-wrap; margin:0; font-family: inherit;"><?php echo esc_html($notes ?: 'N/A'); ?></pre></td></tr>
        </tbody>
    </table>
    <?php
}

/**
 * Smart Helper to find driveria_course post by Title (handles hyphens, en-dashes, HTML entities, and fuzzy matches)
 */
function driveria_find_course_post_by_title($course_title) {
    if (empty($course_title)) {
        return null;
    }

    $raw_title = trim(html_entity_decode(wp_strip_all_tags($course_title), ENT_QUOTES, 'UTF-8'));
    
    // 1. Try exact query
    $posts = get_posts(array(
        'post_type'      => 'driveria_course',
        'title'          => $raw_title,
        'posts_per_page' => 1,
        'post_status'    => array('publish', 'private'),
    ));
    if (!empty($posts)) {
        return $posts[0];
    }

    // 2. Normalize and fuzzy match across all published course posts
    $all_courses = get_posts(array(
        'post_type'      => 'driveria_course',
        'posts_per_page' => -1,
        'post_status'    => array('publish', 'private'),
    ));

    if (!empty($all_courses)) {
        $norm_search = strtolower(preg_replace('/[^a-z0-9]/', '', $raw_title));
        foreach ($all_courses as $c_post) {
            $norm_post = strtolower(preg_replace('/[^a-z0-9]/', '', $c_post->post_title));
            if (!empty($norm_search) && !empty($norm_post)) {
                if ($norm_search === $norm_post || strpos($norm_post, $norm_search) !== false || strpos($norm_search, $norm_post) !== false) {
                    return $c_post;
                }
            }
        }
    }

    return null;
}

/**
 * AJAX Booking & Form Submission Handler (Saves ALL fields to WP Admin Dashboard & Sends Full Details Email to Admin)
 */
function driveria_handle_booking_submission() {
    $name           = isset($_POST['student_name']) ? sanitize_text_field($_POST['student_name']) : '';
    $email          = isset($_POST['student_email']) ? sanitize_email($_POST['student_email']) : '';
    $phone          = isset($_POST['student_phone']) ? sanitize_text_field($_POST['student_phone']) : '';
    $address        = isset($_POST['student_address']) ? sanitize_text_field($_POST['student_address']) : (isset($_POST['address']) ? sanitize_text_field($_POST['address']) : '');
    $zip            = isset($_POST['student_zip']) ? sanitize_text_field($_POST['student_zip']) : '';
    $course         = isset($_POST['course_selected']) ? sanitize_text_field($_POST['course_selected']) : (isset($_POST['course_interest']) ? sanitize_text_field($_POST['course_interest']) : '');
    $preferred_date = isset($_POST['preferred_date']) ? sanitize_text_field($_POST['preferred_date']) : '';
    $preferred_time = isset($_POST['preferred_time']) ? sanitize_text_field($_POST['preferred_time']) : '';
    $age_group      = isset($_POST['student_age_group']) ? sanitize_text_field($_POST['student_age_group']) : (isset($_POST['age_group']) ? sanitize_text_field($_POST['age_group']) : '');
    $gender         = isset($_POST['student_gender']) ? sanitize_text_field($_POST['student_gender']) : '';
    $permit         = isset($_POST['has_permit']) ? sanitize_text_field($_POST['has_permit']) : (isset($_POST['permit_status']) ? sanitize_text_field($_POST['permit_status']) : '');
    $notes          = isset($_POST['notes']) ? sanitize_textarea_field($_POST['notes']) : '';
    $form_source    = isset($_POST['form_source']) ? sanitize_text_field($_POST['form_source']) : __('Website Form', 'driveria');
    $city           = isset($_POST['student_city']) ? sanitize_text_field($_POST['student_city']) : (isset($_POST['city']) ? sanitize_text_field($_POST['city']) : '');
    $state          = isset($_POST['state']) ? sanitize_text_field($_POST['state']) : '';

    // Smart fallback parsing from location_page or address field
    $location_page  = isset($_POST['location_page']) ? sanitize_text_field($_POST['location_page']) : '';
    if (empty($city) && !empty($location_page)) {
        $parts = explode(',', $location_page);
        $city = trim($parts[0]);
        if (count($parts) > 1 && empty($state)) {
            $state = trim($parts[1]);
        }
    }

    if (empty($city) && !empty($address)) {
        $addr_parts = explode(',', $address);
        if (count($addr_parts) >= 3) {
            $state_zip = trim(end($addr_parts));
            $city_candidate = trim($addr_parts[count($addr_parts) - 2]);
            if (empty($zip)) {
                if (preg_match('/\b\d{5}\b/', $state_zip, $matches)) {
                    $zip = $matches[0];
                    $state_zip = trim(str_replace($zip, '', $state_zip));
                }
            }
            if (empty($state)) {
                $state = $state_zip;
            }
            $city = $city_candidate;
        } elseif (count($addr_parts) == 2) {
            $city = trim($addr_parts[1]);
        }
    }

    if (empty($state)) {
        $state = 'Virginia';
    } elseif (strcasecmp($state, 'VA') === 0) {
        $state = 'Virginia';
    }

    // Normalize values to match requested screenshot format
    $age = $age_group;
    if (stripos($age, 'Teen') !== false) {
        $age = 'Teen';
    } elseif (stripos($age, 'Adult') !== false) {
        $age = 'Adult';
    }

    $permit_val = $permit;
    if (strcasecmp($permit_val, 'yes') === 0 || strcasecmp($permit_val, 'true') === 0 || $permit_val === 'Yes') {
        $permit_val = 'Yes';
    } elseif (strcasecmp($permit_val, 'no') === 0 || strcasecmp($permit_val, 'false') === 0 || $permit_val === 'No') {
        $permit_val = 'No';
    }

    if (empty($name) || (empty($phone) && empty($email))) {
        wp_send_json_error(array('message' => __('Please fill in required fields (Name and Phone/Email).', 'driveria')));
    }

    // Build structured CPT content summary for WP Dashboard
    $content_lines = array();
    $content_lines[] = "Form Source: " . ($form_source ?: 'Website Form');
    $content_lines[] = "Full Name: " . $name;
    if (!empty($email))          $content_lines[] = "Email Address: " . $email;
    if (!empty($phone))          $content_lines[] = "Phone Number: " . $phone;
    if (!empty($address))        $content_lines[] = "Pickup / Street Address: " . $address;
    if (!empty($city))           $content_lines[] = "City: " . $city;
    if (!empty($state))          $content_lines[] = "State: " . $state;
    if (!empty($zip))            $content_lines[] = "Zip Code: " . $zip;
    if (!empty($course))         $content_lines[] = "Selected Course: " . $course;
    if (!empty($preferred_date)) $content_lines[] = "Preferred Date: " . $preferred_date;
    if (!empty($preferred_time)) $content_lines[] = "Preferred Time Slot: " . $preferred_time;
    if (!empty($age_group))      $content_lines[] = "Age Group: " . $age_group;
    if (!empty($gender))         $content_lines[] = "Gender: " . $gender;
    if (!empty($permit))         $content_lines[] = "Learner's Permit: " . $permit;
    if (!empty($notes))          $content_lines[] = "Notes / Message:\n" . $notes;

    $post_content = implode("\n", $content_lines);

    // 1. Save entry in WP Admin -> Student Bookings
    $post_id = wp_insert_post(array(
        'post_type'   => 'driveria_booking',
        'post_title'  => $name . ($course ? ' - ' . $course : ''),
        'post_content'=> $post_content,
        'post_status' => 'publish',
    ));

    if ($post_id) {
        update_post_meta($post_id, '_student_name', $name);
        update_post_meta($post_id, '_student_email', $email);
        update_post_meta($post_id, '_student_phone', $phone);
        update_post_meta($post_id, '_student_address', $address);
        update_post_meta($post_id, '_student_city', $city);
        update_post_meta($post_id, '_student_state', $state);
        update_post_meta($post_id, '_student_zip', $zip);
        update_post_meta($post_id, '_course_selected', $course);
        update_post_meta($post_id, '_preferred_date', $preferred_date);
        update_post_meta($post_id, '_preferred_time', $preferred_time);
        update_post_meta($post_id, '_student_age_group', $age_group);
        update_post_meta($post_id, '_student_gender', $gender);
        update_post_meta($post_id, '_has_permit', $permit);
        update_post_meta($post_id, '_notes', $notes);
        update_post_meta($post_id, '_form_source', $form_source);
    }

    // 2. Send notification email to Admin with requested layout
    $to = get_option('admin_email');
    $subject = 'Student Enrollment';

    $body = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Enrollment</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; font-size: 16px; color: #000000; line-height: 1.6; margin: 0; padding: 20px; background-color: #ffffff;">
    <h2 style="font-size: 24px; font-weight: bold; margin-top: 0; margin-bottom: 20px; color: #000000; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;">New Student Enquiry</h2>
    
    <p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Student Name:</strong> ' . esc_html($name) . '</p>
    <p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Email:</strong> <a href="mailto:' . esc_attr($email) . '" style="color: #0066cc; text-decoration: underline;">' . esc_html($email) . '</a></p>
    <p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Phone:</strong> <a href="tel:' . esc_attr($phone) . '" style="color: #0066cc; text-decoration: underline;">' . esc_html($phone) . '</a></p>
    <p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Address:</strong> ' . esc_html($address) . '</p>
    <p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>City:</strong> ' . esc_html($city) . '</p>
    <p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>State:</strong> ' . esc_html($state) . '</p>
    <p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Zipcode:</strong> ' . esc_html($zip) . '</p>
    <p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Age:</strong> ' . esc_html($age) . '</p>
    <p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Gender:</strong> ' . esc_html($gender) . '</p>
    <p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Learner Permit:</strong> ' . esc_html($permit_val) . '</p>
    <p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Course Name:</strong> ' . esc_html($course) . '</p>';

    if (!empty($preferred_date) || !empty($preferred_time)) {
        $body .= '<p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Preferred Date:</strong> ' . esc_html($preferred_date) . '</p>';
        $body .= '<p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Preferred Time:</strong> ' . esc_html($preferred_time) . '</p>';
    }

    $body .= '
    <p style="margin: 12px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Comments:</strong> ' . nl2br(esc_html($notes)) . '</p>
    
    <hr style="border: 0; border-top: 1px solid #eeeeee; margin: 30px 0 20px 0;">
    <p style="font-size: 12px; color: #666666; margin: 5px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Submission Time:</strong> ' . date_i18n('Y-m-d H:i:s') . '</p>
    <p style="font-size: 12px; color: #666666; margin: 5px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><strong>Form Source:</strong> ' . esc_html($form_source) . '</p>
    <p style="font-size: 12px; color: #666666; margin: 5px 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif;"><a href="' . esc_url(admin_url('edit.php?post_type=driveria_booking')) . '" style="color: #666666;">View all bookings in WP Admin</a></p>
</body>
</html>';

    $headers = array('Content-Type: text/html; charset=UTF-8');
    if (!empty($email)) {
        $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
    }

    wp_mail($to, $subject, $body, $headers);

    $redirect_url = '';
    if (!empty($course)) {
        if (filter_var($course, FILTER_VALIDATE_URL) || stripos($course, 'square.link') !== false) {
            $redirect_url = esc_url_raw($course);
        } else {
            $course_post = driveria_find_course_post_by_title($course);
            if ($course_post) {
                $course_checkout_link = driveria_get_course_checkout_url($course_post->ID);
                if (!empty($course_checkout_link) && $course_checkout_link !== '#enroll-registration') {
                    $redirect_url = $course_checkout_link;
                }
            }
        }
    }

    if (empty($redirect_url)) {
        $redirect_url = get_theme_mod('driveria_payment_redirect_url', '');
        if (empty($redirect_url) && function_exists('wc_get_checkout_url')) {
            $redirect_url = wc_get_checkout_url();
        } elseif (empty($redirect_url)) {
            $redirect_url = home_url('/checkout/');
        }
    }

    $enable_redirect = get_theme_mod('driveria_enable_payment_redirect', true);

    $is_venmo = (stripos($redirect_url, 'venmo') !== false);
    $venmo_info = driveria_get_venmo_urls($is_venmo ? $redirect_url : '');

    wp_send_json_success(array(
        'message'       => __('Thank you! Your request has been successfully submitted.', 'driveria'),
        'redirect_url'  => $enable_redirect ? esc_url_raw($redirect_url) : '',
        'is_venmo'      => $is_venmo,
        'venmo_app_url' => $venmo_info['app_url'],
        'venmo_web_url' => $venmo_info['web_url'],
        'booking_id'    => $post_id
    ));
}
add_action('wp_ajax_driveria_submit_booking', 'driveria_handle_booking_submission');
add_action('wp_ajax_nopriv_driveria_submit_booking', 'driveria_handle_booking_submission');

/**
 * Helper to generate Venmo App Deep Links (venmo://) and Web Fallback Links (https://venmo.com/)
 */
if (!function_exists('driveria_get_venmo_urls')) {
    function driveria_get_venmo_urls($handle_or_input = '') {
        if (empty($handle_or_input)) {
            $handle_or_input = get_theme_mod('driveria_venmo_handle', 'Sunil-Shukla-3');
        }

        $raw = trim($handle_or_input);

        if (stripos($raw, 'venmo.com') !== false) {
            $parts = explode('venmo.com/', $raw);
            $path  = end($parts);
            $path_parts = explode('?', $path);
            $clean = ltrim(reset($path_parts), '/');
            if (strpos($clean, 'u/') === 0) {
                $clean = substr($clean, 2);
            }
        } else {
            $clean = $raw;
        }

        $clean = ltrim($clean, '@');
        $clean_encoded = urlencode($clean);

        $app_url = 'venmo://paycharge?txn=pay&recipients=' . $clean_encoded;
        
        if (is_numeric($clean)) {
            $web_url = 'https://venmo.com/' . $clean_encoded;
        } else {
            $web_url = 'https://venmo.com/u/' . $clean_encoded;
        }

        return array(
            'handle'   => $clean,
            'app_url'  => $app_url,
            'web_url'  => $web_url,
        );
    }
}

/**
 * 100% Secure AJAX Payment Method Selection & HTML Email Receipt Generator
 */
if (!function_exists('driveria_handle_payment_method_selection')) {
    function driveria_handle_payment_method_selection() {
        $booking_id     = isset($_POST['booking_id']) ? intval($_POST['booking_id']) : 0;
        $payment_method = isset($_POST['payment_method']) ? sanitize_text_field($_POST['payment_method']) : '';

        if (!$booking_id || empty($payment_method)) {
            wp_send_json_error(array('message' => __('Invalid payment data provided.', 'driveria')));
        }

        // Sanitize payment method options
        $allowed_methods = array('Credit Card', 'Venmo', 'Zelle');
        if (!in_array($payment_method, $allowed_methods, true)) {
            $payment_method = 'Credit Card';
        }

        // Update booking meta in WP Admin
        update_post_meta($booking_id, '_payment_method', $payment_method);
        update_post_meta($booking_id, '_payment_status', 'Selected ' . $payment_method);

        // Fetch booking details securely
        $name   = get_post_meta($booking_id, '_student_name', true) ?: 'Student';
        $email  = get_post_meta($booking_id, '_student_email', true);
        $phone  = get_post_meta($booking_id, '_student_phone', true);
        $course = get_post_meta($booking_id, '_course_selected', true) ?: 'Driving Course';

        $site_name = get_bloginfo('name');
        $admin_email = get_option('admin_email');
        $venmo_handle = get_theme_mod('driveria_venmo_handle', 'Sunil-Shukla-3');
        $venmo_num    = get_theme_mod('driveria_venmo_number', '5715013404');
        $zelle_handle = get_theme_mod('driveria_zelle_handle', 'Prime Driving SCHOOL');
        $zelle_num    = get_theme_mod('driveria_zelle_number', '5715013404');

        $venmo_info = driveria_get_venmo_urls($venmo_handle);

        // 1. Send HTML Email Receipt & Instructions to Student Gmail
        if (!empty($email)) {
            $student_subject = sprintf('[%s] Registration Confirmed - %s Payment Details', $site_name, $payment_method);
            
            $student_body  = '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; background: #ffffff;">';
            $student_body .= '<div style="background: #0A0F1D; padding: 25px; text-align: center; color: #ffffff;">';
            $student_body .= '<h2 style="margin: 0; color: #FFB800; font-size: 24px;">' . esc_html($site_name) . '</h2>';
            $student_body .= '<p style="margin: 6px 0 0 0; color: #cbd5e1; font-size: 14px;">Official Course Registration Confirmation</p>';
            $student_body .= '</div>';
            
            $student_body .= '<div style="padding: 28px; color: #334155; line-height: 1.6;">';
            $student_body .= '<h3 style="color: #0f172a; margin-top: 0; font-size: 18px;">Hello ' . esc_html($name) . ',</h3>';
            $student_body .= '<p>Thank you for choosing <strong>' . esc_html($site_name) . '</strong>! Your registration for <strong>' . esc_html($course) . '</strong> has been processed successfully.</p>';
            
            $student_body .= '<div style="background: #F8FAFC; border-left: 4px solid #FFB800; padding: 18px 22px; border-radius: 8px; margin: 22px 0;">';
            $student_body .= '<h4 style="margin: 0 0 10px 0; color: #0f172a; font-size: 16px;">Selected Payment Option: <span style="color: #2563EB;">' . esc_html($payment_method) . '</span></h4>';
            
            if ($payment_method === 'Venmo') {
                $student_body .= '<p style="margin: 0 0 12px 0; font-size: 14px;"><strong>Venmo Business Account:</strong> ' . esc_html($venmo_handle) . '<br><strong>Venmo ID / Phone:</strong> ' . esc_html($venmo_num) . '</p>';
                $student_body .= '<div style="margin-top: 15px;">';
                $student_body .= '<a href="' . esc_url($venmo_info['app_url']) . '" style="background-color: #008CFF; color: #ffffff; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block; margin-right: 10px; margin-bottom: 8px;">📱 Open in Venmo App</a> ';
                $student_body .= '<a href="' . esc_url($venmo_info['web_url']) . '" style="background-color: #0F172A; color: #ffffff; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block; margin-bottom: 8px;" target="_blank">🌐 Pay on Venmo Web</a>';
                $student_body .= '</div>';
            } elseif ($payment_method === 'Zelle') {
                $student_body .= '<p style="margin: 0; font-size: 14px;"><strong>Zelle Recipient Name:</strong> ' . esc_html($zelle_handle) . '<br><strong>Zelle Phone / ID:</strong> ' . esc_html($zelle_num) . '</p>';
            } elseif ($payment_method === 'Credit Card') {
                $student_body .= '<p style="margin: 0; font-size: 14px;">You selected Credit Card Payment. Please complete checkout on the secure checkout screen.</p>';
            }
            
            $student_body .= '</div>';
            
            $student_body .= '<p>If you have any questions or need to schedule your training dates, feel free to reply directly to this email or call us at <a href="tel:' . esc_attr($venmo_num) . '" style="color: #2563eb; font-weight: bold;">' . esc_html($venmo_num) . '</a>.</p>';
            $student_body .= '<p style="margin-bottom: 0; margin-top: 25px; border-top: 1px solid #e2e8f0; padding-top: 15px; font-size: 13px; color: #64748b;">Best regards,<br><strong style="color: #0f172a;">' . esc_html($site_name) . ' Support Team</strong></p>';
            $student_body .= '</div>';
            $student_body .= '</div>';

            $headers = array('Content-Type: text/html; charset=UTF-8');
            wp_mail($email, $student_subject, $student_body, $headers);
        }

        // 2. Send Admin Notification Email
        $admin_subject = sprintf('[%s] Payment Method Chosen (%s): %s', $site_name, $payment_method, $name);
        $admin_body  = "Hello Admin,\n\nA student has selected their payment method after registering:\n\n";
        $admin_body .= "Student Name: " . $name . "\n";
        $admin_body .= "Email: " . $email . "\n";
        $admin_body .= "Phone: " . $phone . "\n";
        $admin_body .= "Course Selected: " . $course . "\n";
        $admin_body .= "Selected Payment Method: " . $payment_method . "\n";
        $admin_body .= "Booking Record ID: #" . $booking_id . "\n\n";
        $admin_body .= "View Booking Record in Admin Dashboard: " . admin_url('post.php?post=' . $booking_id . '&action=edit');

        wp_mail($admin_email, $admin_subject, $admin_body, array('Content-Type: text/plain; charset=UTF-8'));

        // Dynamic Credit Card URL for popup redirect
        $credit_card_redirect = '';
        if ($payment_method === 'Credit Card') {
            $course_post = driveria_find_course_post_by_title($course);
            if ($course_post) {
                $credit_card_redirect = driveria_get_course_checkout_url($course_post->ID);
            }
            if (empty($credit_card_redirect)) {
                $credit_card_redirect = get_theme_mod('driveria_payment_redirect_url', '');
                if (empty($credit_card_redirect) && function_exists('wc_get_checkout_url')) {
                    $credit_card_redirect = wc_get_checkout_url();
                } elseif (empty($credit_card_redirect)) {
                    $credit_card_redirect = home_url('/checkout/');
                }
            }
        }

        wp_send_json_success(array(
            'message'         => __('Payment selection updated successfully.', 'driveria'),
            'payment_method'  => $payment_method,
            'booking_id'      => $booking_id,
            'venmo_handle'    => $venmo_handle,
            'venmo_num'       => $venmo_num,
            'venmo_app_url'   => $venmo_info['app_url'],
            'venmo_web_url'   => $venmo_info['web_url'],
            'zelle_handle'    => $zelle_handle,
            'zelle_num'       => $zelle_num,
            'credit_card_url' => esc_url_raw($credit_card_redirect),
        ));
    }
}
add_action('wp_ajax_driveria_select_payment_method', 'driveria_handle_payment_method_selection');
add_action('wp_ajax_nopriv_driveria_select_payment_method', 'driveria_handle_payment_method_selection');

/**
 * Direct WooCommerce Add to Cart & Redirect to Checkout Handler
 */
add_action('wp_loaded', 'driveria_woocommerce_direct_add_to_cart_handler', 1);
function driveria_woocommerce_direct_add_to_cart_handler() {
    if (isset($_GET['add-to-cart']) && function_exists('WC')) {
        $raw_id = sanitize_text_field($_GET['add-to-cart']);
        if (is_numeric($raw_id)) {
            $product_id = intval($raw_id);
            if ($product_id > 0) {
                // 1. Initialize WooCommerce session & cart if not active yet
                if (null === WC()->session && class_exists('WC_Session_Handler')) {
                    $session_class = apply_filters('woocommerce_session_handler', 'WC_Session_Handler');
                    if (class_exists($session_class)) {
                        WC()->session = new $session_class();
                        WC()->session->init();
                    }
                }
                if (null === WC()->customer && class_exists('WC_Customer')) {
                    WC()->customer = new WC_Customer(get_current_user_id(), true);
                }
                if (null === WC()->cart && class_exists('WC_Cart')) {
                    WC()->cart = new WC_Cart();
                }

                // 2. Validate product in WooCommerce
                $product = wc_get_product($product_id);
                if (!$product && function_exists('get_post_type') && get_post_type($product_id) === 'driveria_course') {
                    $linked_product_id = get_post_meta($product_id, '_course_product_id', true) ?: get_post_meta($product_id, 'course_product_id', true);
                    if (!empty($linked_product_id) && is_numeric($linked_product_id) && intval($linked_product_id) !== $product_id) {
                        $product_id = intval($linked_product_id);
                        $product = wc_get_product($product_id);
                    }
                }

                if ($product && WC()->cart) {
                    WC()->cart->empty_cart();
                    WC()->cart->add_to_cart($product_id, 1);
                    $checkout_url = function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/');
                    wp_safe_redirect($checkout_url);
                    exit;
                }
            }
        }
    }
}

/**
 * Filter WooCommerce native add to cart redirect to force Checkout instead of Cart
 */
add_filter('woocommerce_add_to_cart_redirect', function($url) {
    if (function_exists('wc_get_checkout_url')) {
        return wc_get_checkout_url();
    }
    return home_url('/checkout/');
}, 99);

/**
 * Elementor Shortcodes: [driveria_hero] and [driveria_feature_cards]
 */
function driveria_hero_shortcode() {
    ob_start();
    get_template_part('front-page');
    return ob_get_clean();
}
add_shortcode('driveria_hero', 'driveria_hero_shortcode');

/**
 * Include Customizer Options
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Helper function to get page permalink dynamically by title or fallback slug
 */
function driveria_get_page_url($title, $fallback_slug = '') {
    $page = get_page_by_title($title);
    if (!$page) {
        $clean_term = preg_replace('/[0-9_\-]/', '', str_replace(array(' Us', ' Our', '2'), '', $title));
        $all_pages = get_pages();
        if (!empty($all_pages)) {
            foreach ($all_pages as $p) {
                if (stripos($p->post_title, trim($clean_term)) !== false || stripos($p->post_name, strtolower(trim($clean_term))) !== false) {
                    $page = $p;
                    break;
                }
            }
        }
    }
    if ($page) {
        return get_permalink($page->ID);
    }
    return home_url('/' . trim($fallback_slug ?: strtolower(str_replace(' ', '-', $title)), '/') . '/');
}

/**
 * Smart Template Filter for Driveria Theme Pages
 */
function driveria_smart_template_include($template) {
    if (is_page()) {
        $page_id = get_queried_object_id();
        $page_slug = get_post_field('post_name', $page_id);
        $page_title = strtolower(get_the_title($page_id));
        $custom_tpl = get_post_meta($page_id, '_wp_page_template', true);

        if (empty($custom_tpl) || $custom_tpl === 'default' || $custom_tpl === 'page.php') {
            if (strpos($page_slug, 'about') !== false || strpos($page_title, 'about') !== false) {
                $file = get_template_directory() . '/template-about.php';
                if (file_exists($file)) return $file;
            }
            if (strpos($page_slug, 'contact') !== false || strpos($page_title, 'contact') !== false) {
                $file = get_template_directory() . '/template-contact.php';
                if (file_exists($file)) return $file;
            }
            if (strpos($page_slug, 'course') !== false || strpos($page_title, 'course') !== false) {
                $file = get_template_directory() . '/archive-driveria_course.php';
                if (file_exists($file)) return $file;
            }
            if (strpos($page_slug, 'home') !== false || strpos($page_title, 'home') !== false) {
                $file = get_template_directory() . '/front-page.php';
                if (file_exists($file)) return $file;
            }
        }
    }
    return $template;
}
add_filter('template_include', 'driveria_smart_template_include', 99);

/**
 * Helper to get or create a published page by title, restoring from trash if needed
 */
function driveria_get_or_create_published_page($title, $template, $alternate_titles = array()) {
    $search_titles = array_merge(array($title), (array)$alternate_titles);

    foreach ($search_titles as $t) {
        $published_pages = get_posts(array(
            'post_type'        => 'page',
            'post_status'      => 'publish',
            'title'            => $t,
            'posts_per_page'   => 1,
            'suppress_filters' => false,
        ));
        if (!empty($published_pages)) {
            $page_id = $published_pages[0]->ID;
            if (!empty($template)) {
                update_post_meta($page_id, '_wp_page_template', $template);
            }
            return $page_id;
        }
    }

    foreach ($search_titles as $t) {
        $any_pages = get_posts(array(
            'post_type'        => 'page',
            'post_status'      => array('trash', 'draft', 'private', 'pending'),
            'title'            => $t,
            'posts_per_page'   => 1,
            'suppress_filters' => false,
        ));
        if (!empty($any_pages)) {
            $page_id = $any_pages[0]->ID;
            wp_update_post(array(
                'ID'          => $page_id,
                'post_status' => 'publish',
            ));
            if (!empty($template)) {
                update_post_meta($page_id, '_wp_page_template', $template);
            }
            return $page_id;
        }
    }

    $new_id = wp_insert_post(array(
        'post_title'    => $title,
        'post_type'     => 'page',
        'post_status'   => 'publish',
        'page_template' => $template,
    ));

    if ($new_id && !is_wp_error($new_id)) {
        if (!empty($template)) {
            update_post_meta($new_id, '_wp_page_template', $template);
        }
        return $new_id;
    }

    return 0;
}

/**
 * Auto-Create Default Pages & Assign Main Menu ONCE or when pages are missing
 */
function driveria_auto_setup_pages_and_menu($force = false) {
    if (!$force && get_option('driveria_theme_pages_setup_done_v9')) {
        $home_check    = get_posts(array('post_type' => 'page', 'post_status' => 'publish', 'title' => 'Home', 'posts_per_page' => 1));
        $about_check   = get_posts(array('post_type' => 'page', 'post_status' => 'publish', 'title' => 'About Us', 'posts_per_page' => 1));
        $contact_check = get_posts(array('post_type' => 'page', 'post_status' => 'publish', 'title' => 'Contact Us', 'posts_per_page' => 1));
        $courses_check = get_posts(array('post_type' => 'page', 'post_status' => 'publish', 'title' => 'Our Courses', 'posts_per_page' => 1));

        if (!empty($home_check) && !empty($about_check) && !empty($contact_check) && !empty($courses_check)) {
            return;
        }
    }

    $home_id = driveria_get_or_create_published_page('Home', 'front-page.php', array('Home2'));
    if ($home_id) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_id);
    }

    $about_id = driveria_get_or_create_published_page('About Us', 'template-about.php', array('About Us2', 'About'));
    $contact_id = driveria_get_or_create_published_page('Contact Us', 'template-contact.php', array('Contact US2', 'Contact'));
    $courses_id = driveria_get_or_create_published_page('Our Courses', 'archive-driveria_course.php', array('Our Courses2', 'Courses'));

    $menu_name = 'Driving GP Main Menu';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);

        if ($home_id) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'     => 'HOME',
                'menu-item-object-id' => $home_id,
                'menu-item-object'    => 'page',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ));
        }

        if ($about_id) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'     => 'ABOUT US',
                'menu-item-object-id' => $about_id,
                'menu-item-object'    => 'page',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ));
        }

        if ($courses_id) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'     => 'COURSES',
                'menu-item-object-id' => $courses_id,
                'menu-item-object'    => 'page',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ));
        }

        if ($contact_id) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'     => 'CONTACT',
                'menu-item-object-id' => $contact_id,
                'menu-item-object'    => 'page',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ));
        }

        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

    update_option('driveria_theme_pages_setup_done_v9', true);
    flush_rewrite_rules(false);
}

add_action('after_switch_theme', 'driveria_auto_setup_pages_and_menu');
add_action('admin_init', function() {
    if (isset($_GET['driveria_recreate_pages']) && current_user_can('manage_options')) {
        driveria_auto_setup_pages_and_menu(true);
        wp_safe_redirect(admin_url('edit.php?post_type=page&driveria_pages_restored=1'));
        exit;
    }
    driveria_auto_setup_pages_and_menu(false);
});

add_action('admin_notices', function() {
    if (isset($_GET['driveria_pages_restored'])) {
        echo '<div class="notice notice-success is-dismissible"><p><strong>Driveria Theme Pages & Main Menu successfully restored & published!</strong></p></div>';
    }
});

/**
 * Helper to fetch Course Meta (supports both ACF & Native WP Meta Box)
 */
function driveria_get_course_meta($post_id, $key, $default = '') {
    if (function_exists('get_field')) {
        $acf_val = get_field($key, $post_id);
        if (!empty($acf_val)) return $acf_val;
    }
    $meta_val = get_post_meta($post_id, '_' . $key, true);
    if (empty($meta_val)) {
        $meta_val = get_post_meta($post_id, $key, true);
    }
    return !empty($meta_val) ? $meta_val : $default;
}

/**
 * Register Native Meta Box for Driveria Course Custom Fields
 */
function driveria_add_course_meta_box() {
    add_meta_box(
        'driveria_course_details_box',
        __('Driveria Course Details & Meta Settings', 'driveria'),
        'driveria_render_course_meta_box',
        array('driveria_course', 'page'),
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'driveria_add_course_meta_box');

function driveria_render_course_meta_box($post) {
    wp_nonce_field('driveria_save_course_meta', 'driveria_course_meta_nonce');

    $price      = get_post_meta($post->ID, '_course_price', true) ?: get_post_meta($post->ID, 'course_price', true);
    $duration   = get_post_meta($post->ID, '_course_duration', true) ?: get_post_meta($post->ID, 'course_duration', true);
    $lessons    = get_post_meta($post->ID, '_course_lessons', true) ?: get_post_meta($post->ID, 'course_lessons', true);
    $level      = get_post_meta($post->ID, '_course_level', true) ?: get_post_meta($post->ID, 'course_level', true);
    $badge      = get_post_meta($post->ID, '_course_badge', true) ?: get_post_meta($post->ID, 'course_badge', true);
    $product_id = get_post_meta($post->ID, '_course_product_id', true) ?: get_post_meta($post->ID, 'course_product_id', true);
    $learn_topics = get_post_meta($post->ID, '_course_learn_topics', true) ?: get_post_meta($post->ID, 'course_learn_topics', true);
    $features   = get_post_meta($post->ID, '_course_features', true) ?: get_post_meta($post->ID, 'course_features', true);
    ?>
    <style>
        .driveria-meta-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; padding: 10px 0; }
        .driveria-meta-field { display: flex; flex-direction: column; gap: 5px; }
        .driveria-meta-field label { font-weight: 600; color: #1e293b; }
        .driveria-meta-field input { padding: 8px 12px; border-radius: 6px; border: 1px solid #cbd5e1; }
        .driveria-meta-field small { font-size: 11px; color: #64748b; }
    </style>
    <div class="driveria-meta-grid">
        <div class="driveria-meta-field">
            <label for="course_price"><?php _e('Course Price', 'driveria'); ?></label>
            <input type="text" id="course_price" name="course_price" value="<?php echo esc_attr($price); ?>" placeholder="e.g. $299" />
        </div>
        <div class="driveria-meta-field">
            <label for="course_duration"><?php _e('Duration', 'driveria'); ?></label>
            <input type="text" id="course_duration" name="course_duration" value="<?php echo esc_attr($duration); ?>" placeholder="e.g. 2 Weeks" />
        </div>
        <div class="driveria-meta-field">
            <label for="course_lessons"><?php _e('Lessons Count', 'driveria'); ?></label>
            <input type="text" id="course_lessons" name="course_lessons" value="<?php echo esc_attr($lessons); ?>" placeholder="e.g. 10 Lessons" />
        </div>
        <div class="driveria-meta-field">
            <label for="course_level"><?php _e('Skill Level', 'driveria'); ?></label>
            <input type="text" id="course_level" name="course_level" value="<?php echo esc_attr($level); ?>" placeholder="e.g. Beginner / All Levels" />
        </div>
        <div class="driveria-meta-field">
            <label for="course_badge"><?php _e('Badge Tag', 'driveria'); ?></label>
            <input type="text" id="course_badge" name="course_badge" value="<?php echo esc_attr($badge); ?>" placeholder="e.g. Popular, Best Seller" />
        </div>
        <div class="driveria-meta-field">
            <label for="course_product_id"><?php _e('WooCommerce Product ID or Link', 'driveria'); ?></label>
            <input type="text" id="course_product_id" name="course_product_id" value="<?php echo esc_attr($product_id); ?>" placeholder="e.g. 142 or /checkout/?add-to-cart=142" />
            <small><?php _e('Enter Product ID (e.g. 142) or custom checkout link.', 'driveria'); ?></small>
        </div>
        <div class="driveria-meta-field" style="grid-column: 1 / -1;">
            <label for="course_features"><?php _e('Course Card Features / Bullet Points (Enter 1 Feature per line - Overrides default metrics)', 'driveria'); ?></label>
            <textarea id="course_features" name="course_features" rows="4" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 8px 12px;" placeholder="<?php esc_attr_e("Free Pickup & Drop-off Facility\nDMV-Approved Curriculum Certificate\nCar Provided for Road Test", 'driveria'); ?>"><?php echo esc_textarea($features); ?></textarea>
            <small><?php _e('Enter custom features to display in the card. If left empty, it will fall back to showing the Duration, Lessons, and Skill Level metrics.', 'driveria'); ?></small>
        </div>
        <div class="driveria-meta-field" style="grid-column: 1 / -1;">
            <label for="course_learn_topics"><?php _e('What You Will Learn In This Program (Enter 1 Topic per line)', 'driveria'); ?></label>
            <textarea id="course_learn_topics" name="course_learn_topics" rows="5" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 8px 12px;" placeholder="<?php esc_attr_e("Master vehicle controls, cockpit setup, and mirror alignment\nParallel parking, three-point turns, and reverse driving skills\nHighway merging, lane positioning, and night driving confidence", 'driveria'); ?>"><?php echo esc_textarea($learn_topics); ?></textarea>
            <small><?php _e('Enter custom learning points for this course (1 topic per line).', 'driveria'); ?></small>
        </div>
    </div>
    <?php
}

function driveria_save_course_meta_box($post_id) {
    if (!isset($_POST['driveria_course_meta_nonce']) || !wp_verify_nonce($_POST['driveria_course_meta_nonce'], 'driveria_save_course_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array('course_price', 'course_duration', 'course_lessons', 'course_level', 'course_badge', 'course_product_id');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $val = sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, '_' . $field, $val);
            update_post_meta($post_id, $field, $val);
        }
    }

    if (isset($_POST['course_learn_topics'])) {
        $topics_val = sanitize_textarea_field($_POST['course_learn_topics']);
        update_post_meta($post_id, '_course_learn_topics', $topics_val);
        update_post_meta($post_id, 'course_learn_topics', $topics_val);
    }

    if (isset($_POST['course_features'])) {
        $features_val = sanitize_textarea_field($_POST['course_features']);
        update_post_meta($post_id, '_course_features', $features_val);
        update_post_meta($post_id, 'course_features', $features_val);
    }
}
add_action('save_post', 'driveria_save_course_meta_box');

/**
 * Helper to get Course Checkout URL or External Payment Link
 */
function driveria_get_course_checkout_url($post_id) {
    if (empty($post_id)) {
        return '';
    }

    $product_id_or_url = driveria_get_course_meta($post_id, 'course_product_id', '');
    if (empty($product_id_or_url)) {
        return '#enroll-registration';
    }

    $trimmed = trim($product_id_or_url);
    $trimmed_clean = rtrim($trimmed, '?:');

    if (filter_var($trimmed_clean, FILTER_VALIDATE_URL) || stripos($trimmed_clean, 'http') === 0 || stripos($trimmed_clean, 'square.link') !== false || strpos($trimmed_clean, '/') === 0) {
        return esc_url_raw($trimmed_clean);
    }

    if (is_numeric($trimmed_clean)) {
        $product_id = intval($trimmed_clean);
        if (function_exists('wc_get_checkout_url')) {
            return add_query_arg('add-to-cart', $product_id, wc_get_checkout_url());
        }
        return home_url('/checkout/?add-to-cart=' . $product_id);
    }

    return esc_url_raw($trimmed_clean);
}

/**
 * Register Native Meta Box for Driveria Instructor Custom Fields
 */
function driveria_add_instructor_meta_box() {
    add_meta_box(
        'driveria_instructor_details_box',
        __('Instructor Details & Meta Settings', 'driveria'),
        'driveria_render_instructor_meta_box',
        'driveria_instructor',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'driveria_add_instructor_meta_box');

function driveria_render_instructor_meta_box($post) {
    wp_nonce_field('driveria_save_instructor_meta', 'driveria_instructor_meta_nonce');

    $role = get_post_meta($post->ID, '_instructor_role', true) ?: get_post_meta($post->ID, 'instructor_role', true);
    $exp  = get_post_meta($post->ID, '_instructor_exp', true) ?: get_post_meta($post->ID, 'instructor_exp', true);
    ?>
    <style>
        .driveria-meta-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px; padding: 10px 0; }
        .driveria-meta-field { display: flex; flex-direction: column; gap: 5px; }
        .driveria-meta-field label { font-weight: 600; color: #1e293b; }
        .driveria-meta-field input { padding: 8px 12px; border-radius: 6px; border: 1px solid #cbd5e1; }
    </style>
    <div class="driveria-meta-grid">
        <div class="driveria-meta-field">
            <label for="instructor_role"><?php _e('Designation / Role', 'driveria'); ?></label>
            <input type="text" id="instructor_role" name="instructor_role" value="<?php echo esc_attr($role ?: 'Senior Driving Instructor'); ?>" placeholder="e.g. Senior Driving Instructor" />
        </div>
        <div class="driveria-meta-field">
            <label for="instructor_exp"><?php _e('Experience Tag', 'driveria'); ?></label>
            <input type="text" id="instructor_exp" name="instructor_exp" value="<?php echo esc_attr($exp ?: '7+ Years Experience'); ?>" placeholder="e.g. 7+ Years Experience" />
        </div>
    </div>
    <?php
}

function driveria_save_instructor_meta_box($post_id) {
    if (!isset($_POST['driveria_instructor_meta_nonce']) || !wp_verify_nonce($_POST['driveria_instructor_meta_nonce'], 'driveria_save_instructor_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array('instructor_role', 'instructor_exp');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $val = sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, '_' . $field, $val);
            update_post_meta($post_id, $field, $val);
        }
    }
}
add_action('save_post_driveria_instructor', 'driveria_save_instructor_meta_box');

/**
 * Render Automatic Dynamic Page Header Banner with Breadcrumbs
 */
function driveria_render_page_header($custom_title = '', $custom_subtitle = '') {
    if (is_front_page()) {
        return;
    }

    global $post;
    $title = $custom_title;
    $subtitle = $custom_subtitle;

    if (empty($title)) {
        if (is_home()) {
            $title = get_option('page_for_posts') ? get_the_title(get_option('page_for_posts')) : __('News & Announcements', 'driveria');
            $subtitle = __('Stay updated with driving safety tips, DMV news, and academy updates.', 'driveria');
        } elseif (is_single()) {
            if (get_post_type() === 'driveria_course') {
                $title = get_the_title();
                $subtitle = __('DMV Accredited Driving Course & Behind-The-Wheel Training Program', 'driveria');
            } else {
                $title = get_the_title();
            }
        } elseif (is_page()) {
            $title = get_the_title();
        } elseif (is_post_type_archive('driveria_course')) {
            $title = __('Our Driving Courses & Training Programs', 'driveria');
            $subtitle = __('State-approved driving lessons tailored for teens, adults, and DMV road test prep.', 'driveria');
        } elseif (is_archive()) {
            $title = get_the_archive_title();
        } elseif (is_search()) {
            $title = sprintf(__('Search Results for: "%s"', 'driveria'), get_search_query());
        } elseif (is_404()) {
            $title = __('404 - Page Not Found', 'driveria');
            $subtitle = __('The page you are looking for might have been moved or deleted.', 'driveria');
        } else {
            $title = get_the_title();
        }
    }

    if (empty($subtitle) && is_page()) {
        $page_desc = get_post_meta(get_the_ID(), '_driveria_page_subtitle', true);
        if ($page_desc) {
            $subtitle = $page_desc;
        } else {
            $subtitle = __('Prime Driving School – DMV Accredited Driving Academy', 'driveria');
        }
    }
    ?>
    <section class="driveria-page-header">
        <div class="header-pattern-bg"></div>
        <div class="driveria-container header-inner-wrap">
            <div class="page-title-box">
                <span class="header-badge-tag"><i class="fa-solid fa-shield-halved"></i> <?php esc_html_e('Prime Driving School', 'driveria'); ?></span>
                <h1 class="page-title"><?php echo wp_kses_post($title); ?></h1>
                <?php if (!empty($subtitle)) : ?>
                    <p class="page-subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>
            
            <!-- Breadcrumbs -->
            <div class="header-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="bc-home"><i class="fa-solid fa-house"></i> <?php esc_html_e('Home', 'driveria'); ?></a>
                
                <?php
                if (is_page() && isset($post->post_parent) && $post->post_parent) {
                    $anc = array_reverse(get_post_ancestors($post->ID));
                    foreach ($anc as $ancestor) {
                        echo '<i class="fa-solid fa-chevron-right bc-sep"></i>';
                        echo '<a href="' . esc_url(get_permalink($ancestor)) . '">' . esc_html(get_the_title($ancestor)) . '</a>';
                    }
                } elseif (is_single()) {
                    if (get_post_type() === 'driveria_course') {
                        echo '<i class="fa-solid fa-chevron-right bc-sep"></i>';
                        echo '<a href="' . esc_url(get_post_type_archive_link('driveria_course')) . '">' . esc_html__('Courses', 'driveria') . '</a>';
                    } else {
                        $cats = get_the_category();
                        if (!empty($cats)) {
                            echo '<i class="fa-solid fa-chevron-right bc-sep"></i>';
                            echo '<a href="' . esc_url(get_category_link($cats[0]->term_id)) . '">' . esc_html($cats[0]->name) . '</a>';
                        }
                    }
                }
                ?>
                <i class="fa-solid fa-chevron-right bc-sep"></i>
                <span class="bc-current"><?php echo esc_html(wp_strip_all_tags($title)); ?></span>
            </div>
        </div>
    </section>

    <?php
}

/**
 * Register Custom Meta Box for Post Guest Author Info
 */
function driveria_add_post_meta_boxes() {
    add_meta_box(
        'driveria_post_guest_author',
        __('Guest Author Information', 'driveria'),
        'driveria_render_post_guest_author_meta_box',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'driveria_add_post_meta_boxes');

/**
 * Render Post Guest Author Meta Box
 */
function driveria_render_post_guest_author_meta_box($post) {
    $guest_name  = get_post_meta($post->ID, '_guest_author_name', true) ?: get_post_meta($post->ID, 'guest_author_name', true);
    $guest_bio   = get_post_meta($post->ID, '_guest_author_bio', true) ?: get_post_meta($post->ID, 'guest_author_bio', true);
    $guest_email = get_post_meta($post->ID, '_guest_author_email', true) ?: get_post_meta($post->ID, 'guest_author_email', true);
    $guest_img   = get_post_meta($post->ID, '_guest_author_image', true) ?: get_post_meta($post->ID, 'guest_author_image', true);
    
    wp_nonce_field('driveria_save_guest_author', 'driveria_guest_author_nonce');
    ?>
    <style>
        .guest-meta-field { margin-bottom: 15px; }
        .guest-meta-field label { display: block; font-weight: bold; margin-bottom: 5px; color: #1E293B; }
        .guest-meta-field input[type="text"], 
        .guest-meta-field input[type="email"], 
        .guest-meta-field textarea { width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 12px; font-size: 14px; box-sizing: border-box; }
    </style>
    <div class="guest-meta-fields">
        <div class="guest-meta-field">
            <label for="guest_author_name"><?php _e('Guest Author Name', 'driveria'); ?></label>
            <input type="text" id="guest_author_name" name="guest_author_name" value="<?php echo esc_attr($guest_name); ?>" placeholder="e.g. Kyra Chawla" />
        </div>
        <div class="guest-meta-field">
            <label for="guest_author_email"><?php _e('Guest Author Email (for mail icon)', 'driveria'); ?></label>
            <input type="email" id="guest_author_email" name="guest_author_email" value="<?php echo esc_attr($guest_email); ?>" placeholder="e.g. kyra.chawla@gmail.com" />
        </div>
        <div class="guest-meta-field">
            <label for="guest_author_image"><?php _e('Guest Author Image URL (Profile Picture)', 'driveria'); ?></label>
            <input type="text" id="guest_author_image" name="guest_author_image" value="<?php echo esc_attr($guest_img); ?>" placeholder="Paste image URL from Media Library" />
            <small style="color: #64748b;"><?php _e('Upload profile picture to Media Library, copy its File URL, and paste it here.', 'driveria'); ?></small>
        </div>
        <div class="guest-meta-field">
            <label for="guest_author_bio"><?php _e('Guest Author Biography', 'driveria'); ?></label>
            <textarea id="guest_author_bio" name="guest_author_bio" rows="4" placeholder="Write a short biography about the guest author..."><?php echo esc_textarea($guest_bio); ?></textarea>
        </div>
    </div>
    <?php
}

/**
 * Save Guest Author Meta Box Values
 */
function driveria_save_guest_author_meta($post_id) {
    if (!isset($_POST['driveria_guest_author_nonce']) || !wp_verify_nonce($_POST['driveria_guest_author_nonce'], 'driveria_save_guest_author')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['guest_author_name'])) {
        $name_val = sanitize_text_field($_POST['guest_author_name']);
        update_post_meta($post_id, '_guest_author_name', $name_val);
        update_post_meta($post_id, 'guest_author_name', $name_val);
    }
    if (isset($_POST['guest_author_email'])) {
        $email_val = sanitize_email($_POST['guest_author_email']);
        update_post_meta($post_id, '_guest_author_email', $email_val);
        update_post_meta($post_id, 'guest_author_email', $email_val);
    }
    if (isset($_POST['guest_author_image'])) {
        $img_val = esc_url_raw($_POST['guest_author_image']);
        update_post_meta($post_id, '_guest_author_image', $img_val);
        update_post_meta($post_id, 'guest_author_image', $img_val);
    }
    if (isset($_POST['guest_author_bio'])) {
        $bio_val = sanitize_textarea_field($_POST['guest_author_bio']);
        update_post_meta($post_id, '_guest_author_bio', $bio_val);
        update_post_meta($post_id, 'guest_author_bio', $bio_val);
    }
}
add_action('save_post', 'driveria_save_guest_author_meta');



/**
 * --------------------------------------------------------------------------
 * GOOGLE RECAPTCHA V2 INTEGRATION (Universal for all Driveria Forms)
 * --------------------------------------------------------------------------
 */
add_action('wp_enqueue_scripts', function () {
    // 1. Enqueue Google reCAPTCHA v2 Script
    wp_enqueue_script('google-recaptcha', 'https://www.google.com/recaptcha/api.js?onload=driveriaRecaptchaInit&render=explicit', array(), null, true);
    
    // 2. Inline JavaScript to auto-inject reCAPTCHA in all forms and validate on submit
    $recaptcha_site_key = '6LepeKctAAAAABinDDLA26-5U651IaC73jkszqix';
    $custom_js = "
    window.driveriaRecaptchaInit = function () {
        if (typeof grecaptcha === 'undefined') return;
        var forms = document.querySelectorAll('.driveria-ajax-form, #driveriaBookingForm, #driveriaQuickEnrollForm, #driveriaModalEnrollForm, #driveriaAppointmentForm, #driveria-contact-page-form, #driveriaSidebarEnrollForm');
        forms.forEach(function (form) {
            var box = form.querySelector('.driveria-recaptcha-box');
            if (!box) {
                var wrap = document.createElement('div');
                wrap.className = 'driveria-recaptcha-wrap';
                wrap.style.cssText = 'display:flex; justify-content:flex-start; margin:15px 0 20px 0;';
                box = document.createElement('div');
                box.className = 'driveria-recaptcha-box';
                wrap.appendChild(box);
                var btn = form.querySelector('button[type=\"submit\"], input[type=\"submit\"], .btn-enroll-submit, .btn-shimmer-submit');
                if (btn) {
                    btn.parentNode.insertBefore(wrap, btn);
                } else {
                    form.appendChild(wrap);
                }
            }
            if (!box.getAttribute('data-widget-id') && box.children.length === 0) {
                try {
                    var widgetId = grecaptcha.render(box, { 'sitekey': '" . esc_js($recaptcha_site_key) . "' });
                    box.setAttribute('data-widget-id', widgetId);
                    form.setAttribute('data-recaptcha-widget-id', widgetId);
                } catch(e) {}
            }
        });
    };
    if (typeof grecaptcha !== 'undefined' && grecaptcha.render) {
        window.driveriaRecaptchaInit();
    }
    ";
    wp_add_inline_script('google-recaptcha', $custom_js);
}, 99);

// 3. Backend Verification in Booking / Form Submission Handler
add_action('wp_ajax_driveria_submit_booking', 'driveria_verify_recaptcha_check', 1);
add_action('wp_ajax_nopriv_driveria_submit_booking', 'driveria_verify_recaptcha_check', 1);

function driveria_verify_recaptcha_check() {
    $secret_key = '6LepeKctAAAAACmp5rp45p3F1Mc259vLupXBmjIu';
    $recaptcha_token = isset($_POST['g-recaptcha-response']) ? sanitize_text_field($_POST['g-recaptcha-response']) : '';

    if (empty($recaptcha_token)) {
        wp_send_json_error(array('message' => 'Please verify that you are not a robot (reCAPTCHA is required).'));
    }

    $verify_res = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', array(
        'body' => array(
            'secret'   => $secret_key,
            'response' => $recaptcha_token,
            'remoteip' => isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : '',
        ),
        'timeout' => 15,
    ));

    if (is_wp_error($verify_res)) {
        wp_send_json_error(array('message' => 'Security check error. Please try again.'));
    }

    $body = json_decode(wp_remote_retrieve_body($verify_res), true);
    if (empty($body['success'])) {
        wp_send_json_error(array('message' => 'reCAPTCHA verification failed. Please try again.'));
    }
}

