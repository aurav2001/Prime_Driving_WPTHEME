<?php
/**
 * Template Name: About Us Page
 * Description: Redesigned High-End About Us Page Template for Prime Driving School
 *
 * @package Driveria
 */

get_header();

driveria_render_page_header(
    __('About Prime Driving School', 'driveria'),
    __('Virginia\'s Premier DMV Accredited Driving Academy – Empowering Safe, Confident & Certified Drivers.', 'driveria')
);
?>

<!-- Stats Counter Bar Section -->
<section class="driveria-section about-stats-section">
    <div class="driveria-container">
        <div class="about-stats-grid">
            <div class="stat-card-v2">
                <div class="stat-icon-wrap"><i class="fa-solid fa-award"></i></div>
                <div class="stat-number">5+</div>
                <div class="stat-label"><?php esc_html_e('Years DMV Experience', 'Prime Driving School'); ?></div>
            </div>
            <div class="stat-card-v2">
                <div class="stat-icon-wrap"><i class="fa-solid fa-user-graduate"></i></div>
                <div class="stat-number">99%</div>
                <div class="stat-label"><?php esc_html_e('DMV First-Time Pass Rate', 'driveria'); ?></div>
            </div>
            <div class="stat-card-v2">
                <div class="stat-icon-wrap"><i class="fa-solid fa-users"></i></div>
                <div class="stat-number">2,500+</div>
                <div class="stat-label"><?php esc_html_e('Licensed Graduates', 'driveria'); ?></div>
            </div>
            <div class="stat-card-v2">
                <div class="stat-icon-wrap"><i class="fa-solid fa-car-side"></i></div>
                <div class="stat-number">100%</div>
                <div class="stat-label"><?php esc_html_e('Dual-Control Safety Fleet', 'driveria'); ?></div>
            </div>
        </div>
    </div>
</section>

<!-- Main Mission & Story Section -->
<section class="driveria-section about-story-section">
    <div class="driveria-container">
        <div class="why-us-grid">
            <div class="why-us-image-wrap">
                <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&w=800&q=80" alt="Prime Driving School Certified Instruction" class="why-us-img" />
                <div class="experience-badge">
                    <span class="exp-num">#1</span>
                    <span class="exp-text"><?php esc_html_e('Rated DMV Academy', 'driveria'); ?></span>
                </div>
            </div>

            <div class="why-us-content">
                <span class="section-subtitle"><i class="fa-solid fa-shield-halved"></i> <?php esc_html_e('About Prime Driving School', 'driveria'); ?></span>
                <h2 class="section-title"><?php esc_html_e('We Build Confident Drivers for Life, Not Just for the Test', 'driveria'); ?></h2>
                <p class="section-desc">
                    <?php esc_html_e('Prime Driving School is a state-accredited driving academy dedicated to creating safe, knowledgeable, and confident drivers. Whether you are a teenager preparing for your behind-the-wheel licensing, an adult beginner, or preparing for your official DMV road test, our patient, certified instructors deliver top-tier instruction tailored to your unique learning style.', 'driveria'); ?>
                </p>

                <div class="why-us-checklist">
                    <li>
                        <div class="chk-icon"><i class="fa-solid fa-certificate"></i></div>
                        <div>
                            <strong><?php esc_html_e('State DMV Authorized Curriculum', 'driveria'); ?></strong>
                            <p><?php esc_html_e('Full compliance with state driving regulations, defensive maneuver standards, and traffic laws.', 'driveria'); ?></p>
                        </div>
                    </li>
                    <li>
                        <div class="chk-icon"><i class="fa-solid fa-shield-cat"></i></div>
                        <div>
                            <strong><?php esc_html_e('Dual-Control Safety Vehicles', 'driveria'); ?></strong>
                            <p><?php esc_html_e('Every lesson is conducted in late-model, dual-brake safety vehicles with full commercial insurance coverage.', 'driveria'); ?></p>
                        </div>
                    </li>
                    <li>
                        <div class="chk-icon"><i class="fa-solid fa-user-check"></i></div>
                        <div>
                            <strong><?php esc_html_e('Patient & Licensed Instructors', 'driveria'); ?></strong>
                            <p><?php esc_html_e('Background-checked, highly experienced instructors trained specifically to support nervous and beginner drivers.', 'driveria'); ?></p>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Training Programs & Services Grid -->
