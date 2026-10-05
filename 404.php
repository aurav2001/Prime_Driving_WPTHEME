<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Driveria
 */

status_header(404);
nocache_headers();

get_header();

if ( function_exists( 'driveria_render_page_header' ) ) {
    driveria_render_page_header( __( '404 - Page Not Found', 'driveria' ), __( 'The page you are looking for does not exist or has been moved.', 'driveria' ) );
}
?>

<div class="driveria-container" style="padding: 80px 20px; text-align: center;">
    <div style="max-width: 600px; margin: 0 auto;">
        <h1 style="font-size: 72px; font-weight: 800; color: #1E293B; margin-bottom: 10px;">404</h1>
        <h2 style="font-size: 24px; font-weight: 700; margin-bottom: 15px; color: #0F172A;">Oops! Page Not Found</h2>
        <p style="color: #64748B; font-size: 16px; margin-bottom: 30px;">
            The link you clicked may be broken, or the page may have been removed.
        </p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="background: #FFB800; color: #0A0F1D; padding: 12px 28px; border-radius: 8px; font-weight: 700; text-decoration: none; display: inline-block;">
            Back to Home
        </a>
    </div>
</div>

<?php
get_footer();