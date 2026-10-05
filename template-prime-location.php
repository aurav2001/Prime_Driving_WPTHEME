<?php
/**
 * Template Name: Prime Location & Service Page (SEO & Registration Landing Page)
 * Description: Premium SEO, AEO & GEO Landing Page Template with dynamic section controls and dynamic fallback content.
 *
 * @package Driveria
 */

get_header();

if (have_posts()) : while (have_posts()) : the_post();
    $post_id    = get_the_ID();
    $page_title = get_the_title();
    $phone      = get_theme_mod('driveria_phone', '(571) 501-3404');
    $email      = get_theme_mod('driveria_email', 'info@primedrivingschoolva.com');

    // Fetch custom location meta settings from WP Admin
    $city_meta       = get_post_meta($post_id, '_prime_city_name', true);
    $city_name       = !empty($city_meta) ? $city_meta : (strpos($page_title, 'Vienna') !== false ? 'Vienna, VA' : $page_title);

    $show_trust      = get_post_meta($post_id, '_prime_show_trust', true);
    if ($show_trust === '') $show_trust = '1';

    $show_courses    = get_post_meta($post_id, '_prime_show_courses', true);
    if ($show_courses === '') $show_courses = '1';

    $show_teen_adult = get_post_meta($post_id, '_prime_show_teen_adult', true);
    if ($show_teen_adult === '') $show_teen_adult = '1';

    $show_why        = get_post_meta($post_id, '_prime_show_why', true);
    if ($show_why === '') $show_why = '1';

    $show_reviews    = get_post_meta($post_id, '_prime_show_reviews', true);
    if ($show_reviews === '') $show_reviews = '1';

    $show_steps      = get_post_meta($post_id, '_prime_show_steps', true);
    if ($show_steps === '') $show_steps = '1';

    $show_faqs       = get_post_meta($post_id, '_prime_show_faqs', true);
    if ($show_faqs === '') $show_faqs = '1';

    $show_cta        = get_post_meta($post_id, '_prime_show_cta', true);
    if ($show_cta === '') $show_cta = '1';

    $custom_faqs_str = get_post_meta($post_id, '_prime_custom_faqs', true);

    // Render page header banner
    driveria_render_page_header(
        sprintf(__('Driving School in %s', 'driveria'), esc_html($city_name)),
        sprintf(__('DMV-Approved Driver Training for Teens & Adults in %s', 'driveria'), esc_html($city_name))
    );
?>

<!-- =========================================================================
     1. HERO & ONLINE REGISTRATION SECTION (High Conversion Form Card)
     ========================================================================= -->
