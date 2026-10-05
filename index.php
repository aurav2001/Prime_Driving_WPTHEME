<?php
/**
 * Driveria Main Index Template
 *
 * @package Driveria
 */

// If home page or front fallback, load the full Driveria theme Front Page layout
if (is_front_page() || is_home() || !is_page()) {
    require get_template_directory() . '/front-page.php';
    return;
}

get_header();
?>

<section class="driveria-page-header">
    <div class="driveria-container">
        <h1 class="page-title"><?php esc_html_e('Blog & Driving News', 'driveria'); ?></h1>
    </div>
</section>

<div class="driveria-container driveria-standard-layout">
    <main class="site-main blog-grid">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="blog-card-thumb">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                        </div>
                    <?php endif; ?>
                    <div class="blog-card-body">
                        <span class="blog-date"><i class="fa-regular fa-calendar"></i> <?php echo get_the_date(); ?></span>
                        <h2 class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read-more-btn"><?php esc_html_e('Read Article', 'driveria'); ?> <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>
                <?php
            endwhile;
            the_posts_pagination();
        else :
            echo '<p>' . esc_html__('No blog posts found.', 'driveria') . '</p>';
        endif;
        ?>
    </main>
</div>

<?php
get_footer();
