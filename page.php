<?php
/**
 * Driveria Default Page Template
 *
 * @package Driveria
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
?>

<?php
driveria_render_page_header();
?>

<div class="driveria-page-content-wrapper py-5">
    <div class="driveria-container driveria-standard-layout">
        <main class="site-main entry-content">
            <?php
            if (has_post_thumbnail()) :
                ?>
                <div class="page-featured-image mb-4">
                    <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded')); ?>
                </div>
                <?php
            endif;

            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'driveria'),
                'after'  => '</div>',
            ));
            ?>
        </main>
    </div>
</div>

<?php
    endwhile;
endif;

get_footer();



