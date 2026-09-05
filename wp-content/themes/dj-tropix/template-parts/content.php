<?php
/**
 * Template part for displaying post/page content in the loop.
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('py-12 px-4'); ?>>
    <div class="max-w-3xl mx-auto text-white entry-content">
        <?php the_content(); ?>
    </div>
</article>
