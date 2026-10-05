<?php
/**
 * Template Name: Single Course Detail Page (with Sidebar Enroll Form)
 *
 * Driveria Single Course Page Template for Pages
 *
 * @package Driveria
 */

get_header();

if (have_posts()) : while (have_posts()) : the_post();
    $page_id      = get_the_ID();
    $course_title = get_the_title();
    $price        = driveria_get_course_meta($page_id, 'course_price', '');
    $duration     = driveria_get_course_meta($page_id, 'course_duration', '');
    $lessons      = driveria_get_course_meta($page_id, 'course_lessons', '');
    $level        = driveria_get_course_meta($page_id, 'course_level', '');
    $badge        = driveria_get_course_meta($page_id, 'course_badge', '');
?>

<!-- =========================================================================
     1. SPACIOUS CLEAN HERO HEADER (No form cramming)
     ========================================================================= -->
<section class="single-course-hero-banner">
    <div class="driveria-container">
        <?php if (!empty($badge)) : ?>
            <div class="course-badge-pill"><?php echo esc_html($badge); ?></div>
        <?php endif; ?>
        
        <h1 class="single-course-title"><?php echo esc_html($course_title); ?></h1>
        
        <?php if (!empty($price) || !empty($duration) || !empty($lessons) || !empty($level)) : ?>
            <div class="single-course-meta-pills">
                <?php if (!empty($price)) : ?>
                    <span class="meta-pill"><i class="fa-solid fa-tag"></i> <strong><?php echo esc_html($price); ?></strong></span>
                <?php endif; ?>
                <?php if (!empty($duration)) : ?>
                    <span class="meta-pill"><i class="fa-regular fa-clock"></i> <?php echo esc_html($duration); ?></span>
                <?php endif; ?>
                <?php if (!empty($lessons)) : ?>
                    <span class="meta-pill"><i class="fa-solid fa-list-check"></i> <?php echo esc_html($lessons); ?></span>
                <?php endif; ?>
                <?php if (!empty($level)) : ?>
                    <span class="meta-pill"><i class="fa-solid fa-layer-group"></i> <?php echo esc_html($level); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <p class="single-course-excerpt">
            <?php echo wp_trim_words(get_the_excerpt(), 35, '...'); ?>
        </p>
    </div>
</section>

<!-- =========================================================================
     2. MAIN CONTENT GRID (About Course + Registration Form Sidebar)
     ========================================================================= -->