<section class="driveria-section about-services-section">
    <div class="driveria-container">
        <div class="section-title-wrap">
            <span class="section-subtitle"><i class="fa-solid fa-car-rear"></i> <?php esc_html_e('Our Specialized Programs', 'driveria'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Comprehensive Driving Training Tailored for You', 'driveria'); ?></h2>
            <p class="section-desc"><?php esc_html_e('From beginner lessons to advanced highway prep, Prime Driving School offers full-spectrum driver education.', 'driveria'); ?></p>
        </div>

        <div class="about-values-grid">
            <div class="value-card-v2">
                <div class="value-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                <h4><?php esc_html_e('Teen Behind-The-Wheel', 'driveria'); ?></h4>
                <p><?php esc_html_e('State-mandated licensing course for teens with flexible scheduling after school and weekends.', 'driveria'); ?></p>
            </div>

            <div class="value-card-v2">
                <div class="value-icon"><i class="fa-solid fa-user-shield"></i></div>
                <h4><?php esc_html_e('Adult Driving & Prep', 'driveria'); ?></h4>
                <p><?php esc_html_e('Customized one-on-one lessons for adults, nervous drivers, and international license holders.', 'driveria'); ?></p>
            </div>

            <div class="value-card-v2">
                <div class="value-icon"><i class="fa-solid fa-award"></i></div>
                <h4><?php esc_html_e('DMV Road Test Rental', 'driveria'); ?></h4>
                <p><?php esc_html_e('Use our dual-control car for your official DMV test with a pre-test warmup session.', 'driveria'); ?></p>
            </div>

            <div class="value-card-v2">
                <div class="value-icon"><i class="fa-solid fa-road"></i></div>
                <h4><?php esc_html_e('Highway & Parallel Parking', 'driveria'); ?></h4>
                <p><?php esc_html_e('Master high-speed merging, lane changes, complex intersections, and precise parallel parking.', 'driveria'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Trust Badges & Guarantee Banner -->
<section class="driveria-section about-trust-section">
    <div class="driveria-container">
        <div class="trust-box-wrap">
            <div class="trust-item">
                <i class="fa-solid fa-house-chimney-user"></i>
                <div>
                    <h4><?php esc_html_e('Free Doorstep Pickup', 'driveria'); ?></h4>
                    <p><?php esc_html_e('Free pickup and drop-off from your Home, School, or Office.', 'driveria'); ?></p>
                </div>
            </div>
            <div class="trust-item">
                <i class="fa-solid fa-clock"></i>
                <div>
                    <h4><?php esc_html_e('Open 7 Days a Week', 'driveria'); ?></h4>
                    <p><?php esc_html_e('Morning, afternoon, and evening slots available daily.', 'driveria'); ?></p>
                </div>
            </div>
            <div class="trust-item">
                <i class="fa-solid fa-headset"></i>
                <div>
                    <h4><?php esc_html_e('Direct Support', 'driveria'); ?></h4>
                    <p><?php esc_html_e('Call or text us anytime for instant booking assistance.', 'driveria'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call To Action Banner -->
<section class="driveria-section about-cta-section">
    <div class="driveria-container text-center" style="text-align: center;">
        <span class="cta-subtitle"><?php esc_html_e('Start Your Driving Journey With Us', 'driveria'); ?></span>
        <h2 class="cta-title"><?php esc_html_e('Ready to Get Behind the Wheel with Prime Driving School?', 'driveria'); ?></h2>
        <p class="cta-desc"><?php esc_html_e('Schedule your driving lesson or DMV test preparation session today with our certified patient instructors.', 'driveria'); ?></p>
        <div class="cta-buttons">
            <button type="button" class="btn-driveria btn-primary-driveria open-appointment-modal">
                <i class="fa-solid fa-calendar-check"></i>
                <span><?php esc_html_e('Book Appointment Now', 'driveria'); ?></span>
            </button>
            <a href="<?php echo esc_url(driveria_get_page_url('Contact Us', 'contact')); ?>" class="btn-driveria btn-outline-driveria" style="color: #FFFFFF; border-color: #FFFFFF;">
                <i class="fa-solid fa-phone"></i>
                <span><?php esc_html_e('Contact Us', 'driveria'); ?></span>
            </a>
        </div>
    </div>
</section>

<?php
$page_content = trim(get_the_content());
if (!empty($page_content)) :
?>
<section class="driveria-section page-editor-content" style="background: #FFFFFF; padding: 40px 0;">
    <div class="driveria-container">
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>
</section>
<?php
endif;

get_footer();
