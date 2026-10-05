<?php
/**
 * Driveria Theme Customizer Integration with Complete Homepage Content Editing
 *
 * @package Driveria
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('driveria_customize_register')) {
    function driveria_customize_register($wp_customize) {
        // Panel: Driveria Theme Options
        $wp_customize->add_panel('driveria_theme_panel', array(
            'title'       => __('Driving GP Options', 'driveria'),
            'description' => __('Customize Logo, Header, Hero Slider, Sections, Content, Headings & Images.', 'driveria'),
            'priority'    => 10,
        ));

        // -------------------------------------------------------------
        // SECTION 1: Logo & Branding Options
        // -------------------------------------------------------------
        $wp_customize->add_section('driveria_logo_section', array(
            'title'    => __('Logo & Header Customization', 'driveria'),
            'panel'    => 'driveria_theme_panel',
            'priority' => 5,
        ));

        // Custom Logo Image Upload
        $wp_customize->add_setting('driveria_custom_logo_img', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'driveria_custom_logo_img', array(
            'label'    => __('Upload Custom Logo Image', 'driveria'),
            'section'  => 'driveria_logo_section',
        )));

        // Logo Width Adjustment (px)
        $wp_customize->add_setting('driveria_logo_width', array(
            'default'           => 180,
            'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control('driveria_logo_width', array(
            'label'       => __('Logo Max Width (px)', 'driveria'),
            'description' => __('Adjust your logo width (e.g. 150 to 300px)', 'driveria'),
            'section'     => 'driveria_logo_section',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 50,
                'max'  => 400,
                'step' => 5,
            ),
        ));

        // Logo Height Adjustment (px)
        $wp_customize->add_setting('driveria_logo_height', array(
            'default'           => 60,
            'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control('driveria_logo_height', array(
            'label'       => __('Logo Max Height (px)', 'driveria'),
            'description' => __('Adjust your logo height (e.g. 40 to 100px)', 'driveria'),
            'section'     => 'driveria_logo_section',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 20,
                'max'  => 200,
                'step' => 5,
            ),
        ));

        // -------------------------------------------------------------
        // SECTION 2: Top Bar & Contact Info
        // -------------------------------------------------------------
        $wp_customize->add_section('driveria_contact_section', array(
            'title'    => __('Header & Contact Info', 'driveria'),
            'panel'    => 'driveria_theme_panel',
            'priority' => 10,
        ));

        $wp_customize->add_setting('driveria_phone', array(
            'default'           => '+1 (555) 234-5678',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('driveria_phone', array(
            'label'    => __('Phone Number', 'driveria'),
            'section'  => 'driveria_contact_section',
            'type'     => 'text',
        ));

        $wp_customize->add_setting('driveria_email', array(
            'default'           => 'info@driveria-school.com',
            'sanitize_callback' => 'sanitize_email',
        ));
        $wp_customize->add_control('driveria_email', array(
            'label'    => __('Email Address', 'driveria'),
            'section'  => 'driveria_contact_section',
            'type'     => 'email',
        ));

        $wp_customize->add_setting('driveria_header_btn_text', array(
            'default'           => 'CONTACT US',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('driveria_header_btn_text', array(
            'label'    => __('Header CTA Button Text', 'driveria'),
            'section'  => 'driveria_contact_section',
            'type'     => 'text',
        ));

        // -------------------------------------------------------------
        // SECTION 3: Hero Section & Bottom Cards
        // -------------------------------------------------------------
        $wp_customize->add_section('driveria_hero_section', array(
            'title'    => __('Homepage Hero Slider & Feature Cards', 'driveria'),
            'panel'    => 'driveria_theme_panel',
            'priority' => 20,
        ));

        // Hero Title
        $wp_customize->add_setting('driveria_hero_title', array(
            'default'           => 'BEST DRIVING LESSONS & TRAFFIC SCHOOL',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('driveria_hero_title', array(
            'label'    => __('Hero Title Heading', 'driveria'),
            'section'  => 'driveria_hero_section',
            'type'     => 'text',
        ));

        // Hero Subtitle
        $wp_customize->add_setting('driveria_hero_desc', array(
            'default'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control('driveria_hero_desc', array(
            'label'    => __('Hero Subtitle / Description', 'driveria'),
            'section'  => 'driveria_hero_section',
            'type'     => 'textarea',
        ));

        // Primary CTA Button Text
        $wp_customize->add_setting('driveria_hero_btn_text', array(
            'default'           => 'REGISTER NOW',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('driveria_hero_btn_text', array(
            'label'    => __('Hero Button Text', 'driveria'),
            'section'  => 'driveria_hero_section',
            'type'     => 'text',
        ));

        // Background Image Slide 1
        $wp_customize->add_setting('driveria_hero_bg1', array(
            'default'           => 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&w=1920&q=80',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'driveria_hero_bg1', array(
            'label'    => __('Hero Background Image 1', 'driveria'),
            'section'  => 'driveria_hero_section',
        )));

        // Background Image Slide 2
        $wp_customize->add_setting('driveria_hero_bg2', array(
            'default'           => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=1920&q=80',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'driveria_hero_bg2', array(
            'label'    => __('Hero Background Image 2', 'driveria'),
            'section'  => 'driveria_hero_section',
        )));

        // Background Image Slide 3
        $wp_customize->add_setting('driveria_hero_bg3', array(
            'default'           => 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=1920&q=80',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'driveria_hero_bg3', array(
            'label'    => __('Hero Background Image 3', 'driveria'),
            'section'  => 'driveria_hero_section',
        )));

        // Hero Bottom Card 1 Title & Desc
        $wp_customize->add_setting('driveria_hero_card1_title', array('default' => 'Affordable Pricing', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_hero_card1_title', array('label' => __('Feature Card 1 Title', 'driveria'), 'section' => 'driveria_hero_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_hero_card1_desc', array('default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'sanitize_callback' => 'sanitize_textarea_field'));
        $wp_customize->add_control('driveria_hero_card1_desc', array('label' => __('Feature Card 1 Description', 'driveria'), 'section' => 'driveria_hero_section', 'type' => 'textarea'));

        // Hero Bottom Card 2 Title & Desc
        $wp_customize->add_setting('driveria_hero_card2_title', array('default' => 'Safety Driving', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_hero_card2_title', array('label' => __('Feature Card 2 Title', 'driveria'), 'section' => 'driveria_hero_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_hero_card2_desc', array('default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'sanitize_callback' => 'sanitize_textarea_field'));
        $wp_customize->add_control('driveria_hero_card2_desc', array('label' => __('Feature Card 2 Description', 'driveria'), 'section' => 'driveria_hero_section', 'type' => 'textarea'));

        // Hero Bottom Card 3 Title & Desc
        $wp_customize->add_setting('driveria_hero_card3_title', array('default' => 'Traffic Rules', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_hero_card3_title', array('label' => __('Feature Card 3 Title', 'driveria'), 'section' => 'driveria_hero_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_hero_card3_desc', array('default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'sanitize_callback' => 'sanitize_textarea_field'));
        $wp_customize->add_control('driveria_hero_card3_desc', array('label' => __('Feature Card 3 Description', 'driveria'), 'section' => 'driveria_hero_section', 'type' => 'textarea'));

        // Hero Bottom Card 4 Image Upload
        $wp_customize->add_setting('driveria_hero_card4_img', array(
            'default'           => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=800&q=80',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'driveria_hero_card4_img', array(
            'label'    => __('Feature Card 4 Image', 'driveria'),
            'section'  => 'driveria_hero_section',
        )));

        // -------------------------------------------------------------
        // SECTION 4: Homepage Enroll Registration Form Section
        // -------------------------------------------------------------
        $wp_customize->add_section('driveria_home_enroll_section', array(
            'title'    => __('Homepage Enroll Registration Section', 'driveria'),
            'panel'    => 'driveria_theme_panel',
            'priority' => 25,
        ));

        $wp_customize->add_setting('driveria_enroll_subtitle', array('default' => 'Online Registration Available', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_enroll_subtitle', array('label' => __('Enroll Subtitle Accent', 'driveria'), 'section' => 'driveria_home_enroll_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_enroll_heading', array('default' => 'ENROLL IN DMV-APPROVED DRIVER TRAINING TODAY!', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_enroll_heading', array('label' => __('Enroll Main Heading', 'driveria'), 'section' => 'driveria_home_enroll_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_enroll_desc', array('default' => 'As one of the Best Driving Schools near you, we are proud to offer programs designed to help new drivers learn essential skills with ease.', 'sanitize_callback' => 'sanitize_textarea_field'));
        $wp_customize->add_control('driveria_enroll_desc', array('label' => __('Enroll Description', 'driveria'), 'section' => 'driveria_home_enroll_section', 'type' => 'textarea'));

        // -------------------------------------------------------------
        // SECTION 5: Homepage Programs & Why Choose Us
        // -------------------------------------------------------------
        $wp_customize->add_section('driveria_home_whyus_section', array(
            'title'    => __('Homepage Programs & Why Choose Us', 'driveria'),
            'panel'    => 'driveria_theme_panel',
            'priority' => 28,
        ));

        // Courses Header
        $wp_customize->add_setting('driveria_courses_subtitle', array('default' => 'Our Programs', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_courses_subtitle', array('label' => __('Courses Subtitle', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_courses_title', array('default' => 'Popular Driving Courses', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_courses_title', array('label' => __('Courses Title', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_courses_desc', array('default' => 'Choose from specialized packages designed for beginners, teens, adults, and defensive drivers.', 'sanitize_callback' => 'sanitize_textarea_field'));
        $wp_customize->add_control('driveria_courses_desc', array('label' => __('Courses Description', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'textarea'));

        // Why Choose Us Content
        $wp_customize->add_setting('driveria_whyus_subtitle', array('default' => 'Why Choose Driveria', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_whyus_subtitle', array('label' => __('Why Us Subtitle', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_whyus_title', array('default' => 'We Build Confident & Safe Drivers For Life', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_whyus_title', array('label' => __('Why Us Title', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_whyus_desc', array('default' => 'Our driving academy combines structured lesson plans, patient certified instructors, and high safety standards to make learning to drive stress-free.', 'sanitize_callback' => 'sanitize_textarea_field'));
        $wp_customize->add_control('driveria_whyus_desc', array('label' => __('Why Us Description', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'textarea'));

        // Why Us Image
        $wp_customize->add_setting('driveria_whyus_img', array('default' => 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&w=800&q=80', 'sanitize_callback' => 'esc_url_raw'));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'driveria_whyus_img', array('label' => __('Why Us Image', 'driveria'), 'section' => 'driveria_home_whyus_section')));

        // Experience Badge
        $wp_customize->add_setting('driveria_whyus_exp_num', array('default' => '15+', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_whyus_exp_num', array('label' => __('Experience Badge Number', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_whyus_exp_text', array('default' => 'Years of Excellence', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_whyus_exp_text', array('label' => __('Experience Badge Text', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'text'));

        // Checklist 1
        $wp_customize->add_setting('driveria_whyus_chk1_title', array('default' => 'Free Doorstep Pickup & Drop-off', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_whyus_chk1_title', array('label' => __('Checklist 1 Title', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'text'));
        $wp_customize->add_setting('driveria_whyus_chk1_desc', array('default' => 'We pick you up directly from your home, school, or workplace for every behind-the-wheel lesson.', 'sanitize_callback' => 'sanitize_textarea_field'));
        $wp_customize->add_control('driveria_whyus_chk1_desc', array('label' => __('Checklist 1 Description', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'textarea'));

        // Checklist 2
        $wp_customize->add_setting('driveria_whyus_chk2_title', array('default' => 'Dual-Control Fleet Inspection', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_whyus_chk2_title', array('label' => __('Checklist 2 Title', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'text'));
        $wp_customize->add_setting('driveria_whyus_chk2_desc', array('default' => 'All training vehicles are regularly inspected, dual-controlled, insured, and climate-controlled.', 'sanitize_callback' => 'sanitize_textarea_field'));
        $wp_customize->add_control('driveria_whyus_chk2_desc', array('label' => __('Checklist 2 Description', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'textarea'));

        // Checklist 3
        $wp_customize->add_setting('driveria_whyus_chk3_title', array('default' => 'Flexible Pay-As-You-Go Payment Plans', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_whyus_chk3_title', array('label' => __('Checklist 3 Title', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'text'));
        $wp_customize->add_setting('driveria_whyus_chk3_desc', array('default' => 'Affordable course packages with no hidden fees and easy installment payment options.', 'sanitize_callback' => 'sanitize_textarea_field'));
        $wp_customize->add_control('driveria_whyus_chk3_desc', array('label' => __('Checklist 3 Description', 'driveria'), 'section' => 'driveria_home_whyus_section', 'type' => 'textarea'));

        // -------------------------------------------------------------
        // SECTION 6: Brand Colors
        // -------------------------------------------------------------
        $wp_customize->add_section('driveria_colors_section', array(
            'title'    => __('Brand Colors', 'driveria'),
            'panel'    => 'driveria_theme_panel',
            'priority' => 30,
        ));

        $wp_customize->add_setting('driveria_primary_color', array(
            'default'           => '#FFB800',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'driveria_primary_color', array(
            'label'    => __('Primary Accent Color (Yellow)', 'driveria'),
            'section'  => 'driveria_colors_section',
        )));

        // -------------------------------------------------------------
        // SECTION 7: Payment & WooCommerce Redirect Options
        // -------------------------------------------------------------
        $wp_customize->add_section('driveria_payment_section', array(
            'title'    => __('Payment & WooCommerce Redirect', 'driveria'),
            'panel'    => 'driveria_theme_panel',
            'priority' => 35,
        ));

        $wp_customize->add_setting('driveria_enable_payment_redirect', array(
            'default'           => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
        ));
        $wp_customize->add_control('driveria_enable_payment_redirect', array(
            'label'       => __('Enable Automatic Payment Redirect', 'driveria'),
            'description' => __('When enabled, submitting the enroll form will automatically redirect the user to the checkout/payment page after submission.', 'driveria'),
            'section'     => 'driveria_payment_section',
            'type'        => 'checkbox',
        ));

        $wp_customize->add_setting('driveria_payment_redirect_url', array(
            'default'           => home_url('/checkout/'),
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('driveria_payment_redirect_url', array(
            'label'       => __('WooCommerce Checkout / Payment Page URL', 'driveria'),
            'description' => __('Enter your WooCommerce checkout URL or custom payment page link.', 'driveria'),
            'section'     => 'driveria_payment_section',
            'type'        => 'url',
        ));

        // Venmo Customizer Controls
        $wp_customize->add_setting('driveria_venmo_handle', array(
            'default'           => 'Sunil-Shukla-3',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('driveria_venmo_handle', array(
            'label'       => __('Venmo Username / Business Handle', 'driveria'),
            'description' => __('Enter your Venmo business handle (e.g. Sunil-Shukla-3 or https://venmo.com/u/Sunil-Shukla-3).', 'driveria'),
            'section'     => 'driveria_payment_section',
            'type'        => 'text',
        ));

        $wp_customize->add_setting('driveria_venmo_number', array(
            'default'           => '5715013404',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('driveria_venmo_number', array(
            'label'       => __('Venmo Phone / ID Number', 'driveria'),
            'section'     => 'driveria_payment_section',
            'type'        => 'text',
        ));

        // Zelle Customizer Controls
        $wp_customize->add_setting('driveria_zelle_handle', array(
            'default'           => 'Prime Driving SCHOOL',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('driveria_zelle_handle', array(
            'label'       => __('Zelle Account Name', 'driveria'),
            'section'     => 'driveria_payment_section',
            'type'        => 'text',
        ));

        $wp_customize->add_setting('driveria_zelle_number', array(
            'default'           => '5715013404',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('driveria_zelle_number', array(
            'label'       => __('Zelle Phone / ID', 'driveria'),
            'section'     => 'driveria_payment_section',
            'type'        => 'text',
        ));

        // -------------------------------------------------------------
        // SECTION 8: Footer Content & Contact Customization
        // -------------------------------------------------------------
        $wp_customize->add_section('driveria_footer_section', array(
            'title'    => __('Footer Text & Contact Info', 'driveria'),
            'panel'    => 'driveria_theme_panel',
            'priority' => 40,
        ));

        $wp_customize->add_setting('driveria_footer_quick_title', array('default' => 'Quick Links', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_footer_quick_title', array('label' => __('Quick Links Column Title', 'driveria'), 'section' => 'driveria_footer_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_footer_prog_title', array('default' => 'Driving Programs', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_footer_prog_title', array('label' => __('Driving Programs Column Title', 'driveria'), 'section' => 'driveria_footer_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_footer_desc', array('default' => 'Driveria is a premier accredited driving academy committed to creating safe, confident, and skilled drivers for life.', 'sanitize_callback' => 'sanitize_textarea_field'));
        $wp_customize->add_control('driveria_footer_desc', array('label' => __('Footer About Description', 'driveria'), 'section' => 'driveria_footer_section', 'type' => 'textarea'));

        $wp_customize->add_setting('driveria_address', array('default' => '123 Safety Drive, Metro City', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_address', array('label' => __('Academy Address', 'driveria'), 'section' => 'driveria_footer_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_hours', array('default' => 'Mon - Sat: 8:00 AM - 6:00 PM', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_hours', array('label' => __('Working Hours', 'driveria'), 'section' => 'driveria_footer_section', 'type' => 'text'));

        $wp_customize->add_setting('driveria_copyright', array('default' => '© Driveria Driving School. All Rights Reserved.', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('driveria_copyright', array('label' => __('Copyright Text', 'driveria'), 'section' => 'driveria_footer_section', 'type' => 'text'));
    }
}
add_action('customize_register', 'driveria_customize_register');

/**
 * Output Dynamic CSS in wp_head
 */
if (!function_exists('driveria_customizer_css')) {
    function driveria_customizer_css() {
        $primary_color = get_theme_mod('driveria_primary_color', '#FFB800');
        $logo_width    = get_theme_mod('driveria_logo_width', 180);
        $logo_height   = get_theme_mod('driveria_logo_height', 60);
        ?>
        <style type="text/css">
            :root {
                --driveria-primary: <?php echo esc_html($primary_color); ?>;
            }
            .custom-brand-logo img,
            .site-branding img {
                max-width: <?php echo esc_html($logo_width); ?>px !important;
                max-height: <?php echo esc_html($logo_height); ?>px !important;
                height: auto;
                width: auto;
                object-fit: contain;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'driveria_customizer_css');
