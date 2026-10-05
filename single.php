<?php
/**
 * Driveria Single Blog Post Template
 *
 * @package Driveria
 */

get_header();
?>

<section class="driveria-page-header">
    <div class="driveria-container">
        <h1 class="page-title"><?php the_title(); ?></h1>
        <div class="post-meta-header">
            <span><i class="fa-regular fa-calendar"></i> <?php echo get_the_date(); ?></span>
            <span><i class="fa-regular fa-user"></i> <?php the_author(); ?></span>
        </div>
    </div>
</section>

<div class="driveria-container driveria-standard-layout">
    <main class="site-main" style="padding-top: 40px; padding-bottom: 45px;">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                if (has_post_thumbnail()) {
                    the_post_thumbnail('large', array('class' => 'blog-post-img'));
                }
                echo '<div class="entry-content post-content">';
                the_content();
                echo '</div>'; // Closes the main post content card

                // Guest Author / Standard Author Logic
                $guest_name  = get_post_meta(get_the_ID(), '_guest_author_name', true) ?: get_post_meta(get_the_ID(), 'guest_author_name', true);
                $guest_bio   = get_post_meta(get_the_ID(), '_guest_author_bio', true) ?: get_post_meta(get_the_ID(), 'guest_author_bio', true);
                $guest_email = get_post_meta(get_the_ID(), '_guest_author_email', true) ?: get_post_meta(get_the_ID(), 'guest_author_email', true);
                $guest_img   = get_post_meta(get_the_ID(), '_guest_author_image', true) ?: get_post_meta(get_the_ID(), 'guest_author_image', true);

                $show_box = false;
                $author_name = '';
                $author_bio = '';
                $author_email = '';
                $avatar_html = '';

                if (!empty($guest_name) && !empty($guest_bio)) {
                    $author_name = $guest_name;
                    $author_bio  = $guest_bio;
                    $author_email = $guest_email;
                    if (!empty($guest_img)) {
                        $avatar_html = '<img src="' . esc_url($guest_img) . '" alt="' . esc_attr($guest_name) . '" class="avatar avatar-100 photo" height="100" width="100" />';
                    } elseif (!empty($guest_email)) {
                        $avatar_html = get_avatar($guest_email, 100);
                    } else {
                        $avatar_html = get_avatar('', 100);
                    }
                    $show_box = true;
                } else {
                    $author_desc = get_the_author_meta('description');
                    if (!empty($author_desc)) {
                        $author_name = get_the_author_meta('display_name');
                        $author_bio  = $author_desc;
                        $author_email = get_the_author_meta('user_email');
                        $avatar_html = get_avatar(get_the_author_meta('ID'), 100);
                        $show_box = true;
                    }
                }

                if ($show_box) :
                    ?>
                    <div class="driveria-author-box">
                        <div class="author-avatar">
                            <?php echo $avatar_html; ?>
                        </div>
                        <div class="author-info">
                            <h4 class="author-name">
                                <?php echo esc_html($author_name); ?>
                                <?php if (!empty($author_email)) : ?>
                                    <a href="mailto:<?php echo esc_attr($author_email); ?>" class="author-email-link" title="Contact Author">
                                        <i class="fa-solid fa-envelope" style="color: #EA4335; margin-left: 8px;"></i>
                                    </a>
                                <?php endif; ?>
                            </h4>
                            <p class="author-bio">
                                <?php echo esc_html($author_bio); ?>
                            </p>
                        </div>
                    </div>
                    <?php
                endif;
            endwhile;
        endif;
        ?>
    </main>
</div>

<?php
get_footer();
