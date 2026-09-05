<?php
/**
 * Contact section
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="contact-section py-24 bg-black text-white">
    <div class="max-w-7xl mx-auto px-4">
        <?php if (is_active_sidebar('contact-content')) : ?>
            <?php dynamic_sidebar('contact-content'); ?>
        <?php else : ?>
            <h2 class="text-4xl font-bold mb-6">
                <?php esc_html_e('Contact', 'dj-tropix'); ?>
            </h2>
            <p class="text-gray-300">
                <?php esc_html_e('Add a contact form or details via the Contact Content widget area.', 'dj-tropix'); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