<section class="driveria-section prime-service-hero-section">
    <div class="driveria-container">
        <div class="prime-hero-grid">
            
            <!-- Left Column: Value Proposition, Feature Highlights & Trust -->
            <div class="prime-hero-info">
                <div class="blue-dashes-accent">
                    <span></span><span></span>
                </div>
                <span class="prime-subtitle-accent"><?php esc_html_e('DMV-Approved Driving Academy', 'driveria'); ?></span>
                <h1 class="prime-title-heading">
                    <?php printf(esc_html__('Driving School in %s', 'driveria'), esc_html($city_name)); ?>
                </h1>
                
                <p class="prime-hero-lead-text">
                    <?php printf(esc_html__('Looking for a top-rated driving school in %s that focuses on practical skills, defensive driving, and DMV test success? Prime Driving School provides comprehensive, state-approved driving training for teens and adults who want to become safe, composed, and confident behind the wheel.', 'driveria'), esc_html($city_name)); ?>
                </p>

                <p class="prime-hero-sub-lead">
                    <?php esc_html_e('From first-time behind-the-wheel learners and nervous drivers to adult refresher courses and DMV road-test appointments, our certified instructors tailor every session to your learning pace.', 'driveria'); ?>
                </p>

                <div class="prime-hero-badges-list">
                    <div class="hero-badge-pill"><i class="fa-solid fa-circle-check"></i> <?php esc_html_e('Behind-the-Wheel Training', 'driveria'); ?></div>
                    <div class="hero-badge-pill"><i class="fa-solid fa-circle-check"></i> <?php esc_html_e('Teen & Adult Programs', 'driveria'); ?></div>
                    <div class="hero-badge-pill"><i class="fa-solid fa-circle-check"></i> <?php esc_html_e('DMV Road Test Service', 'driveria'); ?></div>
                    <div class="hero-badge-pill"><i class="fa-solid fa-circle-check"></i> <?php esc_html_e('Adult Waiver Course', 'driveria'); ?></div>
                </div>

                <!-- 4 Highlights Mini Feature Grid to fill height and add high-value content -->
                <div class="prime-hero-features-grid">
                    <div class="hero-feat-card">
                        <div class="feat-icon"><i class="fa-solid fa-house-chimney-user"></i></div>
                        <div class="feat-info">
                            <strong><?php esc_html_e('Free Doorstep Pickup', 'driveria'); ?></strong>
                            <span><?php esc_html_e('Direct home or school pickup', 'driveria'); ?></span>
                        </div>
                    </div>

                    <div class="hero-feat-card">
                        <div class="feat-icon"><i class="fa-solid fa-certificate"></i></div>
                        <div class="feat-info">
                            <strong><?php esc_html_e('DMV-Certified Academy', 'driveria'); ?></strong>
                            <span><?php esc_html_e('Official Virginia curriculum', 'driveria'); ?></span>
                        </div>
                    </div>

                    <div class="hero-feat-card">
                        <div class="feat-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <div class="feat-info">
                            <strong><?php esc_html_e('Dual-Control Cars', 'driveria'); ?></strong>
                            <span><?php esc_html_e('Safety-inspected vehicles', 'driveria'); ?></span>
                        </div>
                    </div>

                    <div class="hero-feat-card">
                        <div class="feat-icon"><i class="fa-solid fa-calendar-check"></i></div>
                        <div class="feat-info">
                            <strong><?php esc_html_e('Flexible Schedules', 'driveria'); ?></strong>
                            <span><?php esc_html_e('Weekdays & weekend slots', 'driveria'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Trust Proof & Direct Phone Line Strip -->
                <div class="prime-hero-trust-bar">
                    <div class="trust-rating-col">
                        <div class="stars-wrap">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <span class="rating-txt"><strong>4.9/5 Rating</strong> (500+ Northern VA Students)</span>
                    </div>

                    <div class="quick-call-col">
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="quick-call-link">
                            <i class="fa-solid fa-phone-volume"></i>
                            <span><?php esc_html_e('Call', 'driveria'); ?>: <strong><?php echo esc_html($phone); ?></strong></span>
                        </a>
                    </div>
                </div>
                
                <!-- Curved Arrow pointing to form -->
                <div class="curved-arrow-wrap">
                    <svg viewBox="0 0 100 80" class="curved-arrow-svg" aria-hidden="true">
                        <path d="M 10 10 Q 70 20 80 70 M 80 70 L 65 60 M 80 70 L 88 52" stroke="#FF9800" stroke-width="4" fill="none" stroke-linecap="round" />
                    </svg>
                    <span class="arrow-label-text"><?php esc_html_e('Fast Online Registration Below &rarr;', 'driveria'); ?></span>
                </div>
            </div>

            <!-- Right Column: Registration Form Card -->
            <div class="prime-form-card-wrapper" id="prime-enroll-form">
                <div class="prime-form-card shadow-sm">
                    <div class="form-card-header">
                        <h3><i class="fa-solid fa-id-card"></i> <?php esc_html_e('Online Registration Form', 'driveria'); ?></h3>
                        <p><?php esc_html_e('Fill out your details to get started with driving lessons.', 'driveria'); ?></p>
                    </div>

                    <form id="driveriaPrimeLocationEnrollForm" class="driveria-ajax-form" method="post">
                        <input type="hidden" name="form_source" value="<?php echo esc_attr('Prime Location Page Form - ' . $city_name); ?>" />
                        <input type="hidden" name="location_page" value="<?php echo esc_attr($city_name); ?>" />

                        <div class="prime-form-grid">
                            <div class="prime-field-wrap">
                                <label class="field-label-sm"><?php esc_html_e('Full Name *', 'driveria'); ?></label>
                                <input type="text" name="student_name" class="prime-input" required placeholder="<?php esc_attr_e('Student Full Name', 'driveria'); ?>">
                            </div>

                            <div class="prime-field-wrap">
                                <label class="field-label-sm"><?php esc_html_e('Email Address *', 'driveria'); ?></label>
                                <input type="email" name="student_email" class="prime-input" required placeholder="<?php esc_attr_e('Email Address', 'driveria'); ?>">
                            </div>

                            <div class="prime-field-wrap">
                                <label class="field-label-sm"><?php esc_html_e('Cell Phone *', 'driveria'); ?></label>
                                <input type="tel" name="student_phone" class="prime-input" required placeholder="<?php esc_attr_e('(571) 000-0000', 'driveria'); ?>">
                            </div>

                            <div class="prime-field-wrap">
                                <label class="field-label-sm"><?php esc_html_e('City *', 'driveria'); ?></label>
                                <input type="text" name="city" class="prime-input" required value="<?php echo esc_attr($city_name); ?>" placeholder="<?php esc_attr_e('City Name', 'driveria'); ?>">
                            </div>

                            <div class="prime-field-wrap">
                                <label class="field-label-sm"><?php esc_html_e('State & Zip Code', 'driveria'); ?></label>
                                <div class="dual-input-row">
                                    <input type="text" name="state" class="prime-input" value="VA" placeholder="VA" style="width: 35%;">
                                    <input type="text" name="student_zip" class="prime-input" placeholder="Zip Code" style="width: 65%;">
                                </div>
                            </div>

                            <div class="prime-field-wrap full-col">
                                <label class="field-label-sm"><?php esc_html_e('Street / Pickup Address *', 'driveria'); ?></label>
                                <input type="text" name="student_address" class="prime-input" required placeholder="<?php esc_attr_e('Street Address for Pickup / Location', 'driveria'); ?>">
                            </div>

                            <div class="prime-field-wrap">
                                <label class="field-label-sm"><?php esc_html_e('Select Desired Course', 'driveria'); ?></label>
                                <select name="course_selected" class="prime-input">
                                    <option value=""><?php esc_html_e('-- Choose a Driving Course --', 'driveria'); ?></option>
                                    <option value="Behind the Wheel ($350)"><?php esc_html_e('Behind the Wheel ($350)', 'driveria'); ?></option>
                                    <option value="Teen 1-on-1 Training ($400)"><?php esc_html_e('Teen 1-on-1 Training ($400)', 'driveria'); ?></option>
                                    <option value="90-Minute Class ($100)"><?php esc_html_e('90-Minute Class ($100)', 'driveria'); ?></option>
                                    <option value="3 x 90-Minute Classes ($275)"><?php esc_html_e('3 x 90-Minute Classes ($275)', 'driveria'); ?></option>
                                    <option value="7 x 60-Minute Classes ($400)"><?php esc_html_e('7 x 60-Minute Classes ($400)', 'driveria'); ?></option>
                                    <option value="5 x 60-Minute Classes ($300)"><?php esc_html_e('5 x 60-Minute Classes ($300)', 'driveria'); ?></option>
                                    <option value="3 x 60-Minute Classes ($200)"><?php esc_html_e('3 x 60-Minute Classes ($200)', 'driveria'); ?></option>
                                    <option value="DMV Appointment Road Test ($200)"><?php esc_html_e('DMV Appointment Road Test ($200)', 'driveria'); ?></option>
                                    <option value="Adult Waiver Course ($400)"><?php esc_html_e('Adult Waiver Course ($400)', 'driveria'); ?></option>
                                </select>
                            </div>

                            <!-- Radio Choices: Age & Permit -->
                            <div class="prime-field-wrap full-col">
                                <div class="prime-radio-group-wrap">
                                    <div class="radio-block">
                                        <span class="field-label-sm"><?php esc_html_e('Student Age:', 'driveria'); ?></span>
                                        <label class="prime-radio-opt">
                                            <input type="radio" name="student_age_group" value="Teen (Below 18)" checked /> <?php esc_html_e('Teen (<18)', 'driveria'); ?>
                                        </label>
                                        <label class="prime-radio-opt">
                                            <input type="radio" name="student_age_group" value="Adult (Above 18)" /> <?php esc_html_e('Adult (18+)', 'driveria'); ?>
                                        </label>
                                    </div>

                                    <div class="radio-block">
                                        <span class="field-label-sm"><?php esc_html_e('VA Learner\'s Permit?', 'driveria'); ?></span>
                                        <label class="prime-radio-opt">
                                            <input type="radio" name="has_permit" value="Yes" checked /> <?php esc_html_e('Yes', 'driveria'); ?>
                                        </label>
                                        <label class="prime-radio-opt">
                                            <input type="radio" name="has_permit" value="No" /> <?php esc_html_e('No', 'driveria'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="prime-field-wrap full-col">
                                <textarea name="notes" class="prime-input prime-textarea" rows="3" placeholder="<?php esc_attr_e('Driving goals, specific questions, or scheduling preferences...', 'driveria'); ?>"></textarea>
                            </div>

                            <div class="prime-field-wrap full-col">
                                <button type="submit" class="btn-prime-blue-submit">
                                    <span><?php esc_html_e('Submit Registration Request', 'driveria'); ?></span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-response-msg" style="margin-top: 15px;"></div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================================
     2. TRUST STRIP BAR (4 Verified Key Points)
     ========================================================================= -->
<?php if ($show_trust !== '0') : ?>
<section class="prime-trust-strip-section">
    <div class="driveria-container">
        <div class="prime-trust-grid">
            <div class="prime-trust-item">
                <div class="trust-icon-box"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="trust-text-box">
                    <strong><?php esc_html_e('DMV-Approved Training', 'driveria'); ?></strong>
                    <span><?php esc_html_e('Official Virginia DMV curriculum', 'driveria'); ?></span>
                </div>
            </div>

            <div class="prime-trust-item">
                <div class="trust-icon-box"><i class="fa-solid fa-user-shield"></i></div>
                <div class="trust-text-box">
                    <strong><?php esc_html_e('FBI Background-Checked', 'driveria'); ?></strong>
                    <span><?php esc_html_e('Patient & certified instructors', 'driveria'); ?></span>
                </div>
            </div>

            <div class="prime-trust-item">
                <div class="trust-icon-box"><i class="fa-solid fa-car-side"></i></div>
                <div class="trust-text-box">
                    <strong><?php esc_html_e('Teen & Adult Programs', 'driveria'); ?></strong>
                    <span><?php esc_html_e('Tailored 1-on-1 private lessons', 'driveria'); ?></span>
                </div>
            </div>

            <div class="prime-trust-item">
                <div class="trust-icon-box"><i class="fa-solid fa-star"></i></div>
                <div class="trust-text-box">
                    <strong><?php esc_html_e('Verified Student Reviews', 'driveria'); ?></strong>
                    <span><?php esc_html_e('Top rated driving school in VA', 'driveria'); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- =========================================================================
     3. WELCOME & LOCATION TRAFFIC CONTEXT SECTION
     ========================================================================= -->
<section class="driveria-section prime-welcome-section">
    <div class="driveria-container">
        <div class="prime-welcome-grid">
            
            <!-- Left Column: Image Framing Collage -->
            <div class="prime-dual-img-collage">
                <div class="img-frame-primary">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium_large'); ?>
                    <?php else : ?>
                        <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&w=700&q=80" alt="<?php printf(esc_attr__('Driving Instruction in %s', 'driveria'), esc_attr($city_name)); ?>" />
                    <?php endif; ?>
                </div>

                <div class="img-frame-secondary">
                    <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=500&q=80" alt="<?php esc_attr_e('Happy Driver Student', 'driveria'); ?>" />
                </div>

                <div class="collage-badge-box">
                    <span class="badge-num">100%</span>
                    <span class="badge-lbl"><?php esc_html_e('DMV Accredited Instruction', 'driveria'); ?></span>
                </div>
            </div>

            <!-- Right Column: Content Text & Location Traffic Context -->
            <div class="prime-welcome-content">
                <div class="blue-dashes-accent">
                    <span></span><span></span>
                </div>
                <h2><?php printf(esc_html__('Driving in %s: Why Practical Training Matters', 'driveria'), esc_html($city_name)); ?></h2>

                <p>
                    <?php printf(esc_html__('%s has a dynamic mix of residential neighborhoods, busy commercial corridors, and high-volume transportation arteries. For instance, Maple Avenue (VA-123) carries approximately 27,000 vehicles daily, while major nearby highways like I-66 carry heavy commuting traffic.', 'driveria'), esc_html($city_name)); ?>
                </p>

                <p>
                    <?php esc_html_e('These road conditions make traffic awareness and calm, defensive decision-making vital skills for new drivers. Students need more than basic written rules—they need real-world practice with smooth braking, early lane positioning, mirror checks, blind-spot awareness, pedestrian watchfulness, and confident intersection management.', 'driveria'); ?>
                </p>

                <div class="prime-action-cta-row">
                    <a href="#prime-courses-section" class="btn-blue-readmore">
                        <i class="fa-solid fa-layer-group"></i> <?php esc_html_e('View Available Courses', 'driveria'); ?>
                    </a>
                    
                    <div class="phone-line-wrap">
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="phone-circle-btn">
                            <i class="fa-solid fa-phone"></i>
                        </a>
                        <div class="phone-number-info">
                            <strong><?php echo esc_html($phone); ?></strong>
                            <span><?php esc_html_e('Direct Instructor Line', 'driveria'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================================
     4. COURSES & PRICING TABLE + CARDS GRID SECTION
     ========================================================================= -->
<?php if ($show_courses !== '0') : ?>
<section id="prime-courses-section" class="driveria-section prime-courses-pricing-section">
    <div class="driveria-container">
        
        <div class="section-title-wrap text-center">
            <span class="sub-title-accent"><i class="fa-solid fa-car"></i> <?php esc_html_e('Transparent Pricing & Flexible Options', 'driveria'); ?></span>
            <h2 class="main-title"><?php printf(esc_html__('Driving Courses Available in %s', 'driveria'), esc_html($city_name)); ?></h2>
            <p class="section-desc"><?php esc_html_e('Prime Driving School lists several courses for different experience levels. Choose the course that matches your driving goal.', 'driveria'); ?></p>
        </div>

        <!-- Responsive HTML Pricing Table -->
        <div class="prime-pricing-table-wrapper shadow-sm">
            <table class="prime-pricing-table">
                <thead>
                    <tr>
                        <th><?php esc_html_e('Course Name', 'driveria'); ?></th>
                        <th><?php esc_html_e('Current Price', 'driveria'); ?></th>
                        <th><?php esc_html_e('Best For / Program Details', 'driveria'); ?></th>
                        <th class="text-right"><?php esc_html_e('Action', 'driveria'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong><?php esc_html_e('Behind the Wheel', 'driveria'); ?></strong></td>
                        <td><span class="table-price-tag">$350</span></td>
                        <td><?php esc_html_e('Eligible high-school & teen students seeking official certification', 'driveria'); ?></td>
                        <td class="text-right">
                            <a href="#prime-enroll-form" class="btn-table-enroll" data-course="Behind the Wheel"><?php esc_html_e('Register', 'driveria'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('Teen 1-on-1 Training', 'driveria'); ?></strong></td>
                        <td><span class="table-price-tag">$400</span></td>
                        <td><?php esc_html_e('Teen drivers needing dedicated, individualized instruction', 'driveria'); ?></td>
                        <td class="text-right">
                            <a href="#prime-enroll-form" class="btn-table-enroll" data-course="Teen 1-on-1 Training"><?php esc_html_e('Register', 'driveria'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('90-Minute Class', 'driveria'); ?></strong></td>
                        <td><span class="table-price-tag">$100</span></td>
                        <td><?php esc_html_e('Students needing a single focused lesson or targeted skill practice', 'driveria'); ?></td>
                        <td class="text-right">
                            <a href="#prime-enroll-form" class="btn-table-enroll" data-course="90-Minute Class"><?php esc_html_e('Register', 'driveria'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('3 × 90-Minute Classes', 'driveria'); ?></strong></td>
                        <td><span class="table-price-tag">$275</span></td>
                        <td><?php esc_html_e('Students who want multiple practice sessions before road driving', 'driveria'); ?></td>
                        <td class="text-right">
                            <a href="#prime-enroll-form" class="btn-table-enroll" data-course="3 x 90-Minute Classes"><?php esc_html_e('Register', 'driveria'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('7 × 60-Minute Classes', 'driveria'); ?></strong></td>
                        <td><span class="table-price-tag">$400</span></td>
                        <td><?php esc_html_e('Comprehensive teen or adult skill development program', 'driveria'); ?></td>
                        <td class="text-right">
                            <a href="#prime-enroll-form" class="btn-table-enroll" data-course="7 x 60-Minute Classes"><?php esc_html_e('Register', 'driveria'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('5 × 60-Minute Classes', 'driveria'); ?></strong></td>
                        <td><span class="table-price-tag">$300</span></td>
                        <td><?php esc_html_e('Additional guided practice for intermediate drivers', 'driveria'); ?></td>
                        <td class="text-right">
                            <a href="#prime-enroll-form" class="btn-table-enroll" data-course="5 x 60-Minute Classes"><?php esc_html_e('Register', 'driveria'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('3 × 60-Minute Classes', 'driveria'); ?></strong></td>
                        <td><span class="table-price-tag">$200</span></td>
                        <td><?php esc_html_e('Short multi-lesson training for confidence boosting', 'driveria'); ?></td>
                        <td class="text-right">
                            <a href="#prime-enroll-form" class="btn-table-enroll" data-course="3 x 60-Minute Classes"><?php esc_html_e('Register', 'driveria'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('DMV Appointment Road Test', 'driveria'); ?></strong></td>
                        <td><span class="table-price-tag">$200</span></td>
                        <td><?php esc_html_e('Eligible students preparing for official DMV test with school vehicle', 'driveria'); ?></td>
                        <td class="text-right">
                            <a href="#prime-enroll-form" class="btn-table-enroll" data-course="DMV Appointment Road Test"><?php esc_html_e('Register', 'driveria'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('Adult Waiver Course', 'driveria'); ?></strong></td>
                        <td><span class="table-price-tag">$400</span></td>
                        <td><?php esc_html_e('Eligible adult students bypassing 60-day holding period', 'driveria'); ?></td>
                        <td class="text-right">
                            <a href="#prime-enroll-form" class="btn-table-enroll" data-course="Adult Waiver Course"><?php esc_html_e('Register', 'driveria'); ?></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</section>
<?php endif; ?>

<!-- =========================================================================
     5. TEEN & ADULT DRIVING LESSONS & DMV ROAD TEST SECTION
     ========================================================================= -->
<?php if ($show_teen_adult !== '0') : ?>
<section class="driveria-section prime-programs-grid-section">
    <div class="driveria-container">
        
        <div class="section-title-wrap text-center">
            <span class="sub-title-accent"><i class="fa-solid fa-graduation-cap"></i> <?php esc_html_e('Tailored Instruction Programs', 'driveria'); ?></span>
            <h2 class="main-title"><?php printf(esc_html__('Specialized Driving Programs in %s', 'driveria'), esc_html($city_name)); ?></h2>
        </div>

        <div class="prime-programs-grid">
            
            <!-- Teen Driving Lessons Card -->
            <div class="program-card shadow-sm">
                <div class="program-card-header bg-blue">
                    <i class="fa-solid fa-user-graduate"></i>
                    <h3><?php printf(esc_html__('Teen Driving Lessons in %s', 'driveria'), esc_html($city_name)); ?></h3>
                </div>
                <div class="program-card-body">
                    <p><?php esc_html_e('Teen drivers need time to turn classroom theory into safe, automatic driving habits. Our teen-focused options help students master vehicle control, smooth braking, safe turns, lane changes, parking, intersection awareness, and defensive driving tactics.', 'driveria'); ?></p>
                    <ul class="program-features-list">
                        <li><i class="fa-solid fa-check-double"></i> <?php esc_html_e('Behind the Wheel official certification', 'driveria'); ?></li>
                        <li><i class="fa-solid fa-check-double"></i> <?php esc_html_e('Teen 1-on-1 private instructor options', 'driveria'); ?></li>
                        <li><i class="fa-solid fa-check-double"></i> <?php esc_html_e('Gradual skill building without overwhelming', 'driveria'); ?></li>
                    </ul>
                    <a href="#prime-enroll-form" class="btn-program-link"><?php esc_html_e('Enroll Teen Student', 'driveria'); ?> &rarr;</a>
                </div>
            </div>

            <!-- Adult Driving Lessons Card -->
            <div class="program-card shadow-sm">
                <div class="program-card-header bg-dark">
                    <i class="fa-solid fa-user-tie"></i>
                    <h3><?php printf(esc_html__('Adult Driving Lessons in %s', 'driveria'), esc_html($city_name)); ?></h3>
                </div>
                <div class="program-card-body">
                    <p><?php esc_html_e('Adult learners come with different goals: learning for the first time, returning after a break, moving to Virginia, or preparing for the road test. We offer single lessons and multi-class packages focused on your specific areas of discomfort.', 'driveria'); ?></p>
                    <ul class="program-features-list">
                        <li><i class="fa-solid fa-check-double"></i> <?php esc_html_e('Adult Waiver Course for eligible learners', 'driveria'); ?></li>
                        <li><i class="fa-solid fa-check-double"></i> <?php esc_html_e('Customized focus on parking, highway & lane changes', 'driveria'); ?></li>
                        <li><i class="fa-solid fa-check-double"></i> <?php esc_html_e('Flexible scheduling for working adults', 'driveria'); ?></li>
                    </ul>
                    <a href="#prime-enroll-form" class="btn-program-link"><?php esc_html_e('Enroll Adult Student', 'driveria'); ?> &rarr;</a>
                </div>
            </div>

            <!-- DMV Road Test Prep Card -->
            <div class="program-card shadow-sm">
                <div class="program-card-header bg-orange">
                    <i class="fa-solid fa-id-card"></i>
                    <h3><?php printf(esc_html__('DMV Road Test Prep in %s', 'driveria'), esc_html($city_name)); ?></h3>
                </div>
                <div class="program-card-body">
                    <p><?php esc_html_e('A DMV road test can feel stressful. Prime Driving School offers DMV Appointment Road Test services including use of our dual-control training vehicle for your official test appointment.', 'driveria'); ?></p>
                    <ul class="program-features-list">
                        <li><i class="fa-solid fa-check-double"></i> <?php esc_html_e('Use of school dual-control car for DMV test', 'driveria'); ?></li>
                        <li><i class="fa-solid fa-check-double"></i> <?php esc_html_e('Pre-test warm-up lesson available', 'driveria'); ?></li>
                        <li><i class="fa-solid fa-check-double"></i> <?php esc_html_e('Review of official DMV testing criteria', 'driveria'); ?></li>
                    </ul>
                    <a href="#prime-enroll-form" class="btn-program-link"><?php esc_html_e('Book Road Test Service', 'driveria'); ?> &rarr;</a>
                </div>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- =========================================================================
     6. WHY CHOOSE PRIME DRIVING SCHOOL (6 Key Feature Cards Grid)
     ========================================================================= -->
<?php if ($show_why !== '0') : ?>
<section class="driveria-section prime-why-choose-section">
    <div class="driveria-container">
        
        <div class="section-title-wrap text-center">
            <span class="sub-title-accent"><i class="fa-solid fa-award"></i> <?php esc_html_e('Why Choose Us', 'driveria'); ?></span>
            <h2 class="main-title"><?php esc_html_e('Why Choose Prime Driving School?', 'driveria'); ?></h2>
        </div>

        <div class="prime-why-grid">
            
            <div class="why-card-item">
                <div class="why-icon-box"><i class="fa-solid fa-certificate"></i></div>
                <h4><?php esc_html_e('DMV-Certified / Approved', 'driveria'); ?></h4>
                <p><?php esc_html_e('All programs follow official Virginia DMV safety guidelines and state driver-training requirements.', 'driveria'); ?></p>
            </div>

            <div class="why-card-item">
                <div class="why-icon-box"><i class="fa-solid fa-user-shield"></i></div>
                <h4><?php esc_html_e('FBI Background-Checked', 'driveria'); ?></h4>
                <p><?php esc_html_e('Instructors undergo thorough FBI background checks to ensure maximum safety and trust for parents and adult students.', 'driveria'); ?></p>
            </div>

            <div class="why-card-item">
                <div class="why-icon-box"><i class="fa-solid fa-hands-holding-circle"></i></div>
                <h4><?php esc_html_e('Experienced & Patient Team', 'driveria'); ?></h4>
                <p><?php esc_html_e('Guided behind-the-wheel practice with patient, composed feedback that turns nervous learners into confident drivers.', 'driveria'); ?></p>
            </div>

            <div class="why-card-item">
                <div class="why-icon-box"><i class="fa-solid fa-users"></i></div>
                <h4><?php esc_html_e('Teen & Adult Programs', 'driveria'); ?></h4>
                <p><?php esc_html_e('Courses engineered for both first-time teenage drivers and adults needing customized instruction.', 'driveria'); ?></p>
            </div>

            <div class="why-card-item">
                <div class="why-icon-box"><i class="fa-solid fa-road"></i></div>
                <h4><?php esc_html_e('Real Behind-the-Wheel Practice', 'driveria'); ?></h4>
                <p><?php esc_html_e('Focus on real-world practical skills: parking, highway merging, defensive driving, and traffic management.', 'driveria'); ?></p>
            </div>

            <div class="why-card-item">
                <div class="why-icon-box"><i class="fa-solid fa-car-side"></i></div>
                <h4><?php esc_html_e('Pickup and Drop-Off Options', 'driveria'); ?></h4>
                <p><?php esc_html_e('Free pickup and drop-off are available with several course packages (confirm availability for your specific area).', 'driveria'); ?></p>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- =========================================================================
     7. HOW ENROLLMENT WORKS (4 Clear Steps)
     ========================================================================= -->
<?php if ($show_steps !== '0') : ?>
<section class="driveria-section prime-steps-section">
    <div class="driveria-container">
        
        <div class="section-title-wrap text-center">
            <span class="sub-title-accent"><i class="fa-solid fa-list-check"></i> <?php esc_html_e('Simple 4-Step Process', 'driveria'); ?></span>
            <h2 class="main-title"><?php esc_html_e('How Enrollment Works', 'driveria'); ?></h2>
        </div>

        <div class="prime-steps-grid">
            
            <div class="step-card-item">
                <div class="step-num-badge">1</div>
                <h4><?php esc_html_e('Fill Out the Form', 'driveria'); ?></h4>
                <p><?php esc_html_e('Enter student contact info, city, age group, and learner permit status in the online form.', 'driveria'); ?></p>
            </div>

            <div class="step-card-item">
                <div class="step-num-badge">2</div>
                <h4><?php esc_html_e('Tell Us Your Goal', 'driveria'); ?></h4>
                <p><?php esc_html_e('Select your course or request our team to help choose the best option for your skill level.', 'driveria'); ?></p>
            </div>

            <div class="step-card-item">
                <div class="step-num-badge">3</div>
                <h4><?php esc_html_e('We Contact You', 'driveria'); ?></h4>
                <p><?php esc_html_e('An instructor will call or text after registration to confirm your preferred schedule.', 'driveria'); ?></p>
            </div>

            <div class="step-card-item">
                <div class="step-num-badge">4</div>
                <h4><?php esc_html_e('Confirm Your Course', 'driveria'); ?></h4>
                <p><?php esc_html_e('Review course price, eligibility, and scheduling requirements before payment.', 'driveria'); ?></p>
            </div>

        </div>

    </div>
</section>
<?php endif; ?>

<!-- =========================================================================
     8. STUDENT TESTIMONIALS SECTION
     ========================================================================= -->
<?php if ($show_reviews !== '0') : ?>
<section class="driveria-section prime-testimonials-section">
    <div class="driveria-container">
        
        <div class="section-title-wrap text-center">
            <span class="sub-title-accent"><i class="fa-solid fa-comments"></i> <?php esc_html_e('Verified Student Feedback', 'driveria'); ?></span>
            <h2 class="main-title"><?php esc_html_e('What Our Students Say', 'driveria'); ?></h2>
        </div>

        <div class="prime-testimonials-grid">
            
            <div class="testimonial-card-item shadow-sm">
                <div class="stars-row">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="testimonial-quote">
                    "Prime Driving School made me feel so comfortable behind the wheel! The instructor was extremely patient, explained mirror checks and lane changes clearly, and helped me pass my DMV test on the first try!"
                </p>
                <div class="reviewer-info">
                    <strong>Sarah M.</strong>
                    <span>Verified Student</span>
                </div>
            </div>

            <div class="testimonial-card-item shadow-sm">
                <div class="stars-row">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="testimonial-quote">
                    "As a parent, safety was my highest priority. Knowing the instructor is FBI background-checked gave me total peace of mind. My teen daughter built great highway confidence quickly."
                </p>
                <div class="reviewer-info">
                    <strong>David K.</strong>
                    <span>Parent of Teen Student</span>
                </div>
            </div>

            <div class="testimonial-card-item shadow-sm">
                <div class="stars-row">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="testimonial-quote">
                    "I hadn't driven in over 5 years. The adult refresher classes and Adult Waiver program were exactly what I needed. Professional, clear, and highly recommended!"
                </p>
                <div class="reviewer-info">
                    <strong>Alexander P.</strong>
                    <span>Adult Student</span>
                </div>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- =========================================================================
     9. WORDPRESS PAGE EDITOR CONTENT SECTION (Dashboard Content - Middle)
     ========================================================================= -->
<?php
$editor_content = get_the_content();
if (!empty(trim(strip_tags($editor_content)))) :
?>
<section id="prime-editor-content" class="driveria-section prime-middle-content-section" style="padding: 60px 0; background: #FFFFFF;">
    <div class="driveria-container">
        <div class="prime-content-card shadow-sm" style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 20px; padding: 40px;">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- =========================================================================
     10. FINAL LEAD CTA BANNER SECTION
     ========================================================================= -->
<?php if ($show_cta !== '0') : ?>
<section class="prime-final-cta-section">
    <div class="driveria-container text-center">
        <div class="final-cta-card shadow-lg">
            <span class="cta-badge-pill"><i class="fa-solid fa-paper-plane"></i> <?php esc_html_e('Take the Next Step', 'driveria'); ?></span>
            <h2><?php printf(esc_html__('Ready to Start Driving in %s?', 'driveria'), esc_html($city_name)); ?></h2>
            <p><?php esc_html_e('Whether you are a teen getting ready for your first license or an adult building highway confidence, Prime Driving School is ready to help you succeed.', 'driveria'); ?></p>

            <div class="final-cta-actions">
                <a href="#prime-enroll-form" class="btn-orange-cta">
                    <i class="fa-solid fa-pen-to-square"></i> <?php esc_html_e('Fill Out Registration Form', 'driveria'); ?>
                </a>

                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="btn-outline-white-cta">
                    <i class="fa-solid fa-phone"></i> <?php echo esc_html($phone); ?>
                </a>

                <a href="mailto:<?php echo esc_attr($email); ?>" class="btn-outline-white-cta">
                    <i class="fa-solid fa-envelope"></i> <?php echo esc_html($email); ?>
                </a>
            </div>

            <small class="cta-note"><?php esc_html_e('After submitting the form, an instructor will call or text to discuss scheduling.', 'driveria'); ?></small>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- =========================================================================
     11. FREQUENTLY ASKED QUESTIONS (Interactive FAQ Accordion - Sabse Last Me)
     ========================================================================= -->
<?php if ($show_faqs !== '0') : ?>
<section class="driveria-section prime-faq-section">
    <div class="driveria-container">
        
        <div class="section-title-wrap text-center">
            <span class="sub-title-accent"><i class="fa-circle-question fa-solid"></i> <?php esc_html_e('Got Questions?', 'driveria'); ?></span>
            <h2 class="main-title"><?php esc_html_e('Frequently Asked Questions', 'driveria'); ?></h2>
            <p class="section-desc"><?php printf(esc_html__('Find clear, direct answers about driving lessons and DMV rules in %s.', 'driveria'), esc_html($city_name)); ?></p>
        </div>

        <div class="prime-faq-accordion-wrap">
            <?php
            // Check for custom FAQ overrides in meta
            if (!empty($custom_faqs_str)) {
                $lines = explode("\n", $custom_faqs_str);
                $faq_index = 1;
                foreach ($lines as $line) {
                    $parts = explode('|', $line);
                    if (count($parts) >= 2) {
                        $q = trim($parts[0]);
                        $a = trim($parts[1]);
                        ?>
                        <div class="faq-accordion-item <?php echo $faq_index === 1 ? 'active' : ''; ?>">
                            <button class="faq-question" type="button">
                                <span><?php echo esc_html($q); ?></span>
                                <i class="fa-solid fa-chevron-down faq-icon"></i>
                            </button>
                            <div class="faq-answer">
                                <p><?php echo esc_html($a); ?></p>
                            </div>
                        </div>
                        <?php
                        $faq_index++;
                    }
                }
            } else {
                // Default 10 Dynamic Location FAQs
                $default_faqs = array(
                    array(
                        'q' => __('Is Prime Driving School DMV-approved?', 'driveria'),
                        'a' => __('Yes. Prime Driving School provides official DMV-approved driving training options following Virginia State driver education requirements.', 'driveria')
                    ),
                    array(
                        'q' => sprintf(__('Do you offer driving lessons in %s?', 'driveria'), esc_html($city_name)),
                        'a' => sprintf(__('Yes! Prime Driving School offers dedicated driving training for teens and adults in %s and surrounding areas.', 'driveria'), esc_html($city_name))
                    ),
                    array(
                        'q' => __('Do you offer teen driving lessons?', 'driveria'),
                        'a' => __('Yes. We list Behind the Wheel and Teen 1-on-1 private training options. Students must hold a valid Virginia learner\'s permit.', 'driveria')
                    ),
                    array(
                        'q' => sprintf(__('Do you offer adult driving lessons in %s?', 'driveria'), esc_html($city_name)),
                        'a' => __('Yes. Adult students can select individual practice sessions, multi-class packages, or the Adult Waiver Course subject to eligibility.', 'driveria')
                    ),
                    array(
                        'q' => __('Can I book a single 90-minute driving lesson?', 'driveria'),
                        'a' => __('Yes. We offer single 90-minute lessons ($100) focused on specific driving skills like parking, highway merging, or road-test prep.', 'driveria')
                    ),
                    array(
                        'q' => __('Do you provide a vehicle for the DMV road test?', 'driveria'),
                        'a' => __('Yes. Prime Driving School lists a DMV Appointment Road Test service ($200), providing use of our dual-control car for your official exam.', 'driveria')
                    ),
                    array(
                        'q' => __('Do you provide pickup and drop-off service?', 'driveria'),
                        'a' => sprintf(__('Free pickup and drop-off are available with several course packages. Confirm availability for your specific %s location prior to booking.', 'driveria'), esc_html($city_name))
                    ),
                    array(
                        'q' => __('How do I register for driving lessons?', 'driveria'),
                        'a' => __('Simply fill out the online registration form on this page with your student information. An instructor will contact you via call or text to arrange scheduling.', 'driveria')
                    ),
                    array(
                        'q' => sprintf(__('How much do driving lessons cost in %s?', 'driveria'), esc_html($city_name)),
                        'a' => __('Prices vary by course package, ranging from $100 for a 90-minute single lesson up to $400 for comprehensive 1-on-1 or Adult Waiver courses.', 'driveria')
                    ),
                    array(
                        'q' => __('Which driving course should I choose?', 'driveria'),
                        'a' => __('The right course depends on your age, permit status, and experience level. Fill out the registration form, and our team will recommend the optimal course for you.', 'driveria')
                    )
                );

                foreach ($default_faqs as $idx => $faq) {
                    ?>
                    <div class="faq-accordion-item <?php echo $idx === 0 ? 'active' : ''; ?>">
                        <button class="faq-question" type="button">
                            <span><?php echo esc_html($faq['q']); ?></span>
                            <i class="fa-solid fa-chevron-down faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p><?php echo esc_html($faq['a']); ?></p>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

    </div>
</section>
<?php endif; ?>

<?php
endwhile;
endif;

get_footer();
