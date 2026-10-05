<?php
/**
 * Template Name: Blog & News Hub
 *
 * Attractive magazine-style blog page template for Driveria theme.
 * Allows WP admins to display published blogs in a stunning, interactive layout.
 *
 * @package Driveria
 */

get_header();

// Fetch categories for the filter bar
$categories = get_categories(array(
    'orderby'    => 'name',
    'parent'     => 0,
    'hide_empty' => true
));
?>

<!-- Blog Hub Hero Header -->
<section class="driveria-page-header driveria-blog-hero">
    <div class="driveria-container">
        <div class="blog-hero-content">
            <span class="driveria-badge-pill"><i class="fa-solid fa-graduation-cap"></i> <?php esc_html_e('Learning Hub & Road Safety', 'driveria'); ?></span>
            <h1 class="page-title"><?php esc_html_e('Driving Tips, Guides & News', 'driveria'); ?></h1>
            <p class="page-subtitle"><?php esc_html_e('Expert advice, road rules, and practical test preparation guides written by certified driving instructors.', 'driveria'); ?></p>
            
            <!-- Hero Search Form -->
            <div class="blog-hero-search">
                <form role="search" method="get" class="hero-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="search" class="hero-search-input" placeholder="<?php esc_attr_e('Search driving tips, parking guides, test advice...', 'driveria'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit" class="driveria-btn driveria-btn-primary search-btn"><?php esc_html_e('Search', 'driveria'); ?></button>
                </form>
            </div>
            
            <!-- Category Pills Filter -->
            <?php if (!empty($categories)) : ?>
                <div class="blog-category-pills">
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="category-pill active">
                        <i class="fa-solid fa-layer-group"></i> <?php esc_html_e('All Articles', 'driveria'); ?>
                    </a>
                    <?php foreach ($categories as $cat) : ?>
                        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="category-pill">
                            <?php echo esc_html($cat->name); ?> <span class="pill-count">(<?php echo esc_html($cat->count); ?>)</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Featured Hero Post Section -->
<?php
$featured_args = array(
    'posts_per_page'      => 1,
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => false,
);
$featured_query = new WP_Query($featured_args);

$featured_id = 0;
if ($featured_query->have_posts()) :
    while ($featured_query->have_posts()) : $featured_query->the_post();
        $featured_id = get_the_ID();
        $cats = get_the_category();
        $primary_cat = !empty($cats) ? $cats[0]->name : esc_html__('Driving Tips', 'driveria');
        $read_time = function_exists('driveria_reading_time') ? driveria_reading_time($featured_id) : 4;
        ?>
        <section class="driveria-section driveria-featured-post-section">
            <div class="driveria-container">
                <div class="featured-post-card">
                    <div class="featured-post-thumb">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('driveria-blog-featured', array('alt' => get_the_title())); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>" class="featured-thumb-placeholder">
                                <i class="fa-solid fa-car-side"></i>
                            </a>
                        <?php endif; ?>
                        <span class="featured-badge"><i class="fa-solid fa-star"></i> <?php esc_html_e('Featured Article', 'driveria'); ?></span>
                    </div>

                    <div class="featured-post-content">
                        <div class="blog-meta-tags">
                            <span class="meta-tag cat-tag"><?php echo esc_html($primary_cat); ?></span>
                            <span class="meta-tag read-time"><i class="fa-regular fa-clock"></i> <?php echo esc_html($read_time); ?> <?php esc_html_e('min read', 'driveria'); ?></span>
                        </div>

                        <h2 class="featured-post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <div class="featured-post-excerpt">
                            <p><?php echo wp_trim_words(get_the_excerpt(), 32); ?></p>
                        </div>

                        <div class="featured-post-footer">
                            <div class="author-info">
                                <div class="author-avatar">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 48); ?>
                                </div>
                                <div class="author-details">
                                    <span class="author-name"><?php the_author(); ?></span>
                                    <span class="post-date"><i class="fa-regular fa-calendar-days"></i> <?php echo get_the_date(); ?></span>
                                </div>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="driveria-btn driveria-btn-primary featured-btn">
                                <span><?php esc_html_e('Read Featured Story', 'driveria'); ?></span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    endwhile;
    wp_reset_postdata();
endif;
?>

