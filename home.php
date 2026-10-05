<?php
/**
 * Driveria Standard Posts Page / Blog Home Template
 *
 * Used automatically by WordPress when a page is set as "Posts page" in Settings -> Reading
 * or when accessing the blog directory.
 *
 * @package Driveria
 */

// If this is the main root homepage (Front Page), load the full Front Page layout
if (is_front_page()) {
    require get_template_directory() . '/front-page.php';
    return;
}

// Otherwise load the Blog Hub for the posts page
require get_template_directory() . '/template-blog.php';
