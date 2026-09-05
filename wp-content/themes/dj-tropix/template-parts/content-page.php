<?php
/**
 * Template part for displaying page content.
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('py-12 px-4'); ?>>
    <?php if (get_the_title()) : ?>
        <header class="entry-header mb-8">
            <h1 class="text-3xl font-bold text-white entry-title"><?php the_title(); ?></h1>
        </header>
    <?php endif; ?>
    <div class="max-w-3xl mx-auto text-white entry-content prose prose-invert max-w-none">
        <?php the_content(); ?>
    </div>
</article>