<!-- Main Blog Content Section -->
<section class="driveria-section driveria-blog-main-section">
    <div class="driveria-container">
        <div class="blog-layout-grid">
            
            <!-- Left: Articles Grid -->
            <main class="blog-feed-main">
                <div class="section-header-inline">
                    <h3 class="feed-title"><?php esc_html_e('Latest Articles & News', 'driveria'); ?></h3>
                    <span class="feed-subtitle"><?php esc_html_e('Fresh guides published weekly', 'driveria'); ?></span>
                </div>

                <div class="blog-cards-grid">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
                    
                    $grid_args = array(
                        'post_type'      => 'post',
                        'post_status'    => 'publish',
                        'paged'          => $paged,
                        'post__not_in'   => $featured_id ? array($featured_id) : array(),
                        'posts_per_page' => 6,
                    );
                    
                    $grid_query = new WP_Query($grid_args);

                    if ($grid_query->have_posts()) :
                        while ($grid_query->have_posts()) : $grid_query->the_post();
                            $post_id = get_the_ID();
                            $cats = get_the_category();
                            $cat_name = !empty($cats) ? $cats[0]->name : esc_html__('Driving Tips', 'driveria');
                            $cat_link = !empty($cats) ? get_category_link($cats[0]->term_id) : '#';
                            $read_time = function_exists('driveria_reading_time') ? driveria_reading_time($post_id) : 3;
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('driveria-blog-card'); ?>>
                                <div class="blog-card-media">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>" class="media-link">
                                            <?php the_post_thumbnail('driveria-blog-grid', array('alt' => get_the_title())); ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php the_permalink(); ?>" class="media-placeholder">
                                            <i class="fa-solid fa-road"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <a href="<?php echo esc_url($cat_link); ?>" class="blog-card-cat-badge">
                                        <?php echo esc_html($cat_name); ?>
                                    </a>
                                </div>

                                <div class="blog-card-content">
                                    <div class="blog-card-meta">
                                        <span class="meta-item"><i class="fa-regular fa-calendar"></i> <?php echo get_the_date('M j, Y'); ?></span>
                                        <span class="meta-item"><i class="fa-regular fa-clock"></i> <?php echo esc_html($read_time); ?> min</span>
                                    </div>

                                    <h3 class="blog-card-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>

                                    <p class="blog-card-excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
                                    </p>

                                    <div class="blog-card-footer">
                                        <div class="card-author">
                                            <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                                            <span class="author-name"><?php the_author(); ?></span>
                                        </div>

                                        <a href="<?php the_permalink(); ?>" class="read-more-link">
                                            <span><?php esc_html_e('Read', 'driveria'); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        ?>
                        <div class="no-posts-found-box">
                            <div class="no-posts-icon">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                            <h3><?php esc_html_e('No Published Blog Posts Yet', 'driveria'); ?></h3>
                            <p><?php esc_html_e('Aap yahan se 1-click me 3 dummy sample blog posts generate kar sakte hain ya WP Admin se post publish kar sakte hain.', 'driveria'); ?></p>
                            <?php if (current_user_can('edit_posts')) : ?>
                                <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-top: 15px;">
                                    <a href="<?php echo esc_url(add_query_arg('driveria_import_sample_posts', '1')); ?>" class="driveria-btn driveria-btn-primary">
                                        <i class="fa-solid fa-wand-magic-sparkles"></i> <?php esc_html_e('Import 3 Sample Posts Now', 'driveria'); ?>
                                    </a>
                                    <a href="<?php echo esc_url(admin_url('post-new.php')); ?>" class="driveria-btn driveria-btn-outline" target="_blank">
                                        <i class="fa-solid fa-plus"></i> <?php esc_html_e('Create Post in WP Admin', 'driveria'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>

                <!-- Numbered Pagination -->
                <div class="blog-pagination-wrapper">
                    <?php
                    echo paginate_links(array(
                        'total'     => $grid_query->max_num_pages,
                        'current'   => $paged,
                        'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
                        'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
                        'type'      => 'list',
                    ));
                    ?>
                </div>
            </main>

            <!-- Right: Interactive Sidebar -->
            <aside class="blog-sidebar-wrapper">
                
                <!-- Search Widget -->
                <div class="sidebar-widget widget-search">
                    <h4 class="widget-title"><i class="fa-solid fa-magnifying-glass"></i> <?php esc_html_e('Search Hub', 'driveria'); ?></h4>
                    <form role="search" method="get" class="sidebar-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="search-input-group">
                            <input type="search" class="search-field" placeholder="<?php esc_attr_e('Keywords e.g. parallel parking...', 'driveria'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                            <button type="submit" class="search-btn"><i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </form>
                </div>

                <!-- Categories Widget -->
                <?php if (!empty($categories)) : ?>
                    <div class="sidebar-widget widget-categories">
                        <h4 class="widget-title"><i class="fa-solid fa-folder-open"></i> <?php esc_html_e('Explore Categories', 'driveria'); ?></h4>
                        <ul class="categories-list">
                            <?php foreach ($categories as $cat) : ?>
                                <li>
                                    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>">
                                        <span class="cat-name"><i class="fa-solid fa-chevron-right cat-arrow"></i> <?php echo esc_html($cat->name); ?></span>
                                        <span class="cat-count-badge"><?php echo esc_html($cat->count); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Trending / Popular Articles Widget -->
                <div class="sidebar-widget widget-trending">
                    <h4 class="widget-title"><i class="fa-solid fa-fire"></i> <?php esc_html_e('Trending Articles', 'driveria'); ?></h4>
                    <div class="trending-posts-list">
                        <?php
                        $trending_query = new WP_Query(array(
                            'post_type'      => 'post',
                            'posts_per_page' => 4,
                            'post_status'    => 'publish',
                            'orderby'        => 'comment_count date',
                        ));

                        if ($trending_query->have_posts()) :
                            while ($trending_query->have_posts()) : $trending_query->the_post();
                                ?>
                                <div class="trending-item">
                                    <div class="trending-thumb">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                                        <?php else : ?>
                                            <a href="<?php the_permalink(); ?>" class="trend-placeholder"><i class="fa-solid fa-car"></i></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="trending-info">
                                        <span class="trend-date"><i class="fa-regular fa-calendar"></i> <?php echo get_the_date('M j, Y'); ?></span>
                                        <h5 class="trend-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>

                <!-- Newsletter Subscription Widget -->
                <div class="sidebar-widget widget-newsletter">
                    <div class="newsletter-icon-wrap">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <h4><?php esc_html_e('Get Free Driving Exam Tips', 'driveria'); ?></h4>
                    <p><?php esc_html_e('Join 5,000+ students receiving weekly road safety and driving test hacks.', 'driveria'); ?></p>
                    <form class="blog-newsletter-form" onsubmit="event.preventDefault(); alert('Thank you for subscribing to Driveria Blog updates!');">
                        <input type="email" placeholder="<?php esc_attr_e('Enter your email address', 'driveria'); ?>" required />
                        <button type="submit" class="driveria-btn driveria-btn-primary full-width-btn">
                            <?php esc_html_e('Subscribe Free', 'driveria'); ?> <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </form>
                </div>

                <!-- CTA Widget: Book Lessons -->
                <div class="sidebar-widget widget-cta-banner">
                    <div class="cta-banner-content">
                        <span class="cta-subtitle"><?php esc_html_e('READY TO DRIVE?', 'driveria'); ?></span>
                        <h4 class="cta-title"><?php esc_html_e('Pass Your Driving Test on 1st Attempt', 'driveria'); ?></h4>
                        <p><?php esc_html_e('Book personalized 1-on-1 driving lessons with top-rated instructors.', 'driveria'); ?></p>
                        <button class="driveria-btn driveria-btn-light open-booking-modal">
                            <i class="fa-solid fa-car"></i> <?php esc_html_e('Book Free Trial Lesson', 'driveria'); ?>
                        </button>
                    </div>
                </div>

            </aside>

        </div>
    </div>
</section>

<!-- Author Bio Section (Added as requested) -->
<section class="driveria-section driveria-author-bio-section" style="padding: 40px 0; border-top: 1px solid #eee; background-color: #fcfcfc;">
    <div class="driveria-container">
        <div class="author-bio-card" style="display: flex; flex-wrap: wrap; gap: 30px; align-items: center; background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
            <div class="author-avatar-wrapper" style="flex-shrink: 0;">
                <?php 
                // Fetching the avatar of the page author
                echo get_avatar(get_the_author_meta('ID'), 120, '', '', array('style' => 'border-radius: 50%; border: 4px solid #f0f0f0;')); 
                ?>
            </div>
            <div class="author-info-wrapper" style="flex: 1; min-width: 250px;">
                <h3 class="author-title" style="margin-top: 0; margin-bottom: 12px; font-size: 24px;">
                    <?php esc_html_e('Meet the Instructor: ', 'driveria'); ?> <span style="color: var(--primary-color, #e74c3c);"><?php the_author(); ?></span>
                </h3>
                <p class="author-desc" style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                    <?php 
                    $author_bio = get_the_author_meta('description');
                    // Fallback text if WP User Bio is empty
                    echo !empty($author_bio) ? esc_html($author_bio) : esc_html__('Prime Driving School provides DMV-approved driving lessons in Virginia for teens, adults, beginners, and learners preparing for the DMV road test. Our instructors focus on practical driving skills, defensive driving, highway training, parking, lane changes, and safe decision-making. Our blog shares useful, easy-to-understand driving tips and Virginia driver education information to help learners prepare for safer and more confident driving.', 'driveria'); 
                    ?>
                </p>
                <div class="author-actions">
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="driveria-btn driveria-btn-outline" style="text-decoration: none;">
                        <i class="fa-solid fa-pen-nib"></i> <?php esc_html_e('View All Guides by ', 'driveria'); ?> <?php the_author(); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();