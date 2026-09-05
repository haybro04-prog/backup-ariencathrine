<?php
/**
 * About section
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="about-section py-24 bg-black text-white">
    <div class="max-w-7xl mx-auto px-4">
        <?php if (is_active_sidebar('about-content')) : ?>
            <?php dynamic_sidebar('about-content'); ?>
        <?php else : ?>
            <h2 class="text-5xl md:text-6xl font-bold mb-6">
                <?php esc_html_e('About the Artist', 'dj-tropix'); ?>
            </h2>
            <p class="text-xl text-gray-300 max-w-3xl">
                <?php esc_html_e('Add content for the About section via the About Content widget area.', 'dj-tropix'); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

