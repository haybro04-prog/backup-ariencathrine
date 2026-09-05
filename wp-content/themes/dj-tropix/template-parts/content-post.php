<?php
/**
 * Template part for displaying post content.
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('py-12 px-4'); ?>>
    <header class="entry-header mb-8">
        <h1 class="text-3xl font-bold text-white entry-title">
            <a href="<?php the_permalink(); ?>" class="text-white hover:underline"><?php the_title(); ?></a>
        </h1>
        <div class="text-gray-400 text-sm mt-2">
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo get_the_date(); ?></time>
        </div>
    </header>
    <div class="max-w-3xl mx-auto text-white entry-content prose prose-invert max-w-none">
        <?php the_content(); ?>
    </div>
</article>
