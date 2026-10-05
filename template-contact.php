<?php
/**
 * Template Name: Contact Us Page
 * Description: Redesigned High-End Contact Page Template for Driveria Theme
 *
 * @package Driveria
 */

get_header();
?>

<?php
driveria_render_page_header(__('Contact Prime Driving School', 'driveria'), __('Have questions about driving lessons, instructor scheduling, or DMV test prep? We are here 7 days a week.', 'driveria'));
?>

<!-- 3-Column Interactive Contact Info Cards -->
<section class="driveria-section driveria-contact-cards">
    <div class="driveria-container">
        <div class="driveria-grid-3">
            <!-- Card 1 -->
            <div class="contact-card-v2">
                <div class="card-icon-badge">
                    <i class="fa-solid fa-phone-volume"></i>
                </div>
                <h3><?php esc_html_e('Phone & WhatsApp', 'driveria'); ?></h3>
                <p><?php echo esc_html(get_theme_mod('driveria_phone', '+1 (800) 555-3748')); ?></p>
                <span class="card-subtext"><?php esc_html_e('Mon - Sun: 7:00 AM - 9:00 PM', 'driveria'); ?></span>
                <div class="live-badge">
                    <span class="live-dot"></span>
                    <span><?php esc_html_e('Line Active Now', 'driveria'); ?></span>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="contact-card-v2">
                <div class="card-icon-badge">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <h3><?php esc_html_e('Email Inquiry', 'driveria'); ?></h3>
                <p><?php echo esc_html(get_theme_mod('driveria_email', 'info@driveria.com')); ?></p>
                <span class="card-subtext"><?php esc_html_e('24/7 Response within 2 hours', 'driveria'); ?></span>
                <div class="live-badge">
                    <span class="live-dot"></span>
                    <span><?php esc_html_e('Fast Reply Guaranteed', 'driveria'); ?></span>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="contact-card-v2">
                <div class="card-icon-badge">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <h3><?php esc_html_e('Academy Headquarters', 'driveria'); ?></h3>
                <p><?php echo esc_html(get_theme_mod('driveria_address', '123 Safety Drive, Metro City')); ?></p>
                <span class="card-subtext"><?php esc_html_e('Training Grounds & Practice Track', 'driveria'); ?></span>
                <div class="live-badge">
                    <span class="live-dot"></span>
                    <span><?php esc_html_e('Open for Drop-ins', 'driveria'); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Contact Form & Map Section -->
