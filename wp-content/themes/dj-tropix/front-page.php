<?php
/**
 * Front page template showing the one-page DJ layout.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main">
    <?php get_template_part('template-parts/section', 'hero'); ?>
    <?php get_template_part('template-parts/section', 'first-event'); ?>
    <?php get_template_part('template-parts/section', 'about'); ?>
    <?php get_template_part('template-parts/section', 'music'); ?>
    <?php get_template_part('template-parts/section', 'events'); ?>
    <?php get_template_part('template-parts/section', 'contact'); ?>
</main>

<?php
get_footer();

