<?php
/**
 * Music section
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="music-section py-24 bg-black text-white">
    <div class="max-w-7xl mx-auto px-4">
        <?php if (is_active_sidebar('music-content')) : ?>
            <?php dynamic_sidebar('music-content'); ?>
        <?php else : ?>
            <h2 class="text-4xl font-bold mb-6">
                <?php esc_html_e('Music', 'dj-tropix'); ?>
            </h2>
            <p class="text-gray-300">
                <?php esc_html_e('Add players, playlists, or embeds in the Music Content widget area.', 'dj-tropix'); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

