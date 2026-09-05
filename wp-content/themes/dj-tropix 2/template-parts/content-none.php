<?php
/**
 * Template part for displaying a message that posts cannot be found.
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="no-results not-found py-24 text-white">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h1 class="text-3xl font-bold mb-4">
            <?php esc_html_e('Nothing Found', 'dj-tropix'); ?>
        </h1>
        <p class="text-gray-300">
            <?php esc_html_e('It seems we can’t find what you’re looking for. Try creating some content in the admin.', 'dj-tropix'); ?>
        </p>
    </div>
</section>

