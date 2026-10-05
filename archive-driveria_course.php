<?php
/**
 * Template Name: Courses Page / CPT Archive
 * Description: Redesigned High-End Driving Courses Page Template for Driveria Theme
 *
 * @package Driveria
 */

get_header();
?>

<!-- Page Header -->
<section class="driveria-page-header">
    <div class="driveria-container">
        <h1 class="page-title"><?php esc_html_e('Explore Driving Courses & Packages', 'driveria'); ?></h1>
        <p class="page-subtitle"><?php esc_html_e('Select specialized behind-the-wheel training tailored for beginners, teens, adults, and road exam prep.', 'driveria'); ?></p>
        <div class="header-breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'driveria'); ?></a>
            <i class="fa-solid fa-chevron-right"></i>
            <span><?php esc_html_e('Driving Courses', 'driveria'); ?></span>
        </div>
    </div>
</section>

<!-- Category Filter Toolbar -->
<section class="driveria-section" style="padding-bottom: 20px;">
    <div class="driveria-container">
        <div class="course-filter-toolbar">
            <?php
            $is_tax_page = is_tax('driveria_course_category') || is_tax('course_category');
            $current_term = $is_tax_page ? get_queried_object() : null;
            $current_slug = ($current_term && isset($current_term->slug)) ? $current_term->slug : 'all';
            ?>
            <button type="button" class="filter-pill <?php echo ($current_slug === 'all') ? 'active' : ''; ?>" data-filter="all">
                <i class="fa-solid fa-layer-group"></i> <?php esc_html_e('All Programs', 'driveria'); ?>
            </button>

            <?php
            $categories = get_terms(array(
                'taxonomy'   => array('driveria_course_category', 'course_category'),
                'hide_empty' => false,
            ));

            if (!empty($categories) && !is_wp_error($categories)) :
                foreach ($categories as $cat) :
                    $is_active = ($current_slug === $cat->slug) ? 'active' : '';
                    $cat_link  = get_term_link($cat);
                    ?>
                    <a href="<?php echo esc_url($cat_link); ?>" class="filter-pill <?php echo $is_active; ?>" data-filter="<?php echo esc_attr($cat->slug); ?>">
                        <i class="fa-solid fa-car-rear"></i> <?php echo esc_html($cat->name); ?>
                    </a>
                    <?php
                endforeach;
            else :
                // Default category fallbacks if no taxonomy terms created yet
                $default_cats = array('Teen & Youth', 'Adult & DMV Test', 'Automatic Specialist', 'Manual Gearbox');
                foreach ($default_cats as $d_cat) :
                    $d_slug = sanitize_title($d_cat);
                    ?>
                    <button type="button" class="filter-pill" data-filter="<?php echo esc_attr($d_slug); ?>"><i class="fa-solid fa-car-rear"></i> <?php echo esc_html($d_cat); ?></button>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Courses Grid Section -->
