<?php
/**
 * Driveria Theme Header Template - Transparent Overlay & Customizable Logo
 *
 * @package Driveria
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    
    <!-- Preconnect & DNS-Prefetch for Speed Optimization -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://images.unsplash.com">
    
    <!-- Google Fonts: Oswald (Headings) & Heebo (Body) -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Heebo:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 Icons (Loaded Asynchronously to Avoid Render Blocking) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>
    
    <!-- High Priority Hero Image Preload for Instant Loading -->
    <?php 
    if (is_front_page()) : 
        $hero_bg1 = get_theme_mod('driveria_hero_bg1', 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&w=1920&q=80');
        if ($hero_bg1) :
    ?>
        <link rel="preload" as="image" href="<?php echo esc_url($hero_bg1); ?>" fetchpriority="high">
    <?php 
        endif; 
    endif; 
    ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header Navigation Bar (Overlay transparent header) -->
<header class="driveria-header" id="site-header">
    <div class="driveria-container header-inner">
        <!-- Site Logo (Customizer Logo Image or Text) -->
        <div class="site-branding">
            <?php 
            $custom_logo = get_theme_mod('driveria_custom_logo_img');
            if ($custom_logo) : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-brand-logo">
                    <img src="<?php echo esc_url($custom_logo); ?>" alt="<?php bloginfo('name'); ?>" />
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-brand-logo">
                    <div class="brand-icon"><i class="fa-solid fa-steering-wheel"></i></div>
                    <span class="brand-name">Driver<span class="brand-accent">ia</span></span>
                </a>
            <?php endif; ?>
        </div>

        <!-- Desktop Navigation Menu -->
        <nav class="main-navigation" id="site-navigation">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'depth'          => 2,
                ));
            } else {
                ?>
                <ul class="nav-menu">
                    <?php wp_list_pages(array('title_li' => '', 'depth' => 1)); ?>
                </ul>
                <?php
            }
            ?>
        </nav>

        <!-- Right Header Action Button -->
        <div class="header-actions">
            <a href="<?php echo esc_url(driveria_get_page_url('Contact Us', 'contact')); ?>" class="btn-driveria btn-primary-driveria header-cta-btn">
                <i class="fa-solid fa-phone"></i>
                <span><?php echo esc_html(get_theme_mod('driveria_header_btn_text', 'CONTACT US')); ?></span>
            </a>

            <!-- Header Appointment Menu Icon Button (Opens Appointment Form) -->
            <button class="header-appointment-btn open-appointment-modal" id="headerAppointmentBtn" aria-label="Get Appointment" title="Get Appointment">
                <span class="app-bar bar-1"></span>
                <span class="app-bar bar-2"></span>
                <span class="app-bar bar-3"></span>
            </button>

            <!-- Mobile Hamburger Button -->
            <button class="mobile-nav-toggle" id="mobileMenuBtn" aria-label="Toggle navigation">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Navigation Drawer -->
<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-header">
        <div class="site-branding">
            <?php 
            $custom_logo = get_theme_mod('driveria_custom_logo_img');
            if ($custom_logo) : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-brand-logo">
                    <img src="<?php echo esc_url($custom_logo); ?>" alt="<?php bloginfo('name'); ?>" />
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-brand-logo">
                    <div class="brand-icon"><i class="fa-solid fa-steering-wheel"></i></div>
                    <span class="brand-name">Driver<span class="brand-accent">ia</span></span>
                </a>
            <?php endif; ?>
        </div>
        <button class="drawer-close" id="drawerCloseBtn" aria-label="Close Menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="drawer-body">
        <?php
        if (has_nav_menu('primary')) {
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'mobile-menu-list',
                'container'      => false,
                'depth'          => 3,
            ));
        } else {
            ?>
            <ul class="mobile-menu-list">
                <?php wp_list_pages(array('title_li' => '', 'depth' => 2)); ?>
            </ul>
            <?php
        }
        ?>
        <div style="padding: 20px 25px;">
            <a href="<?php echo esc_url(driveria_get_page_url('Contact Us', 'contact')); ?>" class="btn-driveria btn-primary-driveria" style="width: 100%;">
                <i class="fa-solid fa-phone"></i>
                <span><?php echo esc_html(get_theme_mod('driveria_header_btn_text', 'CONTACT US')); ?></span>
            </a>
        </div>
    </div>
</div>
