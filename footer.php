<?php
/**
 * Driveria Theme Footer Template
 *
 * @package Driveria
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

    <!-- Site Footer -->
    <footer class="driveria-footer">
        <div class="footer-top-wave">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,32L60,42.7C120,53,240,75,360,80C480,85,600,75,720,58.7C840,43,960,21,1080,16C1200,11,1320,21,1380,26.7L1440,32L1440,120L1380,120C1320,120,1200,120,1080,120C960,120,840,120,720,120C600,120,480,120,360,120C240,120,120,120,60,120L0,120Z" fill="#0A0F1D"></path>
            </svg>
        </div>

        <div class="driveria-container footer-widgets">
            <div class="footer-grid">
                <!-- Col 1: About -->
                <div class="footer-col footer-col-about">
                    <div class="footer-brand">
                        <span class="footer-logo-icon">🚗</span>
                        <span class="footer-brand-title"><?php bloginfo('name'); ?></span>
                    </div>
                    <p class="footer-about-desc">
                        <?php echo esc_html(get_theme_mod('driveria_footer_desc', get_theme_mod('driveria_footer_text', 'Driveria is a premier accredited driving academy committed to creating safe, confident, and skilled drivers for life.'))); ?>
                    </p>
                    <div class="footer-social-icons">
                        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div class="footer-col">
                    <h4 class="footer-col-title"><?php echo esc_html(get_theme_mod('driveria_footer_quick_title', __('Quick Links', 'driveria'))); ?></h4>
                    <?php
                    if (has_nav_menu('footer_quick')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer_quick',
                            'container'      => false,
                            'menu_class'     => 'footer-links',
                            'fallback_cb'    => false,
                        ));
                    } else {
                        ?>
                        <ul class="footer-links">
                            <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-angle-right"></i> <?php esc_html_e('Home', 'driveria'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/#courses')); ?>"><i class="fa-solid fa-angle-right"></i> <?php esc_html_e('Our Driving Courses', 'driveria'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/#why-us')); ?>"><i class="fa-solid fa-angle-right"></i> <?php esc_html_e('Why Prime Driving School', 'driveria'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/#instructors')); ?>"><i class="fa-solid fa-angle-right"></i> <?php esc_html_e('Our Instructors', 'driveria'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/#pricing')); ?>"><i class="fa-solid fa-angle-right"></i> <?php esc_html_e('Pricing & Plans', 'driveria'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/#booking')); ?>"><i class="fa-solid fa-angle-right"></i> <?php esc_html_e('Book a Lesson', 'driveria'); ?></a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>

                <!-- Col 3: Driving Programs -->
                <div class="footer-col">
                    <h4 class="footer-col-title"><?php echo esc_html(get_theme_mod('driveria_footer_prog_title', __('Driving Programs', 'driveria'))); ?></h4>
                    <?php
                    if (has_nav_menu('footer_programs')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer_programs',
                            'container'      => false,
                            'menu_class'     => 'footer-links',
                            'fallback_cb'    => false,
                        ));
                    } else {
                        ?>
                        <ul class="footer-links">
                            <li><a href="<?php echo esc_url(home_url('/#courses')); ?>"><i class="fa-solid fa-angle-right"></i> <?php esc_html_e('Teen Licensing Course', 'driveria'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/#courses')); ?>"><i class="fa-solid fa-angle-right"></i> <?php esc_html_e('Adult Highway Training', 'driveria'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/#courses')); ?>"><i class="fa-solid fa-angle-right"></i> <?php esc_html_e('DMV Road Test Prep', 'driveria'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/#courses')); ?>"><i class="fa-solid fa-angle-right"></i> <?php esc_html_e('Defensive Driving', 'driveria'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/#courses')); ?>"><i class="fa-solid fa-angle-right"></i> <?php esc_html_e('Manual Transmission', 'driveria'); ?></a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>

                <!-- Col 4: Contact & Location -->
                <div class="footer-col">
                    <h4 class="footer-col-title"><?php esc_html_e('Contact Academy', 'driveria'); ?></h4>
                    <div class="footer-contact-info">
                        <div class="footer-info-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <span><?php echo esc_html(get_theme_mod('driveria_address', '123 Safety Drive, Metro City')); ?></span>
                        </div>
                        <div class="footer-info-item">
                            <i class="fa-solid fa-phone"></i>
                            <span><?php echo esc_html(get_theme_mod('driveria_phone', '+1 (555) 234-5678')); ?></span>
                        </div>
                        <div class="footer-info-item">
                            <i class="fa-solid fa-envelope"></i>
                            <span><?php echo esc_html(get_theme_mod('driveria_email', 'info@driveria-school.com')); ?></span>
                        </div>
                        <div class="footer-info-item">
                            <i class="fa-regular fa-clock"></i>
                            <span><?php echo esc_html(get_theme_mod('driveria_hours', 'Mon - Sat: 8:00 AM - 6:00 PM')); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom Bar -->
            <div class="footer-bottom">
                <div class="copyright-text">
                    <?php echo esc_html(get_theme_mod('driveria_copyright', '© ' . date('Y') . ' Driveria Driving School. All Rights Reserved.')); ?>
                </div>
                <div class="footer-bottom-links">
                    <a href="#"><?php esc_html_e('Privacy Policy', 'driveria'); ?></a>
                    <span class="sep">•</span>
                    <a href="#"><?php esc_html_e('Terms of Service', 'driveria'); ?></a>
                    <span class="sep">•</span>
                    <a href="#"><?php esc_html_e('DMV Compliance', 'driveria'); ?></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Universal Enroll Registration Modal Popup -->
    <div id="driveriaEnrollModal" class="driveria-modal-overlay">
        <div class="driveria-modal-box">
            <button type="button" class="modal-close-btn" id="closeEnrollModalBtn">&times;</button>
            <div class="enroll-section-header" style="margin-bottom: 25px;">
                <span class="enroll-subtitle-accent"><?php esc_html_e('Online Registration Available', 'driveria'); ?></span>
                <h3 class="enroll-main-heading" style="font-size: 1.75rem;"><?php esc_html_e('ENROLL IN DMV-APPROVED TRAINING', 'driveria'); ?></h3>
            </div>
            
            <form id="driveriaModalEnrollForm" class="driveria-ajax-form">
                <input type="hidden" name="form_source" value="Modal Enroll Popup Form" />
                <div class="enroll-form-row" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));">
                    <div class="enroll-field-group">
                        <label class="field-label"><?php esc_html_e('Full Name *', 'driveria'); ?></label>
                        <input type="text" name="student_name" class="enroll-input-text" required placeholder="e.g. John Doe" />
                    </div>
                    <div class="enroll-field-group">
                        <label class="field-label"><?php esc_html_e('Email Address *', 'driveria'); ?></label>
                        <input type="email" name="student_email" class="enroll-input-text" required placeholder="john@example.com" />
                    </div>
                    <div class="enroll-field-group">
                        <label class="field-label"><?php esc_html_e('Phone Number *', 'driveria'); ?></label>
                        <input type="tel" name="student_phone" class="enroll-input-text" required placeholder="+1 (555) 000-0000" />
                    </div>
                    <div class="enroll-field-group">
                        <label class="field-label"><?php esc_html_e('Zip Code', 'driveria'); ?></label>
                        <input type="text" name="student_zip" class="enroll-input-text" placeholder="Zip / Postal Code" />
                    </div>
                    <div class="enroll-field-group" style="grid-column: span 2;">
                        <label class="field-label"><?php esc_html_e('Street / Pickup Address *', 'driveria'); ?></label>
                        <input type="text" name="student_address" class="enroll-input-text" required placeholder="Street Address for Pickup / Location" />
                    </div>
                </div>

                <div class="enroll-form-row">
                    <div class="enroll-field-group">
                        <label class="field-label"><?php esc_html_e('Your Age', 'driveria'); ?></label>
                        <div class="radio-group-wrap">
                            <label class="radio-option-label"><input type="radio" name="student_age_group" value="Teen (Below 18)" checked /> <span>Teen</span></label>
                            <label class="radio-option-label"><input type="radio" name="student_age_group" value="Adult (Above 18)" /> <span>Adult</span></label>
                        </div>
                    </div>
                    <div class="enroll-field-group">
                        <label class="field-label"><?php esc_html_e('Gender', 'driveria'); ?></label>
                        <div class="radio-group-wrap">
                            <label class="radio-option-label"><input type="radio" name="student_gender" value="Male" checked /> <span>Male</span></label>
                            <label class="radio-option-label"><input type="radio" name="student_gender" value="Female" /> <span>Female</span></label>
                        </div>
                    </div>
                    <div class="enroll-field-group">
                        <label class="field-label"><?php esc_html_e('Valid Permit?', 'driveria'); ?></label>
                        <div class="radio-group-wrap">
                            <label class="radio-option-label"><input type="radio" name="has_permit" value="Yes" checked /> <span>Yes</span></label>
                            <label class="radio-option-label"><input type="radio" name="has_permit" value="No" /> <span>No</span></label>
                        </div>
                    </div>
                </div>

                <div class="enroll-field-group" style="margin-bottom: 20px;">
                    <label class="field-label"><?php esc_html_e('Registering Course / Package *', 'driveria'); ?></label>
                    <select id="modal_course_select" name="course_selected" class="enroll-select-v2" required>
                        <option value=""><?php esc_html_e('-- Select Course Option --', 'driveria'); ?></option>
                        <?php echo driveria_render_course_options(); ?>
                    </select>
                </div>

                <div class="enroll-field-group" style="margin-bottom: 20px;">
                    <label class="field-label"><?php esc_html_e('Comments / Questions?', 'driveria'); ?></label>
                    <textarea name="notes" rows="2" class="enroll-textarea-v2" placeholder="Tell us about your driving experience or pickup location..."></textarea>
                </div>

                <div id="modalEnrollResponseMsg" class="form-response-msg" style="margin-bottom: 15px;"></div>

                <button type="submit" class="btn-enroll-submit" style="width: 100%;">
                    <span><?php esc_html_e('PROCEED TO PAYMENT', 'driveria'); ?></span>
                    <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Dedicated Get Appointment Modal Popup -->
    <div id="driveriaAppointmentModal" class="driveria-modal-overlay">
        <div class="driveria-modal-box appointment-modal-box">
            <button type="button" class="modal-close-btn" id="closeAppointmentModalBtn" aria-label="Close Modal">
                <i class="fa-solid fa-xmark"></i>
            </button>
            
            <div class="appointment-modal-header">
                <div class="badge-appointment-tag">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span><?php esc_html_e('Quick Online Booking', 'driveria'); ?></span>
                </div>
                <h3 class="appointment-modal-title"><?php esc_html_e('GET AN', 'driveria'); ?> <span><?php esc_html_e('APPOINTMENT', 'driveria'); ?></span></h3>
                <p class="appointment-modal-desc"><?php esc_html_e('Schedule your driving lesson or DMV test date with our certified instructors.', 'driveria'); ?></p>
            </div>
            
            <form id="driveriaAppointmentForm" class="driveria-ajax-form">
                <input type="hidden" name="form_source" value="Header Appointment Menu Icon" />
                
                <div class="enroll-form-row">
                    <div class="enroll-field-group">
                        <label class="field-label"><i class="fa-solid fa-user label-icon"></i> <?php esc_html_e('Full Name *', 'driveria'); ?></label>
                        <div class="app-input-wrapper">
                            <i class="fa-solid fa-user input-field-icon"></i>
                            <input type="text" name="student_name" class="enroll-input-text app-has-icon" required placeholder="e.g. John Smith" />
                        </div>
                    </div>
                    <div class="enroll-field-group">
                        <label class="field-label"><i class="fa-solid fa-phone label-icon"></i> <?php esc_html_e('Phone Number *', 'driveria'); ?></label>
                        <div class="app-input-wrapper">
                            <i class="fa-solid fa-phone input-field-icon"></i>
                            <input type="tel" name="student_phone" class="enroll-input-text app-has-icon" required placeholder="+1 (555) 000-0000" />
                        </div>
                    </div>
                </div>

                <div class="enroll-form-row">
                    <div class="enroll-field-group">
                        <label class="field-label"><i class="fa-solid fa-envelope label-icon"></i> <?php esc_html_e('Email Address *', 'driveria'); ?></label>
                        <div class="app-input-wrapper">
                            <i class="fa-solid fa-envelope input-field-icon"></i>
                            <input type="email" name="student_email" class="enroll-input-text app-has-icon" required placeholder="john@example.com" />
                        </div>
                    </div>
                    <div class="enroll-field-group">
                        <label class="field-label"><i class="fa-solid fa-location-dot label-icon"></i> <?php esc_html_e('Zip / Postal Code', 'driveria'); ?></label>
                        <div class="app-input-wrapper">
                            <i class="fa-solid fa-location-dot input-field-icon"></i>
                            <input type="text" name="student_zip" class="enroll-input-text app-has-icon" placeholder="e.g. 90210" />
                        </div>
                    </div>
                </div>

                <div class="enroll-field-group" style="margin-bottom: 18px;">
                    <label class="field-label"><i class="fa-solid fa-car label-icon"></i> <?php esc_html_e('Select Course / Program *', 'driveria'); ?></label>
                    <div class="app-input-wrapper">
                        <i class="fa-solid fa-graduation-cap input-field-icon"></i>
                        <select id="appointment_course_select" name="course_selected" class="enroll-select-v2 app-has-icon" required>
                            <option value=""><?php esc_html_e('-- Choose Course / Program --', 'driveria'); ?></option>
                            <?php echo driveria_render_course_options(); ?>
                        </select>
                    </div>
                </div>

                <div class="enroll-form-row">
                    <div class="enroll-field-group">
                        <label class="field-label"><i class="fa-regular fa-calendar-days label-icon"></i> <?php esc_html_e('Preferred Date *', 'driveria'); ?></label>
                        <div class="app-input-wrapper">
                            <i class="fa-solid fa-calendar-day input-field-icon"></i>
                            <input type="date" name="preferred_date" class="enroll-input-text app-has-icon" required min="<?php echo date('Y-m-d'); ?>" />
                        </div>
                    </div>
                    <div class="enroll-field-group">
                        <label class="field-label"><i class="fa-regular fa-clock label-icon"></i> <?php esc_html_e('Preferred Time Slot', 'driveria'); ?></label>
                        <div class="app-input-wrapper">
                            <i class="fa-solid fa-clock input-field-icon"></i>
                            <select name="preferred_time" class="enroll-select-v2 app-has-icon">
                                <option value="Morning (8:00 AM - 12:00 PM)"><?php esc_html_e('Morning (8:00 AM - 12:00 PM)', 'driveria'); ?></option>
                                <option value="Afternoon (12:00 PM - 4:00 PM)"><?php esc_html_e('Afternoon (12:00 PM - 4:00 PM)', 'driveria'); ?></option>
                                <option value="Evening (4:00 PM - 8:00 PM)"><?php esc_html_e('Evening (4:00 PM - 8:00 PM)', 'driveria'); ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="enroll-form-row">
                    <div class="enroll-field-group">
                        <label class="field-label"><i class="fa-solid fa-id-card label-icon"></i> <?php esc_html_e('Valid Learner\'s Permit?', 'driveria'); ?></label>
                        <div class="custom-pill-radios">
                            <label class="pill-radio-option">
                                <input type="radio" name="has_permit" value="Yes" checked />
                                <span class="pill-badge"><i class="fa-solid fa-circle-check"></i> Yes</span>
                            </label>
                            <label class="pill-radio-option">
                                <input type="radio" name="has_permit" value="No" />
                                <span class="pill-badge"><i class="fa-solid fa-circle-xmark"></i> No</span>
                            </label>
                        </div>
                    </div>
                    <div class="enroll-field-group">
                        <label class="field-label"><i class="fa-solid fa-users label-icon"></i> <?php esc_html_e('Age Group', 'driveria'); ?></label>
                        <div class="custom-pill-radios">
                            <label class="pill-radio-option">
                                <input type="radio" name="student_age_group" value="Teen (Below 18)" checked />
                                <span class="pill-badge"><i class="fa-solid fa-graduation-cap"></i> Teen</span>
                            </label>
                            <label class="pill-radio-option">
                                <input type="radio" name="student_age_group" value="Adult (Above 18)" />
                                <span class="pill-badge"><i class="fa-solid fa-user-shield"></i> Adult</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="enroll-field-group" style="margin-bottom: 20px;">
                    <label class="field-label"><i class="fa-solid fa-comment-dots label-icon"></i> <?php esc_html_e('Additional Notes / Pickup Address', 'driveria'); ?></label>
                    <div class="app-input-wrapper">
                        <i class="fa-solid fa-pen-to-square input-field-icon" style="top: 18px;"></i>
                        <textarea name="notes" rows="2" class="enroll-textarea-v2 app-has-icon" placeholder="Let us know your availability or any specific questions..."></textarea>
                    </div>
                </div>

                <div id="appointmentFormResponseMsg" class="form-response-msg" style="margin-bottom: 15px;"></div>

                <button type="submit" class="btn-enroll-submit btn-submit-appointment shimmer-btn" style="width: 100%;">
                    <span><?php esc_html_e('BOOK APPOINTMENT NOW', 'driveria'); ?></span>
                    <i class="fa-solid fa-arrow-right-long" style="margin-left: 8px;"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Back to top button -->
    <button id="backToTop" class="back-to-top-btn" aria-label="Back to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- =========================================================================
         100% SECURE 3-OPTION PAYMENT SELECTION MODAL
         ========================================================================= -->
    <div class="driveria-payment-modal-overlay" id="driveriaPaymentModal" style="display: none;">
        <div class="driveria-payment-modal-container">
            <button type="button" class="payment-modal-close" id="paymentModalCloseBtn" aria-label="Close Modal">&times;</button>

            <div class="payment-modal-content">
                <input type="hidden" id="driveriaActiveBookingId" value="" />
                <input type="hidden" id="driveriaCheckoutFallbackUrl" value="<?php echo esc_url(get_theme_mod('driveria_payment_redirect_url', home_url('/checkout/'))); ?>" />
                <input type="hidden" id="driveriaActiveRedirectUrl" value="" />
                
                <div class="payment-modal-grid" id="paymentModalGrid">
                    <!-- Option 1: Pay By Credit Card -->
                    <div class="payment-option-card">
                        <div class="payment-card-icon card-credit-card">
                            <i class="fa-solid fa-credit-card"></i>
                        </div>
                        <h3 class="payment-card-title"><?php esc_html_e('Pay By Credit Card', 'driveria'); ?></h3>
                        <p class="payment-card-desc">
                            <?php echo esc_html(get_theme_mod('driveria_credit_card_desc', __('Enjoy the convenience of credit card payments for your course purchase, with a 5% processing fee applied. Thank you for choosing us for your learning journey!', 'driveria'))); ?>
                        </p>
                        <div class="payment-card-footer">
                            <button type="button" class="btn-payment-submit btn-pay-credit-card" id="btnPayCreditCard">
                                <span><?php esc_html_e('Pay Now', 'driveria'); ?></span>
                            </button>
                        </div>
                    </div>

                    <!-- Option 2: Pay By Venmo -->
                    <div class="payment-option-card">
                        <div class="payment-card-icon card-venmo">
                            <div class="venmo-badge-icon"><i class="fa-brands fa-vimeo-v"></i></div>
                            <div class="venmo-brand-text">venmo</div>
                        </div>
                        <div class="payment-company-info">
                            <strong><?php echo esc_html(get_theme_mod('driveria_venmo_handle', 'Prime Driving SCHOOL')); ?></strong>
                            <span><?php echo esc_html(get_theme_mod('driveria_venmo_number', '5715013404')); ?></span>
                        </div>
                        <h3 class="payment-card-title"><?php esc_html_e('Pay By Venmo', 'driveria'); ?></h3>
                        <p class="payment-card-desc">
                            <?php echo esc_html(get_theme_mod('driveria_venmo_desc', __('For seamless and quick transactions, kindly make your payment via Venmo. We appreciate your cooperation and look forward to assisting you further. Thank you!', 'driveria'))); ?>
                        </p>
                        <div class="payment-card-footer">
                            <button type="button" class="btn-payment-submit btn-pay-venmo" id="btnPayVenmo">
                                <span><?php esc_html_e('Pay Now', 'driveria'); ?></span>
                            </button>
                        </div>
                    </div>

                    <!-- Option 3: Pay By Zelle -->
                    <div class="payment-option-card">
                        <div class="payment-card-icon card-zelle">
                            <div class="zelle-brand-text">żelle</div>
                        </div>
                        <div class="payment-company-info">
                            <strong><?php echo esc_html(get_theme_mod('driveria_zelle_handle', 'Prime Driving SCHOOL')); ?></strong>
                            <span><?php echo esc_html(get_theme_mod('driveria_zelle_number', '5715013404')); ?></span>
                        </div>
                        <h3 class="payment-card-title"><?php esc_html_e('Pay By Zelle', 'driveria'); ?></h3>
                        <p class="payment-card-desc">
                            <?php echo esc_html(get_theme_mod('driveria_zelle_desc', __('For smooth transactions, please use Zelle for your payment. Thank you for your cooperation.', 'driveria'))); ?>
                        </p>
                        <div class="payment-card-footer">
                            <button type="button" class="btn-payment-submit btn-pay-zelle" id="btnPayZelle">
                                <span><?php esc_html_e('Pay By Zelle', 'driveria'); ?></span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Payment Success Notice Box (Reveals when Venmo / Zelle / Credit Card clicked) -->
                <div id="paymentSuccessNoticeBox" class="payment-success-notice-box" style="display: none;">
                    <div class="notice-icon"><i class="fa-solid fa-circle-check"></i></div>
                    <h3 id="noticeTitle"><?php esc_html_e('Registration & Payment Saved!', 'driveria'); ?></h3>
                    <p id="noticeMsg"><?php esc_html_e('A receipt with payment instructions has been sent to your Gmail inbox.', 'driveria'); ?></p>
                    <div id="noticeDetails" class="notice-details-card"></div>
                    <button type="button" class="btn-close-notice" id="btnCloseNoticeBtn"><?php esc_html_e('Close & Return To Site', 'driveria'); ?></button>
                </div>
            </div>
        </div>
    </div>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