<section class="driveria-section" style="background: #F8FAFC; padding-top: 20px;">
    <div class="driveria-container">
        <div class="courses-grid">
            <?php
            $args = array(
                'post_type'      => 'driveria_course',
                'posts_per_page' => -1,
                'orderby'        => 'date',
                'order'          => 'ASC'
            );

            if ($is_tax_page && isset($current_term->term_id)) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => $current_term->taxonomy,
                        'field'    => 'term_id',
                        'terms'    => $current_term->term_id,
                    )
                );
            }

            $course_query = new WP_Query($args);

            if ($course_query->have_posts()) :
                while ($course_query->have_posts()) : $course_query->the_post();
                    $course_id = get_the_ID();
                    $price    = driveria_get_course_meta($course_id, 'course_price', '');
                    $duration = driveria_get_course_meta($course_id, 'course_duration', '');
                    $lessons  = driveria_get_course_meta($course_id, 'course_lessons', '');
                    $level    = driveria_get_course_meta($course_id, 'course_level', '');
                    $badge    = driveria_get_course_meta($course_id, 'course_badge', '');
                    $features = driveria_get_course_meta($course_id, 'course_features', '');

                    // Get assigned term slugs for instant JS filtering
                    $terms = wp_get_post_terms($course_id, array('driveria_course_category', 'course_category'), array('fields' => 'slugs'));
                    $term_slugs = (!empty($terms) && !is_wp_error($terms)) ? implode(' ', $terms) : '';
                    
                    $thumb_url = get_the_post_thumbnail_url($course_id, 'large') ?: 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=800&q=80';
                    ?>
                    <div class="course-card-v2" data-category="<?php echo esc_attr($term_slugs); ?>">
                        <div class="course-card-banner">
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" />
                            <?php if (!empty($badge)) : ?>
                                <span class="course-card-tag"><?php echo esc_html($badge); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($price)) : ?>
                                <div class="course-card-price"><?php echo esc_html($price); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="course-card-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                            
                            <?php 
                            $features_arr = array();
                            if (!empty($features)) {
                                $features_arr = explode("\n", str_replace("\r", "", $features));
                                $features_arr = array_filter(array_map('trim', $features_arr));
                            }
                            
                            if (!empty($features_arr)) : ?>
                                <ul class="course-specs-list">
                                    <?php foreach ($features_arr as $feat) : ?>
                                        <li><i class="fa-solid fa-circle-check" style="color: #FFB800; margin-right: 8px;"></i> <?php echo esc_html($feat); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php elseif (!empty($duration) || !empty($lessons) || !empty($level)) : ?>
                                <ul class="course-specs-list">
                                    <?php if (!empty($duration)) : ?>
                                        <li><i class="fa-regular fa-clock"></i> <strong>Duration:</strong> <?php echo esc_html($duration); ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($lessons)) : ?>
                                        <li><i class="fa-solid fa-list-check"></i> <strong>Lessons:</strong> <?php echo esc_html($lessons); ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($level)) : ?>
                                        <li><i class="fa-solid fa-layer-group"></i> <strong>Level:</strong> <?php echo esc_html($level); ?></li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>

                            <div class="course-card-actions" style="display: flex; gap: 10px; margin-top: 20px;">
                                <a href="<?php the_permalink(); ?>" class="btn-view-details" style="flex: 1;">
                                    <i class="fa-solid fa-eye"></i>
                                    <span><?php esc_html_e('View Details', 'driveria'); ?></span>
                                </a>
                                <?php $checkout_url = driveria_get_course_checkout_url(get_the_ID()); ?>
                                <a href="<?php echo esc_url($checkout_url); ?>" class="btn-course-enroll course-btn" data-course="<?php echo esc_attr(get_the_title()); ?>" style="flex: 1.25; margin-top: 0;">
                                    <span><?php esc_html_e('Enroll Now', 'driveria'); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                $fallback_courses = array(
                    array(
                        'title'    => 'Teen & Youth License Training',
                        'price'    => '$299',
                        'badge'    => 'Most Popular',
                        'duration' => '2 Weeks (10 Hours)',
                        'lessons'  => '5 Behind-The-Wheel Lessons',
                        'img'      => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=800&q=80',
                        'desc'     => 'Comprehensive driving program designed for first-time teen drivers with parking, lane control, and road safety.'
                    ),
                    array(
                        'title'    => 'Adult Highway & DMV Road Test Prep',
                        'price'    => '$399',
                        'badge'    => 'Best Seller',
                        'duration' => '3 Weeks (14 Hours)',
                        'lessons'  => '7 Behind-The-Wheel Lessons',
                        'img'      => 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&w=800&q=80',
                        'desc'     => 'Focuses on highway merging, night driving, parallel parking, and mock exam on official DMV test routes.'
                    ),
                    array(
                        'title'    => 'Defensive & Winter Driving Masterclass',
                        'price'    => '$449',
                        'badge'    => 'Advanced',
                        'duration' => '4 Weeks (18 Hours)',
                        'lessons'  => '9 Behind-The-Wheel Lessons',
                        'img'      => 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=800&q=80',
                        'desc'     => 'Advanced hazard recognition, slippery road maneuvering, skid control, and high-speed freeway navigation.'
                    ),
                );

                foreach ($fallback_courses as $fc) :
                    ?>
                    <div class="course-card-v2">
                        <div class="course-card-banner">
                            <img src="<?php echo esc_url($fc['img']); ?>" alt="<?php echo esc_attr($fc['title']); ?>" />
                            <span class="course-card-tag"><?php echo esc_html($fc['badge']); ?></span>
                            <div class="course-card-price"><?php echo esc_html($fc['price']); ?></div>
                        </div>

                        <div class="course-card-content">
                            <h3><?php echo esc_html($fc['title']); ?></h3>
                            <p><?php echo esc_html($fc['desc']); ?></p>
                            
                            <ul class="course-specs-list">
                                <li><i class="fa-regular fa-clock"></i> <strong>Duration:</strong> <?php echo esc_html($fc['duration']); ?></li>
                                <li><i class="fa-solid fa-list-check"></i> <strong>Lessons:</strong> <?php echo esc_html($fc['lessons']); ?></li>
                                <li><i class="fa-solid fa-shield-halved"></i> <strong>Vehicle:</strong> Dual-Control Fleet</li>
                                <li><i class="fa-solid fa-house-user"></i> <strong>Pickup:</strong> Free Doorstep Pickup</li>
                            </ul>

                            <a href="<?php echo esc_url(home_url('/#booking')); ?>" class="btn-course-enroll">
                                <?php esc_html_e('Enroll In Course', 'driveria'); ?>
                            </a>
                        </div>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Included Perks Section -->
<section class="driveria-section">
    <div class="driveria-container">
        <div class="section-title-wrap">
            <span class="section-subtitle"><i class="fa-solid fa-gift"></i> <?php esc_html_e('Included In Every Package', 'driveria'); ?></span>
            <h2 class="section-title"><?php esc_html_e('All Driveria Courses Include', 'driveria'); ?></h2>
        </div>

        <div class="about-values-grid">
            <div class="value-card-v2">
                <div class="value-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h4><?php esc_html_e('Dual-Control Car Rental', 'driveria'); ?></h4>
                <p><?php esc_html_e('Every lesson uses insured, climate-controlled, dual-brake safety vehicles.', 'driveria'); ?></p>
            </div>
            <div class="value-card-v2">
                <div class="value-icon"><i class="fa-solid fa-house-circle-check"></i></div>
                <h4><?php esc_html_e('Free Pickup & Drop', 'driveria'); ?></h4>
                <p><?php esc_html_e('We pick you up from your home, school, or workplace and drop you back free of charge.', 'driveria'); ?></p>
            </div>
            <div class="value-card-v2">
                <div class="value-icon"><i class="fa-solid fa-certificate"></i></div>
                <h4><?php esc_html_e('DMV Certificate of Completion', 'driveria'); ?></h4>
                <p><?php esc_html_e('Receive an official completion certificate for insurance discounts and license exam application.', 'driveria'); ?></p>
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
