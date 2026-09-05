<?php
/**
 * Events section
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="events-section py-24 bg-black text-white">
    <div class="max-w-7xl mx-auto px-4">
        <?php if (is_active_sidebar('events-content')) : ?>
            <?php dynamic_sidebar('events-content'); ?>
        <?php else : ?>
            <h2 class="text-4xl font-bold mb-6">
                <?php esc_html_e('Events', 'dj-tropix'); ?>
            </h2>
            <p class="text-gray-300">
                <?php esc_html_e('Add upcoming events content via the Events Content widget area.', 'dj-tropix'); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

