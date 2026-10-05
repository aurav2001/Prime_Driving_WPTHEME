<?php
/**
 * Template Name: Services Page
 * Description: Redesigned High-End Services & Enrollment Page Template for Driveria Theme
 *
 * @package Driveria
 */

get_header();

// Render automatic dynamic page header with breadcrumb navigation
driveria_render_page_header(
    __('Our Professional Driving Services', 'driveria'),
    __('Explore state-approved driving packages, behind-the-wheel training, and fast-track road test enrollment.', 'driveria')
);
?>

<!-- =========================================================================
     1. TOP SECTION (Breadcrumb Ke Baad: Short Description + Enroll Form)
     ========================================================================= -->
<section class="driveria-section driveria-service-hero-section">
    <div class="driveria-container">
        <div class="service-hero-grid">
            
            <!-- Left Column: Service Short Description & Key Highlights -->
            <div class="service-hero-info">
                <span class="service-badge-pill">
                    <i class="fa-solid fa-shield-halved"></i> <?php esc_html_e('DMV Accredited Driving Academy', 'driveria'); ?>
                </span>
                
                <h2 class="service-hero-title">
                    <?php esc_html_e('Master Behind-The-Wheel Driving With Certified Experts', 'driveria'); ?>
                </h2>

                <p class="service-hero-excerpt">
                    <?php esc_html_e('Whether you are a teen getting your first learner permit, an adult seeking a defensive refresher, or preparing for your DMV road test, our personalized 1-on-1 driving instruction guarantees safety, confidence, and first-time pass success.', 'driveria'); ?>
                </p>

                <!-- Quick Service Highlights Grid -->
                <div class="service-highlights-grid">
                    <div class="highlight-item">
                        <div class="hl-icon"><i class="fa-solid fa-car-side"></i></div>
                        <div>
                            <h4><?php esc_html_e('Dual-Control Cars', 'driveria'); ?></h4>
                            <p><?php esc_html_e('100% safety dual pedals & mirrors', 'driveria'); ?></p>
                        </div>
                    </div>

                    <div class="highlight-item">
                        <div class="hl-icon"><i class="fa-solid fa-house-user"></i></div>
                        <div>
                            <h4><?php esc_html_e('Doorstep Pick & Drop', 'driveria'); ?></h4>
                            <p><?php esc_html_e('Free pickup from home or school', 'driveria'); ?></p>
                        </div>
                    </div>

                    <div class="highlight-item">
                        <div class="hl-icon"><i class="fa-solid fa-calendar-check"></i></div>
                        <div>
                            <h4><?php esc_html_e('Flexible Schedules', 'driveria'); ?></h4>
                            <p><?php esc_html_e('Morning, evening & weekend slots', 'driveria'); ?></p>
                        </div>
                    </div>

                    <div class="highlight-item">
                        <div class="hl-icon"><i class="fa-solid fa-award"></i></div>
                        <div>
                            <h4><?php esc_html_e('99% DMV Pass Rate', 'driveria'); ?></h4>
                            <p><?php esc_html_e('Proven exam route practice', 'driveria'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Trust Stats Strip -->
                <div class="service-trust-strip">
                    <div class="trust-pill">
                        <i class="fa-solid fa-star text-yellow"></i>
                        <span><strong>4.9/5</strong> (1,250+ Reviews)</span>
                    </div>
                    <div class="trust-pill">
                        <i class="fa-solid fa-circle-check text-green"></i>
                        <span><strong>15,000+</strong> Licensed Graduates</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Service Enrollment Form -->
            <div class="service-enroll-form-wrapper">
                <div class="service-enroll-card">
                    <div class="enroll-card-header">
                        <div class="card-tag"><?php esc_html_e('Instant Registration', 'driveria'); ?></div>
                        <h3><i class="fa-solid fa-file-pen"></i> <?php esc_html_e('Service Enrollment Form', 'driveria'); ?></h3>
                        <p><?php esc_html_e('Fill out your details to lock in your preferred driving schedule.', 'driveria'); ?></p>
                    </div>

                    <form id="driveriaServicePageEnrollForm" class="driveria-ajax-form" method="post">
                        <input type="hidden" name="form_source" value="Service Page Enrollment Form" />
                        
                        <div class="form-group-v2">
                            <label for="srv_student_name"><?php esc_html_e('Full Name *', 'driveria'); ?></label>
                            <div class="form-input-wrap">
                                <input type="text" id="srv_student_name" name="student_name" class="form-control-v2" required placeholder="<?php esc_attr_e('e.g. Alex Morgan', 'driveria'); ?>">
                                <i class="fa-regular fa-user"></i>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group-v2">
                                <label for="srv_student_email"><?php esc_html_e('Email Address *', 'driveria'); ?></label>
                                <div class="form-input-wrap">
                                    <input type="email" id="srv_student_email" name="student_email" class="form-control-v2" required placeholder="<?php esc_attr_e('alex@example.com', 'driveria'); ?>">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                            </div>

                            <div class="form-group-v2">
                                <label for="srv_student_phone"><?php esc_html_e('Phone Number *', 'driveria'); ?></label>
                                <div class="form-input-wrap">
                                    <input type="tel" id="srv_student_phone" name="student_phone" class="form-control-v2" required placeholder="<?php esc_attr_e('+1 (555) 000-0000', 'driveria'); ?>">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group-v2">
                            <label for="srv_package"><?php esc_html_e('Select Service / Package *', 'driveria'); ?></label>
                            <div class="form-input-wrap">
                                <select id="srv_package" name="course_name" class="form-control-v2" required>
                                    <option value=""><?php esc_html_e('-- Choose a Driving Service --', 'driveria'); ?></option>
                                    <option value="Teen Behind-The-Wheel Driving Course"><?php esc_html_e('Teen Behind-The-Wheel Course (DMV Approved)', 'driveria'); ?></option>
                                    <option value="Adult Driver Defensive & Refresher Course"><?php esc_html_e('Adult Defensive & Refresher Course', 'driveria'); ?></option>
                                    <option value="DMV Road Test Preparation & Car Rental"><?php esc_html_e('DMV Road Test Preparation & Exam Car Rental', 'driveria'); ?></option>
                                    <option value="Highway & Parallel Parking Masterclass"><?php esc_html_e('Highway & Parallel Parking Masterclass', 'driveria'); ?></option>
                                    <option value="Express License Fast-Track Package"><?php esc_html_e('Express License Fast-Track Package', 'driveria'); ?></option>
                                </select>
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group-v2">
                                <label for="srv_start_date"><?php esc_html_e('Preferred Start Date', 'driveria'); ?></label>
                                <div class="form-input-wrap">
                                    <input type="date" id="srv_start_date" name="preferred_date" class="form-control-v2">
                                    <i class="fa-regular fa-calendar"></i>
                                </div>
                            </div>

                            <div class="form-group-v2">
                                <label for="srv_time_slot"><?php esc_html_e('Preferred Time Slot', 'driveria'); ?></label>
                                <div class="form-input-wrap">
                                    <select id="srv_time_slot" name="preferred_time" class="form-control-v2">
                                        <option value="Morning (8:00 AM - 12:00 PM)"><?php esc_html_e('Morning (8 AM - 12 PM)', 'driveria'); ?></option>
                                        <option value="Afternoon (12:00 PM - 4:00 PM)"><?php esc_html_e('Afternoon (12 PM - 4 PM)', 'driveria'); ?></option>
                                        <option value="Evening (4:00 PM - 8:00 PM)"><?php esc_html_e('Evening (4 PM - 8 PM)', 'driveria'); ?></option>
                                    </select>
                                    <i class="fa-regular fa-clock"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group-v2">
                            <label for="srv_pickup"><?php esc_html_e('Pickup Address / City', 'driveria'); ?></label>
                            <div class="form-input-wrap">
                                <input type="text" id="srv_pickup" name="pickup_address" class="form-control-v2" placeholder="<?php esc_attr_e('Enter home or school address', 'driveria'); ?>">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn-service-submit">
                            <span><?php esc_html_e('ENROLL NOW & SUBMIT REQUEST', 'driveria'); ?></span>
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                        
                        <div class="form-response-msg"></div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================================
     2. LOWER SECTION (Enroll Form Ke Niche: Left Side Image + Right Side Detailed Description)
     ========================================================================= -->
<section class="driveria-section service-details-section">
    <div class="driveria-container">
        <div class="service-details-grid">
            
            <!-- Left Side: Image with Badge Overlay & Modern Frame -->
            <div class="service-img-col">
                <div class="service-image-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', array('class' => 'service-featured-img', 'alt' => get_the_title())); ?>
                    <?php else : ?>
                        <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e('Prime Driving School Service Instruction', 'driveria'); ?>" class="service-featured-img" />
                    <?php endif; ?>
                    
                    <div class="img-badge-overlay experience-badge-pill">
                        <span class="badge-number">15+</span>
                        <span class="badge-label"><?php esc_html_e('Years Safety Leadership', 'driveria'); ?></span>
                    </div>

                    <div class="img-badge-overlay vehicle-status-pill">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span><?php esc_html_e('Dual-Control DMV Approved Fleet', 'driveria'); ?></span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Detailed Description & Service Highlights -->
            <div class="service-content-col">
                <span class="section-subtitle"><i class="fa-solid fa-list-check"></i> <?php esc_html_e('Detailed Service Information', 'driveria'); ?></span>
                <h2 class="section-title"><?php esc_html_e('Why Our Driving Lessons Guarantee Your License Success', 'driveria'); ?></h2>
                
                <p class="service-detail-text">
                    <?php esc_html_e('At Prime Driving School, our service is structured around safety, confidence, and complete road preparedness. We do not just train you to pass the DMV test; we instil lifetime defensive driving habits, emergency collision avoidance skills, and smooth vehicle control.', 'driveria'); ?>
                </p>
                
                <p class="service-detail-text">
                    <?php esc_html_e('Every lesson is conducted in our modern, dual-pedal safety vehicles under the gentle guidance of state-certified, patient instructors. From parallel parking mastery to highway lane merging, we break down complex driving techniques into clear, manageable steps.', 'driveria'); ?>
                </p>

                <!-- Detailed Checklist Grid -->
                <div class="service-checklist-grid">
                    <div class="check-item">
                        <i class="fa-solid fa-circle-check text-yellow"></i>
                        <span><?php esc_html_e('Customized 1-on-1 In-Car Instruction', 'driveria'); ?></span>
                    </div>
                    <div class="check-item">
                        <i class="fa-solid fa-circle-check text-yellow"></i>
                        <span><?php esc_html_e('DMV Mock Test Simulation & Route Training', 'driveria'); ?></span>
                    </div>
                    <div class="check-item">
                        <i class="fa-solid fa-circle-check text-yellow"></i>
                        <span><?php esc_html_e('Parallel Parking & 3-Point Turn Precision', 'driveria'); ?></span>
                    </div>
                    <div class="check-item">
                        <i class="fa-solid fa-circle-check text-yellow"></i>
                        <span><?php esc_html_e('Dual-Brake System for Total Safety Assurance', 'driveria'); ?></span>
                    </div>
                    <div class="check-item">
                        <i class="fa-solid fa-circle-check text-yellow"></i>
                        <span><?php esc_html_e('Official DMV Waiver & Completion Certificate', 'driveria'); ?></span>
                    </div>
                    <div class="check-item">
                        <i class="fa-solid fa-circle-check text-yellow"></i>
                        <span><?php esc_html_e('Car Provided for Official Road Test Exam', 'driveria'); ?></span>
                    </div>
                </div>

                <!-- Action CTA Buttons -->
                <div class="service-actions-row">
                    <a href="tel:<?php echo esc_attr(get_theme_mod('driveria_phone', '+18005553748')); ?>" class="btn-action-primary">
                        <i class="fa-solid fa-phone-volume"></i>
                        <span><?php esc_html_e('Call Coordinator Now', 'driveria'); ?></span>
                    </a>
                    <a href="#driveriaServicePageEnrollForm" class="btn-action-secondary">
                        <i class="fa-solid fa-file-pen"></i>
                        <span><?php esc_html_e('Go To Enrollment Form', 'driveria'); ?></span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================================
     3. SERVICE PACKAGES GRID (Recommended Driving Packages)
     ========================================================================= -->
<section class="driveria-section service-packages-section">
    <div class="driveria-container">
        <div class="section-header-center">
            <span class="section-subtitle"><i class="fa-solid fa-tags"></i> <?php esc_html_e('Driving Packages', 'driveria'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Select Your Preferred Service Package', 'driveria'); ?></h2>
            <p class="section-subtitle-text"><?php esc_html_e('All packages include doorstep pick & drop, 1-on-1 instructor focus, and dual-control safety vehicles.', 'driveria'); ?></p>
        </div>

        <div class="service-packages-grid">
            
            <!-- Package Card 1 -->
            <div class="pkg-card">
                <div class="pkg-badge"><?php esc_html_e('Teen Special', 'driveria'); ?></div>
                <div class="pkg-header">
                    <div class="pkg-icon"><i class="fa-solid fa-user-graduate"></i></div>
                    <h3><?php esc_html_e('Teen Behind-The-Wheel Course', 'driveria'); ?></h3>
                    <div class="pkg-price">$299 <span>/ 14 Sessions</span></div>
                </div>
                <ul class="pkg-features">
                    <li><i class="fa-solid fa-check"></i> 7 Hours Driving + 7 Hours Observation</li>
                    <li><i class="fa-solid fa-check"></i> Official DMV Road Test Waiver</li>
                    <li><i class="fa-solid fa-check"></i> Doorstep Pickup & Drop-Off Included</li>
                    <li><i class="fa-solid fa-check"></i> Insurance Discount Certificate</li>
                </ul>
                <a href="#driveriaServicePageEnrollForm" onclick="selectServicePackage('Teen Behind-The-Wheel Driving Course')" class="btn-pkg-enroll">
                    <?php esc_html_e('Enroll in Package', 'driveria'); ?> <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>

            <!-- Package Card 2 (Featured) -->
            <div class="pkg-card featured">
                <div class="pkg-badge featured-badge"><?php esc_html_e('Best Value', 'driveria'); ?></div>
                <div class="pkg-header">
                    <div class="pkg-icon"><i class="fa-solid fa-id-card"></i></div>
                    <h3><?php esc_html_e('DMV Road Test Prep & Rental', 'driveria'); ?></h3>
                    <div class="pkg-price">$199 <span>/ Exam Day</span></div>
                </div>
                <ul class="pkg-features">
                    <li><i class="fa-solid fa-check"></i> 45-Minute Pre-Exam Warmup Lesson</li>
                    <li><i class="fa-solid fa-check"></i> Dual-Control Car for DMV Driving Test</li>
                    <li><i class="fa-solid fa-check"></i> Pickup & Escort to DMV Test Location</li>
                    <li><i class="fa-solid fa-check"></i> Exact Exam Route Practice Run</li>
                </ul>
                <a href="#driveriaServicePageEnrollForm" onclick="selectServicePackage('DMV Road Test Preparation & Car Rental')" class="btn-pkg-enroll featured-btn">
                    <?php esc_html_e('Enroll in Package', 'driveria'); ?> <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>

            <!-- Package Card 3 -->
            <div class="pkg-card">
                <div class="pkg-badge"><?php esc_html_e('Adult Special', 'driveria'); ?></div>
                <div class="pkg-header">
                    <div class="pkg-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <h3><?php esc_html_e('Adult Defensive & Brush-Up', 'driveria'); ?></h3>
                    <div class="pkg-price">$349 <span>/ 6 Hours</span></div>
                </div>
                <ul class="pkg-features">
                    <li><i class="fa-solid fa-check"></i> 1-on-1 Behind-The-Wheel Intensive</li>
                    <li><i class="fa-solid fa-check"></i> Highway & Night Driving Confidence</li>
                    <li><i class="fa-solid fa-check"></i> Parallel Parking & Reversing Drills</li>
                    <li><i class="fa-solid fa-check"></i> Flexible Weekend & Evening Slots</li>
                </ul>
                <a href="#driveriaServicePageEnrollForm" onclick="selectServicePackage('Adult Driver Defensive & Refresher Course')" class="btn-pkg-enroll">
                    <?php esc_html_e('Enroll in Package', 'driveria'); ?> <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- =========================================================================
     4. FAQ ACCORDION SECTION
     ========================================================================= -->
<section class="driveria-section service-faq-section" style="background: #FFFFFF;">
    <div class="driveria-container">
        <div class="section-header-center">
            <span class="section-subtitle"><i class="fa-solid fa-circle-question"></i> <?php esc_html_e('Got Questions?', 'driveria'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Frequently Asked Service Questions', 'driveria'); ?></h2>
        </div>

        <div class="service-faq-wrapper" style="max-width: 800px; margin: 0 auto;">
            <div class="faq-accordion-item">
                <div class="faq-question">
                    <h3><?php esc_html_e('Do I need a learner\'s permit before starting behind-the-wheel lessons?', 'driveria'); ?></h3>
                    <span class="faq-toggle-icon"><i class="fa-solid fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p><?php esc_html_e('Yes, for behind-the-wheel instruction on public roads, students must possess a valid state learner\'s permit. If you don\'t have one yet, we can guide you on passing the DMV knowledge test!', 'driveria'); ?></p>
                </div>
            </div>

            <div class="faq-accordion-item">
                <div class="faq-question">
                    <h3><?php esc_html_e('Is doorstep pickup and drop-off really free?', 'driveria'); ?></h3>
                    <span class="faq-toggle-icon"><i class="fa-solid fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p><?php esc_html_e('Yes! For all our behind-the-wheel training packages within our standard service area, our instructor picks you up directly from home, school, or work and returns you safely.', 'driveria'); ?></p>
                </div>
            </div>

            <div class="faq-accordion-item">
                <div class="faq-question">
                    <h3><?php esc_html_e('Can I use the school\'s car for my DMV road test?', 'driveria'); ?></h3>
                    <span class="faq-toggle-icon"><i class="fa-solid fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p><?php esc_html_e('Absolutely. Our DMV Road Test Package includes a warmup lesson right before your exam, pickup & escort to the test center, and full use of our dual-control inspection-ready vehicle for your test.', 'driveria'); ?></p>
                </div>
            </div>

            <div class="faq-accordion-item">
                <div class="faq-question">
                    <h3><?php esc_html_e('How soon after enrolling will my first lesson be scheduled?', 'driveria'); ?></h3>
                    <span class="faq-toggle-icon"><i class="fa-solid fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p><?php esc_html_e('Once you submit the enrollment form, our coordinator will reach out within 2 hours to confirm your preferred dates and match you with a certified instructor.', 'driveria'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function selectServicePackage(packageName) {
    var select = document.getElementById('srv_package');
    if (select) {
        select.value = packageName;
        var form = document.getElementById('driveriaServicePageEnrollForm');
        if (form) {
            form.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}
</script>

<?php
get_footer();
