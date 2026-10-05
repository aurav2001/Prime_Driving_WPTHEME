<?php
/**
 * Blog / News Archive Template
 *
 * @package Driveria
 */

get_header();
?>

<!-- Page Header -->
<section class="driveria-page-header">
    <div class="driveria-container">
        <h1 class="page-title">
            <?php
            if (is_category()) {
                single_cat_title();
            } elseif (is_tag()) {
                single_tag_title();
            } elseif (is_author()) {
                echo get_the_author();
            } else {
                esc_html_e('Driving Tips & News', 'driveria');
            }
            ?>
        </h1>
        <p class="page-subtitle"><?php esc_html_e('Latest road safety tips, driving exam advice, and academy updates.', 'driveria'); ?></p>
        <div class="header-breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'driveria'); ?></a>
            <i class="fa-solid fa-chevron-right"></i>
            <span><?php esc_html_e('Blog', 'driveria'); ?></span>
        </div>
    </div>
</section>

<!-- Blog Layout -->
<section class="driveria-section driveria-blog-archive">
    <div class="driveria-container">
        <div class="blog-layout-wrapper">
            <!-- Main Content Area -->
            <main class="blog-main-content">
                <div class="driveria-grid driveria-grid-2">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            ?>
                            <article <?php post_class('blog-post-card'); ?>>
                                <div class="blog-post-thumb">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium_large'); ?></a>
                                    <?php else : ?>
                                        <a href="<?php the_permalink(); ?>" class="placeholder-bg blog-placeholder">
                                            <i class="fa-solid fa-newspaper"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="blog-post-body">
                                    <div class="blog-post-meta">
                                        <span><i class="fa-regular fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                        <span><i class="fa-regular fa-user"></i> <?php the_author(); ?></span>
                                    </div>
                                    <h3 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="blog-post-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="blog-read-more">
                                        <span><?php esc_html_e('Read Full Article', 'driveria'); ?></span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                            <?php
                        endwhile;
                    else :
                        ?>
                        <p><?php esc_html_e('No blog posts found.', 'driveria'); ?></p>
                        <?php
                    endif;
                    ?>
                </div>

                <div class="driveria-pagination">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
                        'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
                    ));
                    ?>
                </div>
            </main>

            <!-- Blog Sidebar -->
            <aside class="blog-sidebar">
                <div class="sidebar-widget">
                    <h4 class="widget-title"><?php esc_html_e('Search Articles', 'driveria'); ?></h4>
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" class="search-field" placeholder="<?php esc_attr_e('Type keywords...', 'driveria'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit" class="search-submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>

                <div class="sidebar-widget">
                    <h4 class="widget-title"><?php esc_html_e('Categories', 'driveria'); ?></h4>
                    <ul class="widget-list">
                        <?php wp_list_categories(array('title_li' => '')); ?>
                    </ul>
                </div>

                <div class="sidebar-widget sidebar-cta-box">
                    <h4><?php esc_html_e('Need Driving Lessons?', 'driveria'); ?></h4>
                    <p><?php esc_html_e('Get 1-on-1 instruction with certified instructors today.', 'driveria'); ?></p>
                    <button class="driveria-btn driveria-btn-primary open-booking-modal"><?php esc_html_e('Book Now', 'driveria'); ?></button>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php
get_footer();