<section class="driveria-section driveria-contact-main" style="background: #F8FAFC; padding-top: 40px;">
    <div class="driveria-container">
        <div class="contact-main-grid">
            <!-- Left Side: Glassmorphic Form -->
            <div class="glass-form-card">
                <h2 class="form-title"><?php esc_html_e('Send Us a Booking Message', 'driveria'); ?></h2>
                <p class="form-subtitle"><?php esc_html_e('Fill out your details below and our scheduling coordinator will contact you shortly.', 'driveria'); ?></p>

                <form id="driveria-contact-page-form" class="driveria-ajax-form">
                    <input type="hidden" name="form_source" value="Contact Us Page Form" />
                    <div class="form-group-v2">
                        <label for="c_name"><?php esc_html_e('Full Name *', 'driveria'); ?></label>
                        <div class="form-input-wrap">
                            <input type="text" id="c_name" name="student_name" class="form-control-v2" required placeholder="<?php esc_attr_e('e.g. John Doe', 'driveria'); ?>">
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group-v2">
                            <label for="c_email"><?php esc_html_e('Email Address *', 'driveria'); ?></label>
                            <div class="form-input-wrap">
                                <input type="email" id="c_email" name="student_email" class="form-control-v2" required placeholder="<?php esc_attr_e('john@example.com', 'driveria'); ?>">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                        </div>

                        <div class="form-group-v2">
                            <label for="c_phone"><?php esc_html_e('Phone Number *', 'driveria'); ?></label>
                            <div class="form-input-wrap">
                                <input type="tel" id="c_phone" name="student_phone" class="form-control-v2" required placeholder="<?php esc_attr_e('+1 (555) 000-0000', 'driveria'); ?>">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group-v2">
                        <label for="c_address"><?php esc_html_e('Street / Pickup Address *', 'driveria'); ?></label>
                        <div class="form-input-wrap">
                            <input type="text" id="c_address" name="student_address" class="form-control-v2" required placeholder="<?php esc_attr_e('Street Address for Pickup / Location', 'driveria'); ?>">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                    </div>

                    <div class="form-group-v2">
                        <label for="c_course"><?php esc_html_e('Interested Course Program', 'driveria'); ?></label>
                        <div class="form-input-wrap">
                            <select id="c_course" name="course_selected" class="form-control-v2">
                                <option value=""><?php esc_html_e('-- Select Course Option --', 'driveria'); ?></option>
                                <?php echo driveria_render_course_options(); ?>
                            </select>
                            <i class="fa-solid fa-car"></i>
                        </div>
                    </div>

                    <div class="form-group-v2">
                        <label for="c_message"><?php esc_html_e('Your Message / Preferred Dates', 'driveria'); ?></label>
                        <div class="form-input-wrap">
                            <textarea id="c_message" name="notes" rows="4" class="form-control-v2" placeholder="<?php esc_attr_e('Tell us about your driving experience or preferred pickup address...', 'driveria'); ?>"></textarea>
                            <i class="fa-regular fa-comment-dots"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-shimmer-submit">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span><?php esc_html_e('Submit Booking Request', 'driveria'); ?></span>
                    </button>
                    
                    <div class="form-response-msg" style="margin-top: 15px;"></div>
                </form>
            </div>

            <!-- Right Side: Dark Map & Hotline Card -->
            <div class="map-card-v2">
                <div>
                    <div class="map-card-header">
                        <h3><i class="fa-solid fa-map-location-dot" style="color: #FFB800;"></i> <?php esc_html_e('Driving Academy & Practice Track', 'driveria'); ?></h3>
                        <p><?php esc_html_e('Our main facility features state-of-the-art dual-control simulators and private maneuver practice tracks.', 'driveria'); ?></p>
                    </div>

                    <div class="map-info-list">
                        <div class="map-info-item">
                            <i class="fa-solid fa-location-pin"></i>
                            <div>
                                <strong><?php esc_html_e('Main Address', 'driveria'); ?></strong>
                                <span><?php echo esc_html(get_theme_mod('driveria_address', '123 Safety Drive, Metro City')); ?></span>
                            </div>
                        </div>

                        <div class="map-info-item">
                            <i class="fa-regular fa-clock"></i>
                            <div>
                                <strong><?php esc_html_e('Academy Hours', 'driveria'); ?></strong>
                                <span><?php echo esc_html(get_theme_mod('driveria_hours', 'Mon - Sat: 8:00 AM - 6:00 PM')); ?></span>
                            </div>
                        </div>

                        <div class="map-info-item">
                            <i class="fa-solid fa-car-tunnel"></i>
                            <div>
                                <strong><?php esc_html_e('Pickup & Drop Off', 'driveria'); ?></strong>
                                <span><?php esc_html_e('Free Doorstep Home Pickup Available', 'driveria'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hotline-card-pill">
                    <div class="hotline-icon">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div class="hotline-text">
                        <h5><?php esc_html_e('Emergency Hotline', 'driveria'); ?></h5>
                        <a href="tel:<?php echo esc_attr(get_theme_mod('driveria_phone', '+15552345678')); ?>"><?php echo esc_html(get_theme_mod('driveria_phone', '+1 (555) 234-5678')); ?></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="contact-faq-section">
            <div class="section-title-wrap" style="margin-bottom: 30px;">
                <span class="section-subtitle"><i class="fa-solid fa-circle-question"></i> <?php esc_html_e('Got Questions?', 'driveria'); ?></span>
                <h2 class="section-title"><?php esc_html_e('Frequently Asked Questions', 'driveria'); ?></h2>
            </div>

            <div class="faq-accordion-item">
                <button class="faq-question">
                    <span>How do I schedule my first driving lesson?</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    Simply fill out the booking form above or give us a call. Our scheduling coordinator will confirm your preferred dates, assign a certified instructor, and arrange free doorstep pickup.
                </div>
            </div>

            <div class="faq-accordion-item">
                <button class="faq-question">
                    <span>Do you provide vehicles for the DMV road test?</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    Yes! All our packages include dual-controlled, DMV-approved vehicles equipped with cameras and dual brakes for your official driving test.
                </div>
            </div>

            <div class="faq-accordion-item">
                <button class="faq-question">
                    <span>What happens if I need to cancel or reschedule a lesson?</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    We offer free cancellations and rescheduling with 24 hours advance notice. You can reschedule online or via phone.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Elementor & Page Content Area Support -->
<?php
if (have_posts()) :
    while (have_posts()) : the_post();
        the_content();
    endwhile;
endif;
?>

<?php
get_footer();