<div class="driveria-container single-course-main-wrapper" style="padding: 70px 0;">
    <div class="single-course-content-grid">
        
        <!-- Left Side: Course Content & Details -->
        <main class="course-left-col">
            <?php if (has_post_thumbnail()) : ?>
                <div class="course-featured-img" style="margin-bottom: 35px; border-radius: 20px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.08);">
                    <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; display: block;')); ?>
                </div>
            <?php endif; ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('single-course-article'); ?>>
                <div class="course-article-body">
                    <h2 class="course-sec-heading"><?php esc_html_e('About This Driving Course', 'driveria'); ?></h2>
                    
                    <div class="course-entry-content">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    $learn_topics_str = driveria_get_course_meta($course_id, 'course_learn_topics', '');
                    $learn_topics = array();
                    if (!empty(trim($learn_topics_str))) {
                        $raw_lines = explode("\n", $learn_topics_str);
                        foreach ($raw_lines as $r_line) {
                            $clean = trim($r_line);
                            if (!empty($clean)) {
                                $learn_topics[] = $clean;
                            }
                        }
                    } else {
                        // Default fallback topics
                        $learn_topics = array(
                            __('Master vehicle controls, cockpit setup, and mirror alignment', 'driveria'),
                            __('Parallel parking, three-point turns, and reverse driving skills', 'driveria'),
                            __('Highway merging, lane positioning, and night driving confidence', 'driveria'),
                            __('Defensive driving tactics and road hazard anticipation', 'driveria'),
                            __('Official DMV behind-the-wheel test route preparation', 'driveria'),
                        );
                    }

                    if (!empty($learn_topics)) :
                    ?>
                    <div class="learning-highlights-box">
                        <h3 class="box-title"><i class="fa-solid fa-graduation-cap"></i> <?php esc_html_e('What You Will Learn In This Program', 'driveria'); ?></h3>
                        <ul class="learning-checklist">
                            <?php foreach ($learn_topics as $topic) : ?>
                                <li><i class="fa-solid fa-circle-check"></i> <?php echo esc_html($topic); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <div class="pickup-guarantee-banner">
                        <div class="banner-icon"><i class="fa-solid fa-car-side"></i></div>
                        <div>
                            <h4><?php esc_html_e('Free Doorstep Pickup & Drop-Off', 'driveria'); ?></h4>
                            <p><?php esc_html_e('For every behind-the-wheel lesson, our licensed instructor will pick you up directly from your home, school, or office and drop you off safely.', 'driveria'); ?></p>
                        </div>
                    </div>
                </div>
            </article>
        </main>

        <!-- Right Side: Sticky Sidebar with ENROLL REGISTRATION FORM -->
        <aside class="course-right-sidebar">
            <div class="sidebar-enroll-card-v2">
                <div class="enroll-card-header">
                    <span class="card-subtitle"><?php esc_html_e('Online Registration Available', 'driveria'); ?></span>
                    <h3 class="card-heading"><?php esc_html_e('REGISTER FOR THIS COURSE', 'driveria'); ?></h3>
                    <p class="card-desc"><?php esc_html_e('Reserve your slot now & proceed to payment checkout', 'driveria'); ?></p>
                </div>

                <form id="driveriaSidebarEnrollForm" class="driveria-ajax-form">
                    <input type="hidden" name="course_selected" value="<?php echo esc_attr($course_title); ?>" />
                    <input type="hidden" name="form_source" value="Single Course Sidebar Form" />

                    <div class="form-field-item">
                        <label><?php esc_html_e('Full Name *', 'driveria'); ?></label>
                        <input type="text" name="student_name" class="enroll-input-text" required placeholder="e.g. John Doe" />
                    </div>

                    <div class="form-field-item">
                        <label><?php esc_html_e('Email Address *', 'driveria'); ?></label>
                        <input type="email" name="student_email" class="enroll-input-text" required placeholder="john@example.com" />
                    </div>

                    <div class="form-field-item">
                        <label><?php esc_html_e('Phone Number *', 'driveria'); ?></label>
                        <input type="tel" name="student_phone" class="enroll-input-text" required placeholder="+1 (555) 000-0000" />
                    </div>

                    <div class="form-field-item">
                        <label><?php esc_html_e('Zip Code', 'driveria'); ?></label>
                        <input type="text" name="student_zip" class="enroll-input-text" placeholder="Zip / Postal Code" />
                    </div>

                    <div class="form-field-item">
                        <label><?php esc_html_e('Your Age Group', 'driveria'); ?></label>
                        <div class="radio-options-row">
                            <label><input type="radio" name="student_age_group" value="Teen (Below 18)" checked /> Teen (&lt;18)</label>
                            <label><input type="radio" name="student_age_group" value="Adult (Above 18)" /> Adult (18+)</label>
                        </div>
                    </div>

                    <div class="form-field-item">
                        <label><?php esc_html_e('Valid Learner\'s Permit?', 'driveria'); ?></label>
                        <div class="radio-options-row">
                            <label><input type="radio" name="has_permit" value="Yes" checked /> Yes</label>
                            <label><input type="radio" name="has_permit" value="No" /> No</label>
                        </div>
                    </div>

                    <div class="form-field-item">
                        <label><?php esc_html_e('Comments / Notes', 'driveria'); ?></label>
                        <textarea name="notes" rows="2" class="enroll-textarea-v2" placeholder="Preferred lesson times or pickup address..."></textarea>
                    </div>

                    <div id="sidebarEnrollResponseMsg" class="form-response-msg" style="margin-bottom: 15px;"></div>

                    <button type="submit" class="btn-enroll-submit w-100" style="width: 100%;">
                        <span><?php esc_html_e('ENROLL & PAY NOW', 'driveria'); ?></span>
                        <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
                    </button>
                </form>

                <div class="sidebar-summary-footer">
                    <div class="sum-row"><span>Course Price:</span> <strong><?php echo esc_html($price); ?></strong></div>
                    <div class="sum-row"><span>Duration:</span> <strong><?php echo esc_html($duration); ?></strong></div>
                    <div class="sum-row"><span>Total Lessons:</span> <strong><?php echo esc_html($lessons); ?></strong></div>
                    <div class="sum-row"><span>Fleet Type:</span> <strong>Dual-Control Fleet</strong></div>
                </div>
            </div>
        </aside>

    </div>
</div>

<?php 
endwhile; endif;
get_footer();
