<?php
/**
 * Template Name: Front Page / Home Page
 *
 * Driveria Front Page Template - 100% Customizer Editable Text, Images & Headings
 *
 * @package Driveria
 */

get_header();

// Dynamic Hero Backgrounds from Customizer
$hero_bg1 = get_theme_mod('driveria_hero_bg1', 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&w=1920&q=80');
$hero_bg2 = get_theme_mod('driveria_hero_bg2', 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=1920&q=80');
$hero_bg3 = get_theme_mod('driveria_hero_bg3', 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=1920&q=80');
?>

<!-- =========================================================================
     1. HERO BANNER SECTION (Editable Background Images & Text)
     ========================================================================= -->
<section class="driveria-hero-banner" id="hero-banner">
    <!-- Background Slideshow -->
    <div class="hero-slides-wrapper">
        <?php if ($hero_bg1) : ?>
            <div class="hero-slide active" style="background-image: url('<?php echo esc_url($hero_bg1); ?>');"></div>
        <?php endif; ?>
        <?php if ($hero_bg2) : ?>
            <div class="hero-slide" style="background-image: url('<?php echo esc_url($hero_bg2); ?>');"></div>
        <?php endif; ?>
        <?php if ($hero_bg3) : ?>
            <div class="hero-slide" style="background-image: url('<?php echo esc_url($hero_bg3); ?>');"></div>
        <?php endif; ?>
    </div>

    <!-- Dark Overlay -->
    <div class="hero-overlay"></div>

   <!-- Centered Animated Content -->
    <div class="driveria-container hero-center-content">
       <h1 class="hero-heading animated-text-up" id="heroHeading">
    <?php 
    $title = get_theme_mod('driveria_hero_title', 'BEST DMV CERTIFIED DRIVING & AND TRAFFIC SCHOOL IN VIRGINIA');
    echo wp_kses_post($title);
    ?>
</h1>



        <p class="hero-subtext animated-text-up stagger-1" id="heroSubtext">
            <?php echo esc_html(get_theme_mod('driveria_hero_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.')); ?>
        </p>

        <div class="hero-actions-center animated-text-up stagger-2" id="heroActions">
            <a href="#enroll-registration" class="btn-driveria btn-yellow-pill">
                <span><?php echo esc_html(get_theme_mod('driveria_hero_btn_text', 'REGISTER NOW')); ?></span>
            </a>

            <a href="#" class="btn-play-video popup-video" target="_blank">
                <div class="play-circle"><i class="fa-solid fa-play"></i></div>
                <span>WATCH INTRO</span>
            </a>
        </div>
    </div>

    <!-- 4 Bottom Feature Cards Overlay -->
    <div class="hero-bottom-cards-wrapper">
        <div class="driveria-container">
            <div class="hero-cards-grid">
                <!-- Card 1: Affordable Pricing -->
                <div class="hero-feature-card card-white card-animated stagger-1">
                    <div class="card-icon-line">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#FFB800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M12 7v10M15 9.5a2.5 2.5 0 0 0-5 0c0 2.5 5 2.5 5 5a2.5 2.5 0 0 1-5 0"></path>
                        </svg>
                    </div>
                    <h3 class="card-title"><?php echo esc_html(get_theme_mod('driveria_hero_card1_title', 'Affordable Pricing')); ?></h3>
                    <p class="card-desc"><?php echo esc_html(get_theme_mod('driveria_hero_card1_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor')); ?></p>
                    <a href="<?php echo esc_url(get_theme_mod('driveria_hero_card1_link_url', '#pricing')); ?>" class="card-link"><?php echo esc_html(get_theme_mod('driveria_hero_card1_link_text', 'READ MORE')); ?> <i class="fa-solid fa-arrow-right"></i></a>
                </div>

                <!-- Card 2: Safety Driving -->
                <div class="hero-feature-card card-white card-animated stagger-2">
                    <div class="card-icon-line">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#FFB800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9"></circle>
                            <circle cx="12" cy="12" r="3"></circle>
                            <line x1="12" y1="3" x2="12" y2="9"></line>
                            <line x1="4.2" y1="16.5" x2="9.4" y2="13.5"></line>
                            <line x1="19.8" y1="16.5" x2="14.6" y2="13.5"></line>
                        </svg>
                    </div>
                    <h3 class="card-title"><?php echo esc_html(get_theme_mod('driveria_hero_card2_title', 'Safety Driving')); ?></h3>
                    <p class="card-desc"><?php echo esc_html(get_theme_mod('driveria_hero_card2_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor')); ?></p>
                    <a href="<?php echo esc_url(get_theme_mod('driveria_hero_card2_link_url', '#courses')); ?>" class="card-link"><?php echo esc_html(get_theme_mod('driveria_hero_card2_link_text', 'READ MORE')); ?> <i class="fa-solid fa-arrow-right"></i></a>
                </div>

                <!-- Card 3: Traffic Rules -->
                <div class="hero-feature-card card-yellow card-animated stagger-3">
                    <div class="card-icon-line">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#0F172A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            <path d="M9 12h6M9 16h6"></path>
                        </svg>
                    </div>
                    <h3 class="card-title text-dark"><?php echo esc_html(get_theme_mod('driveria_hero_card3_title', 'Traffic Rules')); ?></h3>
                    <p class="card-desc text-dark-muted"><?php echo esc_html(get_theme_mod('driveria_hero_card3_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor')); ?></p>
                    <a href="<?php echo esc_url(get_theme_mod('driveria_hero_card3_link_url', '#courses')); ?>" class="card-link card-link-dark"><?php echo esc_html(get_theme_mod('driveria_hero_card3_link_text', 'READ MORE')); ?> <i class="fa-solid fa-arrow-right"></i></a>
                </div>

                <!-- Card 4: Instructor Photo Card -->
                <div class="hero-feature-card card-image card-animated stagger-4">
                    <div class="image-overlay-box">
                        <img src="<?php echo esc_url(get_theme_mod('driveria_hero_card4_img', 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=800&q=80')); ?>" alt="Driving Practice Car" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.section-enroll-registration {
    padding-top: 330px !important;
}
@media (max-width: 1024px) {
    .section-enroll-registration {
        padding-top: 290px !important;
    }
}
@media (max-width: 768px) {
    .section-enroll-registration {
        padding-top: 160px !important;
    }
}
</style>

<!-- =========================================================================
     1.5 ENROLL REGISTRATION FORM SECTION (Right below Top Hero)
     ========================================================================= -->
<section class="section-enroll-registration" id="enroll-registration">
    <div class="driveria-container">
        <div class="enroll-section-header">
            <span class="enroll-subtitle-accent"><?php echo esc_html(get_theme_mod('driveria_enroll_subtitle', 'Online Registration Available')); ?></span>
            <h2 class="enroll-main-heading"><?php echo esc_html(get_theme_mod('driveria_enroll_heading', 'ENROLL IN DMV-APPROVED DRIVER TRAINING TODAY!')); ?></h2>
            <p class="enroll-main-desc">
                <?php echo esc_html(get_theme_mod('driveria_enroll_desc', 'As one of the Best Driving Schools near you, we are proud to offer programs designed to help new drivers learn essential skills with ease. We make the entire learning experience convenient through our free pickup and drop-off facility.')); ?>
            </p>
        </div>

        <div class="enroll-form-card-v2">
            <form id="driveriaQuickEnrollForm" class="driveria-ajax-form">
                <input type="hidden" name="form_source" value="Homepage Quick Enroll Form" />
                <!-- Row 1: Full Name, Email, Phone & Zip Code -->
                <div class="enroll-form-row" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                    <div class="enroll-field-group">
                        <label for="enroll_name" class="field-label"><?php esc_html_e('Full Name *', 'driveria'); ?></label>
                        <input type="text" id="enroll_name" name="student_name" class="enroll-input-text" required placeholder="<?php esc_attr_e('e.g. Enter Your Name', 'driveria'); ?>" />
                    </div>

                    <div class="enroll-field-group">
                        <label for="enroll_email" class="field-label"><?php esc_html_e('Email Address *', 'driveria'); ?></label>
                        <input type="email" id="enroll_email" name="student_email" class="enroll-input-text" required placeholder="<?php esc_attr_e('gp@example.com', 'driveria'); ?>" />
                    </div>

                    <div class="enroll-field-group">
                        <label for="enroll_phone" class="field-label"><?php esc_html_e('Phone Number *', 'driveria'); ?></label>
                        <input type="tel" id="enroll_phone" name="student_phone" class="enroll-input-text" required placeholder="<?php esc_attr_e('(571) 501-3404', 'Prime Driving school'); ?>" />
                    </div>

                    <div class="enroll-field-group">
                        <label for="enroll_zip" class="field-label"><?php esc_html_e('Zip Code', 'driveria'); ?></label>
                        <input type="text" id="enroll_zip" name="student_zip" class="enroll-input-text" placeholder="<?php esc_attr_e('Zip / Postal Code', 'Prime Driving School'); ?>" />
                    </div>

                    <div class="enroll-field-group" style="grid-column: span 2;">
                        <label for="enroll_address" class="field-label"><?php esc_html_e('Street / Pickup Address *', 'driveria'); ?></label>
                        <input type="text" id="enroll_address" name="student_address" class="enroll-input-text" required placeholder="<?php esc_attr_e('Street Address for Pickup / Location', 'GP'); ?>" />
                    </div>
					
					<div class="enroll-field-group">
        <label for="enroll_city" class="field-label"><?php esc_html_e('City *', 'driveria'); ?></label>
        <input type="text" id="enroll_city" name="student_city" class="enroll-input-text" required placeholder="<?php esc_attr_e('e.g. VA', 'driveria'); ?>" />
    </div>
                </div>

                <!-- Row 2: Age, Gender & Permit Radio Groups -->
                <div class="enroll-form-row">
                    <div class="enroll-field-group">
                        <label class="field-label"><?php esc_html_e('Your Age', 'driveria'); ?></label>
                        <div class="radio-group-wrap">
                            <label class="radio-option-label">
                                <input type="radio" name="student_age_group" value="Teen (Below 18)" checked />
                                <span><?php esc_html_e('Teen (Below 18)', 'Prime Driving School'); ?></span>
                            </label>
                            <label class="radio-option-label">
                                <input type="radio" name="student_age_group" value="Adult (Above 18)" />
                                <span><?php esc_html_e('Adult (Above 18)', 'Prime'); ?></span>
                            </label>
                        </div>
                    </div>

                    <div class="enroll-field-group">
                        <label class="field-label"><?php esc_html_e('Gender', 'driveria'); ?></label>
                        <div class="radio-group-wrap">
                            <label class="radio-option-label">
                                <input type="radio" name="student_gender" value="Male" checked />
                                <span><?php esc_html_e('Male', 'Prime'); ?></span>
                            </label>
                            <label class="radio-option-label">
                                <input type="radio" name="student_gender" value="Female" />
                                <span><?php esc_html_e('Female', 'Prime'); ?></span>
                            </label>
                        </div>
                    </div>

                    <div class="enroll-field-group">
                        <label class="field-label"><?php esc_html_e('Do You Have Valid Learner\'s Permit?', 'driveria'); ?></label>
                        <div class="radio-group-wrap">
                            <label class="radio-option-label">
                                <input type="radio" name="has_permit" value="Yes" checked />
                                <span><?php esc_html_e('Yes', 'Prime'); ?></span>
                            </label>
                            <label class="radio-option-label">
                                <input type="radio" name="has_permit" value="No" />
                                <span><?php esc_html_e('No', 'Prime'); ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Row 3: Course Selection (Dynamic CPT) -->
                <div class="enroll-form-row" style="grid-template-columns: 1fr;">
                    <div class="enroll-field-group">
                        <label for="enroll_course_select" class="field-label"><?php esc_html_e('What class are you registering for? *', 'driveria'); ?></label>
                        <select id="enroll_course_select" name="course_selected" class="enroll-select-v2" required>
                            <option value=""><?php esc_html_e('-- Select Prime Driving School Course Option --', 'Prime'); ?></option>
                            <?php echo driveria_render_course_options(); ?>
                        </select>
                    </div>
                </div>

                <!-- Row 4: Comments / Questions -->
                <div class="enroll-field-group" style="margin-bottom: 25px;">
                    <label for="enroll_comments" class="field-label"><?php esc_html_e('Comments / Questions?', 'driveria'); ?></label>
                    <textarea id="enroll_comments" name="notes" rows="3" class="enroll-textarea-v2" placeholder="<?php esc_attr_e('Tell us about your driving experience or preferred pickup location...', 'driveria'); ?>"></textarea>
                </div>

                <div id="quickEnrollResponseMsg" class="form-response-msg" style="margin-bottom: 20px;"></div>

                <!-- Row 5: Submit Button -->
                <div style="text-align: left;">
                    <button type="submit" class="btn-enroll-submit">
                        <span><?php esc_html_e('SUBMIT REGISTRATION', 'driveria'); ?></span>
                        <i class="fa-solid fa-paper-plane" style="margin-left: 8px;"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- =========================================================================
     2. DRIVING COURSES GRID SECTION
     ========================================================================= -->
<section class="driveria-section section-courses" id="courses">
    <div class="driveria-container">
        <div class="section-title-wrap">
            <span class="section-subtitle"><i class="fa-solid fa-graduation-cap"></i> <?php echo esc_html(get_theme_mod('driveria_courses_subtitle', 'Our Programs')); ?></span>
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('driveria_courses_title', 'Popular Driving Courses')); ?></h2>
            <p class="section-desc"><?php echo esc_html(get_theme_mod('driveria_courses_desc', 'Choose from specialized packages designed for beginners, teens, adults, and defensive drivers.')); ?></p>
        </div>

        <div class="courses-carousel-container">
            <div class="swiper courses-swiper">
                <div class="swiper-wrapper">
                    <?php
                    $course_query = new WP_Query(array(
                        'post_type'      => 'driveria_course',
                        'posts_per_page' => 12,
                        'orderby'        => 'date',
                        'order'          => 'ASC'
                    ));

                    if ($course_query->have_posts()) :
                        while ($course_query->have_posts()) : $course_query->the_post();
                            $price    = driveria_get_course_meta(get_the_ID(), 'course_price', '');
                            $duration = driveria_get_course_meta(get_the_ID(), 'course_duration', '');
                            $lessons  = driveria_get_course_meta(get_the_ID(), 'course_lessons', '');
                            $level    = driveria_get_course_meta(get_the_ID(), 'course_level', '');
                            $badge    = driveria_get_course_meta(get_the_ID(), 'course_badge', '');
                            $features = driveria_get_course_meta(get_the_ID(), 'course_features', '');
                            ?>
                            <div class="swiper-slide">
                                <div class="course-card">
                                    <?php if (!empty($badge) || !empty($price)) : ?>
                                        <div class="course-card-header">
                                            <?php if (!empty($badge)) : ?>
                                                <span class="course-badge"><?php echo esc_html($badge); ?></span>
                                            <?php else : ?>
                                                <span></span>
                                            <?php endif; ?>

                                            <?php if (!empty($price)) : ?>
                                                <div class="course-price"><?php echo esc_html($price); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="course-card-body">
                                        <h3 class="course-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <p class="course-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                                        
                                         <?php 
                                         $features_arr = array();
                                         if (!empty($features)) {
                                             $features_arr = explode("\n", str_replace("\r", "", $features));
                                             $features_arr = array_filter(array_map('trim', $features_arr));
                                         }
                                         
                                         if (!empty($features_arr)) : ?>
                                             <div class="course-meta">
                                                 <?php foreach ($features_arr as $feat) : ?>
                                                     <span><i class="fa-solid fa-circle-check"></i> <?php echo esc_html($feat); ?></span>
                                                 <?php endforeach; ?>
                                             </div>
                                         <?php elseif (!empty($duration) || !empty($lessons) || !empty($level)) : ?>
                                             <div class="course-meta">
                                                 <?php if (!empty($duration)) : ?>
                                                     <span><i class="fa-regular fa-clock"></i> <?php echo esc_html($duration); ?></span>
                                                 <?php endif; ?>

                                                 <?php if (!empty($lessons)) : ?>
                                                     <span><i class="fa-solid fa-list-check"></i> <?php echo esc_html($lessons); ?></span>
                                                 <?php endif; ?>

                                                 <?php if (!empty($level)) : ?>
                                                     <span><i class="fa-solid fa-layer-group"></i> <?php echo esc_html($level); ?></span>
                                                 <?php endif; ?>
                                             </div>
                                         <?php endif; ?>
                                    </div>

                                    <div class="course-card-footer">
                                        <a href="<?php the_permalink(); ?>" class="btn-view-details">
                                            <i class="fa-solid fa-eye"></i>
                                            <span><?php esc_html_e('View Details', 'driveria'); ?></span>
                                        </a>
                                        <?php $checkout_url = driveria_get_course_checkout_url(get_the_ID()); ?>
                                        <a href="<?php echo esc_url($checkout_url); ?>" class="btn-driveria course-btn" data-course="<?php echo esc_attr(get_the_title()); ?>">
                                            <span><?php esc_html_e('Enroll Now', 'Prime'); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
                
                <!-- Swiper Pagination Dots -->
                <div class="swiper-pagination courses-swiper-pagination"></div>
            </div>

            <!-- Swiper Navigation Arrows -->
            <button type="button" class="courses-swiper-btn-prev swiper-nav-arrow" aria-label="Previous Slide">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button type="button" class="courses-swiper-btn-next swiper-nav-arrow" aria-label="Next Slide">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- =========================================================================
     3. WHY CHOOSE US SECTION
     ========================================================================= -->
<section class="driveria-section section-why-us" id="why-us">
    <div class="driveria-container why-us-grid">
        <div class="why-us-image-wrap">
            <img src="<?php echo esc_url(get_theme_mod('driveria_whyus_img', 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&w=800&q=80')); ?>" alt="Driving Lesson Student" class="why-us-img" />
            <div class="experience-badge">
                <span class="exp-num"><?php echo esc_html(get_theme_mod('driveria_whyus_exp_num', '5+')); ?></span>
                <span class="exp-text"><?php echo esc_html(get_theme_mod('driveria_whyus_exp_text', 'Years of Excellence')); ?></span>
            </div>
        </div>

        <div class="why-us-content">
            <span class="section-subtitle"><i class="fa-solid fa-circle-check"></i> <?php echo esc_html(get_theme_mod('driveria_whyus_subtitle', 'Why Choose Prime Driving School')); ?></span>
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('driveria_whyus_title', 'We Build Confident & Safe Drivers For Life')); ?></h2>
            <p class="section-desc"><?php echo esc_html(get_theme_mod('driveria_whyus_desc', 'Our driving academy combines structured lesson plans, patient certified instructors, and high safety standards to make learning to drive stress-free.')); ?></p>

            <ul class="why-us-checklist">
                <li>
                    <div class="chk-icon"><i class="fa-solid fa-check"></i></div>
                    <div>
                        <strong><?php echo esc_html(get_theme_mod('driveria_whyus_chk1_title', 'FBI background-checked driving instructor.')); ?></strong>
<!--                         <p><?php echo esc_html(get_theme_mod('driveria_whyus_chk1_desc', 'We pick you up directly from your home, school, or workplace for every behind-the-wheel lesson.')); ?></p>
                    </div> -->
                </li>
                <li>
                    <div class="chk-icon"><i class="fa-solid fa-check"></i></div>
                    <div>
                        <strong><?php echo esc_html(get_theme_mod('driveria_whyus_chk2_title', 'Committed to providing superior training and a safe professional environment.')); ?></strong>
<!--                         <p><?php echo esc_html(get_theme_mod('driveria_whyus_chk2_desc', 'All training vehicles are regularly inspected, dual-controlled, insured, and climate-controlled.')); ?></p> -->
                    </div>
                </li>
                <li>
                    <div class="chk-icon"><i class="fa-solid fa-check"></i></div>
                    <div>
                        <strong><?php echo esc_html(get_theme_mod('driveria_whyus_chk3_title', 'Founded on diversity professionalism and integrity.')); ?></strong>
<!--                         <p><?php echo esc_html(get_theme_mod('driveria_whyus_chk3_desc', 'Affordable course packages with no hidden fees and easy installment payment options.')); ?></p> -->
                    </div>
                </li>
				
				
				 <li>
                    <div class="chk-icon"><i class="fa-solid fa-check"></i></div>
                    <div>
                        <strong><?php echo esc_html(get_theme_mod('driveria_whyus_chk3_title', 'DMV-certified driving school.')); ?></strong>
                 
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>



<!-- =========================================================================
     5. PRICING PACKAGES SECTION
     ========================================================================= -->
<section class="driveria-section section-pricing" id="pricing">
    <div class="driveria-container">
        <div class="section-title-wrap">
            <span class="section-subtitle"><i class="fa-solid fa-tags"></i> <?php esc_html_e('Transparent Pricing', 'driveria'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Simple & Affordable Plans', 'driveria'); ?></h2>
            <p class="section-desc"><?php esc_html_e('No hidden charges. Choose the driving package that fits your learning goals.', 'driveria'); ?></p>
        </div>

        <div class="pricing-grid">
            <!-- Plan 1 -->
            <div class="pricing-card">
                <div class="pricing-header">
                    <h3>Adult Waiver Course</h3>
                    <div class="price-value">$400 <span>/ 7 Days</span></div>
                </div>
                <ul class="pricing-features">
                    <li><i class="fa-solid fa-check"></i>Must know how to drive</li>
                    <li><i class="fa-solid fa-check"></i>Have a drivers education certificate</li>
                    <li><i class="fa-solid fa-check"></i>7 days course</li>
                    <li class=""><i class="fa-solid fa-check"></i>Valid Virginia permit</li>
					 <li class=""><i class="fa-solid fa-check"></i>50min driving per day</li>
					 <li class=""><i class="fa-solid fa-check"></i>50min observation per day</li>
					 <li class=""><i class="fa-solid fa-check"></i>Free pick up and drop off</li>
					 <li class="disabled"><i class="fa-solid fa-check"></i>Test and waiver upon passing successfully</li>
					 <li class=""><i class="fa-regular fa-note-sticky"></i><strong>Note: </strong> This Course Is Only For Experienced Drivers</li>
                </ul>
                <div class="pricing-footer">
                    <a href="#booking" class="btn-driveria btn-outline-driveria w-100">Choose Basic</a>
                </div>
            </div>

            <!-- Plan 2 (Popular) -->
            <div class="pricing-card popular">
                <div class="popular-ribbon">Most Popular</div>
                <div class="pricing-header">
                    <h3>Teenagers Driving License</h3>
                    <div class="price-value">$350 <span>/ 7 Days</span></div>
                </div>
                <ul class="pricing-features">
                    <li><i class="fa-solid fa-check"></i> Behind the Wheel course for experienced teens.</li>
                    <li><i class="fa-solid fa-check"></i>7 Days Course + Road Test Only for Under 18 Years Old Students</li>
                    <li><i class="fa-solid fa-check"></i> 50min driving per day</li>
                    <li><i class="fa-solid fa-check"></i> 50min observation per day</li>
					 <li><i class="fa-solid fa-check"></i> Free pick-up and drop-off</li>
                    <li><i class="fa-solid fa-check"></i> At the end of this course, successful candidates will be issued a license.</li>
					 <li><i class="fa-solid fa-check"></i> In order to get a license, you'll need to bring in a photocopy of your valid VA's learner permit,original DEC 1 card from high school, mandatory 45 hours driving experience, and a signed contract, which you can find here.</li>
                    <li><i class="fa-solid fa-file-lines"></i> <strong>Note:</strong> Once You Register Online Then Our Instructor Will Call Or Text You For The Schedule Thanks</li>
                </ul>
                <div class="pricing-footer">
                    <a href="#booking" class="btn-driveria btn-primary-driveria w-100">Choose Standard</a>
                </div>
            </div>

            <!-- Plan 3 -->
            <div class="pricing-card">
                <div class="pricing-header">
                    <h3>Behind the Wheel - Under 18 Yrs Only</h3>
                    <div class="price-value">$350 <span>/ 7 Days</span></div>
                </div>
                <ul class="pricing-features">
                    <li><i class="fa-solid fa-check"></i> 7 Days course for $350</li>
                    <li><i class="fa-solid fa-check"></i>50 min driving per day</li>
                    <li><i class="fa-solid fa-check"></i>50 min observation per day</li>
                    <li><i class="fa-solid fa-check"></i> Free pick-up and drop-off</li>
					<li><i class="fa-regular fa-file-lines"></i> Note: Once you register online then our instructor will call or text you</li>
                </ul>
                <div class="pricing-footer">
                    <a href="#booking" class="btn-driveria btn-outline-driveria w-100">Choose Complete</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     6. BOOKING & CONTACT FORM SECTION
     ========================================================================= -->
<section class="driveria-section section-booking" id="booking">
    <div class="driveria-container booking-container">
        <div class="booking-grid">
            <!-- Left Info Side -->
            <div class="booking-info">
                <span class="section-subtitle"><i class="fa-solid fa-calendar-days"></i> <?php esc_html_e('Quick Reservation', 'driveria'); ?></span>
                <h2 class="section-title"><?php esc_html_e('Book Your Driving Lesson Today', 'driveria'); ?></h2>
                <p class="section-desc"><?php esc_html_e('Fill out the form below to reserve your driving instructor and slot. We will confirm your session within 2 hours.', 'driveria'); ?></p>

                <div class="booking-perks">
                    <div class="perk-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Instant Confirmation & Free Cancellation</span>
                    </div>
<!--                     <div class="perk-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Choose Your Preferred Date & Time</span>
                    </div>
                    <div class="perk-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Flexible Payment On First Lesson</span>
                    </div> -->
                </div>
            </div>

            <!-- Right AJAX Form -->
            <div class="booking-form-card">
                <h3 class="form-title"><?php esc_html_e('Reserve Lesson Slot', 'driveria'); ?></h3>
                
                <form id="driveriaBookingForm" class="booking-form driveria-ajax-form">
                    <input type="hidden" name="form_source" value="Homepage Reserve Slot Form" />
                    <div class="form-group">
                        <label for="student_name"><?php esc_html_e('Full Name *', 'driveria'); ?></label>
                        <input type="text" id="student_name" name="student_name" placeholder="e.g. Prime Driving School" required />
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="student_email"><?php esc_html_e('Email Address *', 'driveria'); ?></label>
                            <input type="email" id="student_email" name="student_email" placeholder="info@example.com" required />
                        </div>
                        <div class="form-group">
                            <label for="student_phone"><?php esc_html_e('Phone Number *', 'driveria'); ?></label>
                            <input type="tel" id="student_phone" name="student_phone" placeholder="+1 (555) 000-0000" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="course_selected"><?php esc_html_e('Select Course', 'driveria'); ?></label>
                            <select id="course_selected" name="course_selected">
                                <option value=""><?php esc_html_e('-- Select Course Option --', 'driveria'); ?></option>
                                <?php echo driveria_render_course_options(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="preferred_date"><?php esc_html_e('Preferred Date', 'driveria'); ?></label>
                            <input type="date" id="preferred_date" name="preferred_date" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes"><?php esc_html_e('Special Notes / Pickup Address', 'driveria'); ?></label>
                        <textarea id="notes" name="notes" rows="3" placeholder="Enter your home address for pickup or any specific requirements..."></textarea>
                    </div>

                    <div id="bookingFormResponse" class="form-response-msg"></div>

                    <button type="submit" class="btn-driveria btn-primary-driveria submit-btn">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span><?php esc_html_e('Submit Lesson Booking', 'driveria'); ?></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     7. ELEMENTOR & PAGE CONTENT AREA (Required for Elementor Support)
     ========================================================================= -->
<?php
if (have_posts()) :
    while (have_posts()) : the_post();
        the_content();
    endwhile;
endif;
?>

<!-- =========================================================================
     8. VIRGINIA DMV-APPROVED DRIVER TRAINING COMPREHENSIVE GUIDE & FAQS
     ========================================================================= -->
<section class="driveria-section section-va-comprehensive-guide" style="padding: 80px 0; background: #F8FAFC; border-top: 1px solid #E2E8F0;">
    <div class="driveria-container" style="max-width: 1040px;">
        
        <!-- Header Banner Box -->
        <div class="guide-header-card shadow-sm" style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 24px; padding: 40px; margin-bottom: 35px;">
            <span style="background: rgba(37,99,235,0.1); color: #2563EB; font-weight: 800; font-size: 0.85rem; padding: 6px 16px; border-radius: 20px; text-transform: uppercase; display: inline-block; margin-bottom: 12px;">
                <i class="fa-solid fa-certificate"></i> DMV-Approved Driving School in Virginia
            </span>
            
            <h2 style="font-size: 2.2rem; font-weight: 900; color: #0F172A; margin-bottom: 16px; font-family: var(--driveria-font-heading); text-transform: uppercase;">
                DMV-Approved Driving School in Virginia
            </h2>

            <p style="font-size: 1.08rem; color: #334155; line-height: 1.85; margin-bottom: 16px; font-weight: 500;">
                Looking for a trusted driving school in Virginia for yourself or your teen? Prime Driving School provides DMV-approved driving training for teens and adults who want practical experience, safer driving habits, and more confidence behind the wheel.
            </p>

            <p style="font-size: 0.98rem; color: #64748B; line-height: 1.75; margin-bottom: 20px;">
                Whether you are learning to drive for the first time, preparing for your Virginia driver's license, looking for additional behind-the-wheel practice, or getting ready for a DMV road test, we offer driving programs for different experience levels and goals.
            </p>

            <div style="background: #F1F5F9; border-left: 4px solid #FFB800; border-radius: 12px; padding: 16px 20px; font-size: 0.95rem; color: #0F172A; font-weight: 700;">
                <i class="fa-solid fa-flag-checkered" style="color: #FFB800; margin-right: 8px;"></i>
                Ready to start? Complete the registration form and tell us your age, permit status, and driving goal. Our team can help you choose the right training option.
            </div>
        </div>

        <!-- 4 Pillar Content Cards Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(440px, 1fr)); gap: 25px; margin-bottom: 35px;">
            
            <!-- Pillar 1: Teen & Adult Driving Lessons -->
            <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 20px; padding: 30px;" class="shadow-sm">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0F172A; margin-bottom: 12px; font-family: var(--driveria-font-heading); text-transform: uppercase;">
                    <i class="fa-solid fa-user-graduate" style="color: #2563EB; margin-right: 8px;"></i> Driving Lessons for Teens and Adults
                </h3>
                <p style="font-size: 0.95rem; color: #475569; line-height: 1.65; margin-bottom: 14px;">
                    Learning to drive is an important step. Good instruction should help you understand the rules of the road and apply them during real driving situations. Prime Driving School offers instructor-guided driving lessons for teenagers, adults, beginners, permit holders, and students who need additional practice.
                </p>
                <div style="font-size: 0.88rem; font-weight: 700; color: #0F172A; margin-bottom: 10px;">Training covers essential topics:</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 0.85rem; color: #334155; margin-bottom: 16px;">
                    <div><i class="fa-solid fa-circle-check" style="color: #10B981;"></i> Vehicle Control & Steering</div>
                    <div><i class="fa-solid fa-circle-check" style="color: #10B981;"></i> Parking & Safe Turns</div>
                    <div><i class="fa-solid fa-circle-check" style="color: #10B981;"></i> Lane Changes & Signals</div>
                    <div><i class="fa-solid fa-circle-check" style="color: #10B981;"></i> Intersections & Blind-Spots</div>
                    <div><i class="fa-solid fa-circle-check" style="color: #10B981;"></i> Defensive & Highway Driving</div>
                    <div><i class="fa-solid fa-circle-check" style="color: #10B981;"></i> DMV Road-Test Prep</div>
                </div>
                <p style="font-size: 0.88rem; color: #64748B; font-weight: 600; margin: 0;">Our goal is to help students build skills they can use after the lesson ends.</p>
            </div>

            <!-- Pillar 2: What Prime Driving School Offers -->
            <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 20px; padding: 30px;" class="shadow-sm">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0F172A; margin-bottom: 12px; font-family: var(--driveria-font-heading); text-transform: uppercase;">
                    <i class="fa-solid fa-shield-halved" style="color: #FFB800; margin-right: 8px;"></i> What Does Prime Driving School Offer?
                </h3>
                <p style="font-size: 0.95rem; color: #475569; line-height: 1.65; margin-bottom: 14px;">
                    Prime Driving School offers DMV-approved driver training and practical behind-the-wheel instruction for teens and adults. Available services include:
                </p>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 0.85rem; color: #334155; margin-bottom: 16px;">
                    <div><i class="fa-solid fa-check" style="color: #2563EB;"></i> Teen Driving Lessons</div>
                    <div><i class="fa-solid fa-check" style="color: #2563EB;"></i> Behind-the-Wheel Training</div>
                    <div><i class="fa-solid fa-check" style="color: #2563EB;"></i> Teen 1-on-1 Training</div>
                    <div><i class="fa-solid fa-check" style="color: #2563EB;"></i> Adult Driving Lessons</div>
                    <div><i class="fa-solid fa-check" style="color: #2563EB;"></i> 90-Minute Single Lessons</div>
                    <div><i class="fa-solid fa-check" style="color: #2563EB;"></i> Multi-Class Packages</div>
                    <div><i class="fa-solid fa-check" style="color: #2563EB;"></i> Adult Waiver Course</div>
                    <div><i class="fa-solid fa-check" style="color: #2563EB;"></i> DMV Road Test Service</div>
                </div>
                <p style="font-size: 0.82rem; color: #94A3B8; margin: 0;">* Course eligibility, availability, pricing, and requirements can vary. Confirm details prior to registration.</p>
            </div>

            <!-- Pillar 3: Defensive Driving & Teen Focus -->
            <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 20px; padding: 30px;" class="shadow-sm">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0F172A; margin-bottom: 12px; font-family: var(--driveria-font-heading); text-transform: uppercase;">
                    <i class="fa-solid fa-car-side" style="color: #10B981; margin-right: 8px;"></i> Defensive Driving & Teen Programs
                </h3>
                <p style="font-size: 0.95rem; color: #475569; line-height: 1.65; margin-bottom: 12px;">
                    Teen drivers need time and practice to develop safe driving habits. Our instructors observe how a student drives and provide patient guidance to identify areas needing practice.
                </p>
                <p style="font-size: 0.95rem; color: #475569; line-height: 1.65; margin: 0;">
                    Defensive driving means scanning the road ahead, recognizing potential hazards early, maintaining safe following distances, checking blind spots, and making calm, unhurried decisions behind the wheel.
                </p>
            </div>

            <!-- Pillar 4: Adult Lessons & DMV Test Prep -->
            <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 20px; padding: 30px;" class="shadow-sm">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0F172A; margin-bottom: 12px; font-family: var(--driveria-font-heading); text-transform: uppercase;">
                    <i class="fa-solid fa-user-check" style="color: #8B5CF6; margin-right: 8px;"></i> Adult Lessons & DMV Test Preparation
                </h3>
                <p style="font-size: 0.95rem; color: #475569; line-height: 1.65; margin-bottom: 12px;">
                    Adults learn to drive for many reasons: learning for the first time, returning after several years, or moving to Virginia. You do not need to be experienced before taking a lesson.
                </p>
                <p style="font-size: 0.95rem; color: #475569; line-height: 1.65; margin: 0;">
                    Preparing for a DMV road test can feel stressful. We offer practical lessons and list a DMV Appointment Road Test service ($200) allowing eligible students to use the school's dual-control vehicle for their test.
                </p>
            </div>

        </div>

        <!-- Serving Northern Virginia & 5 Steps Card -->
        <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 20px; padding: 30px; margin-bottom: 35px;" class="shadow-sm">
            <h3 style="font-size: 1.25rem; font-weight: 800; color: #0F172A; margin-bottom: 12px; font-family: var(--driveria-font-heading); text-transform: uppercase;">
                <i class="fa-solid fa-map-location-dot" style="color: #2563EB; margin-right: 8px;"></i> Serving Northern Virginia Communities
            </h3>
            <p style="font-size: 0.95rem; color: #475569; line-height: 1.65; margin-bottom: 16px;">
                Prime Driving School serves students across multiple Northern Virginia communities including Fairfax, Vienna, Falls Church, Springfield, McLean, Arlington, Woodbridge, Lorton, Ashburn, Herndon, Reston, Chantilly, Centreville, South Riding, Sterling, Leesburg, and Aldie.
            </p>
            
            <div style="font-size: 0.9rem; font-weight: 800; color: #0F172A; text-transform: uppercase; margin-bottom: 10px;">How to Register in 5 Simple Steps:</div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px;">
                <div style="background: #F8FAFC; padding: 12px; border-radius: 10px; border: 1px solid #E2E8F0; font-size: 0.85rem;"><strong>1. Choose Course</strong><br><span style="color:#64748B;">Select based on age & goal.</span></div>
                <div style="background: #F8FAFC; padding: 12px; border-radius: 10px; border: 1px solid #E2E8F0; font-size: 0.85rem;"><strong>2. Fill Form</strong><br><span style="color:#64748B;">Provide contact & permit info.</span></div>
                <div style="background: #F8FAFC; padding: 12px; border-radius: 10px; border: 1px solid #E2E8F0; font-size: 0.85rem;"><strong>3. State Needs</strong><br><span style="color:#64748B;">Ask specific questions.</span></div>
                <div style="background: #F8FAFC; padding: 12px; border-radius: 10px; border: 1px solid #E2E8F0; font-size: 0.85rem;"><strong>4. Scheduling</strong><br><span style="color:#64748B;">Our team contacts you.</span></div>
                <div style="background: #F8FAFC; padding: 12px; border-radius: 10px; border: 1px solid #E2E8F0; font-size: 0.85rem;"><strong>5. Confirm</strong><br><span style="color:#64748B;">Verify price & schedule.</span></div>
            </div>
        </div>

        <!-- FAQs Accordion Box -->
        <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 20px; padding: 35px; margin-bottom: 35px;" class="shadow-sm">
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #0F172A; margin-bottom: 20px; font-family: var(--driveria-font-heading); text-transform: uppercase;">
                <i class="fa-solid fa-circle-question" style="color: #2563EB; margin-right: 8px;"></i> Frequently Asked Questions
            </h3>

            <div style="display: flex; flex-direction: column; gap: 14px;">
                <details style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px 20px; cursor: pointer;" open>
                    <summary style="font-weight: 800; color: #0F172A; font-size: 0.98rem; list-style: none;">Is Prime Driving School DMV-approved?</summary>
                    <p style="font-size: 0.92rem; color: #475569; margin-top: 10px; line-height: 1.6;">Prime Driving School identifies itself as a DMV-certified or approved driving school and offers DMV-approved driver-training options. Course requirements can vary, so confirm requirements before enrollment.</p>
                </details>

                <details style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px 20px; cursor: pointer;">
                    <summary style="font-weight: 800; color: #0F172A; font-size: 0.98rem; list-style: none;">Does Prime Driving School offer teen and adult driving lessons?</summary>
                    <p style="font-size: 0.92rem; color: #475569; margin-top: 10px; line-height: 1.6;">Yes. We offer teen-focused programs including Behind the Wheel training and Teen 1-on-1 instruction, as well as individual adult lessons and multi-class options.</p>
                </details>

                <details style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px 20px; cursor: pointer;">
                    <summary style="font-weight: 800; color: #0F172A; font-size: 0.98rem; list-style: none;">How much is a 90-minute driving lesson & DMV test service?</summary>
                    <p style="font-size: 0.92rem; color: #475569; margin-top: 10px; line-height: 1.6;">The current listed price for the 90-minute class is $100, and the DMV Appointment Road Test service is $200. Confirm eligibility, vehicle requirements, and current pricing before booking.</p>
                </details>

                <details style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px 20px; cursor: pointer;">
                    <summary style="font-weight: 800; color: #0F172A; font-size: 0.98rem; list-style: none;">Does Prime Driving School provide pickup and drop-off?</summary>
                    <p style="font-size: 0.92rem; color: #475569; margin-top: 10px; line-height: 1.6;">Pickup and drop-off are listed with applicable courses. Availability may depend on selected course and service area, so confirm details when registering.</p>
                </details>
            </div>
        </div>

        <!-- Bottom CTA Navy Card -->
        <div style="background: #0B132B; color: #FFFFFF; border-radius: 24px; padding: 40px; text-align: center; box-shadow: 0 15px 35px rgba(11,19,43,0.15);">
            <h3 style="font-size: 1.8rem; font-weight: 900; color: #FFFFFF; margin-bottom: 12px; font-family: var(--driveria-font-heading); text-transform: uppercase;">
                Ready to Start Driving?
            </h3>
            <p style="font-size: 1rem; color: #CBD5E1; line-height: 1.65; max-width: 750px; margin: 0 auto 25px auto;">
                Whether you are a teenager working toward your first license, an adult learning to drive, or preparing for a DMV road test, Prime Driving School offers training options for your goals. Complete the registration form today!
            </p>
            <div style="display: flex; flex-wrap: wrap; gap: 14px; justify-content: center; align-items: center;">
                <a href="#enroll-registration" style="padding: 12px 28px; background: #FFB800; color: #0F172A; font-weight: 900; border-radius: 30px; text-decoration: none; text-transform: uppercase; font-size: 0.92rem;">
                    COMPLETE REGISTRATION FORM
                </a>
                <a href="tel:5715013404" style="padding: 12px 20px; background: rgba(255,255,255,0.1); color: #FFFFFF; border: 1px solid rgba(255,255,255,0.2); font-weight: 700; border-radius: 30px; text-decoration: none; font-size: 0.92rem;">
                    <i class="fa-solid fa-phone" style="color: #FFB800;"></i> (571) 501-3404
                </a>
                <a href="mailto:info@primedrivingschoolva.com" style="padding: 12px 20px; background: rgba(255,255,255,0.1); color: #FFFFFF; border: 1px solid rgba(255,255,255,0.2); font-weight: 700; border-radius: 30px; text-decoration: none; font-size: 0.92rem;">
                    <i class="fa-solid fa-envelope" style="color: #FFB800;"></i> info@primedrivingschoolva.com
                </a>
            </div>
        </div>

    </div>
</section>

<?php
get_footer();
