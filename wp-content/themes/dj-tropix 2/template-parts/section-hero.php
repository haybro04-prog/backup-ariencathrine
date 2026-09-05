<?php
/**
 * Hero section
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="hero-section relative h-screen flex items-center justify-center overflow-hidden">
    <div class="hero-inner text-center px-4 max-w-5xl mx-auto">
        <?php if (is_active_sidebar('hero-content')) : ?>
            <?php dynamic_sidebar('hero-content'); ?>
        <?php else : ?>
            <h1 class="text-6xl md:text-8xl font-bold text-white mb-4 tracking-tight">
                <?php bloginfo('name'); ?>
            </h1>
            <p class="text-xl md:text-2xl text-orange-400 mb-2 uppercase tracking-widest">
                <?php bloginfo('description'); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

