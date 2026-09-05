<?php
/**
 * Gallery section
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="gallery-section py-24 bg-black text-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-baseline justify-between mb-8">
            <div>
                <p class="text-sm tracking-[0.2em] uppercase text-orange-400 mb-2">
                    <?php esc_html_e('Gallery', 'dj-tropix'); ?>
                </p>
                <h2 class="text-3xl md:text-4xl font-bold">
                    <?php esc_html_e('Moments from the dancefloor', 'dj-tropix'); ?>
                </h2>
            </div>

            <?php if (is_active_sidebar('gallery-content')) : ?>
                <div class="hidden md:block text-sm text-gray-300 max-w-xs text-right">
                    <?php dynamic_sidebar('gallery-content'); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php
        $gallery_query = new WP_Query([
            'post_type'      => 'dj_gallery_item',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ]);
        ?>

        <?php if ($gallery_query->have_posts()) : ?>
            <div class="dj-gallery-grid" data-gallery>
                <?php
                while ($gallery_query->have_posts()) :
                    $gallery_query->the_post();
                    $image_id  = get_post_thumbnail_id();
                    $thumb_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium_large') : '';
                    $full_url  = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';

                    if (!$thumb_url) {
                        continue;
                    }
                    ?>
                    <figure class="dj-gallery-item" data-full="<?php echo esc_url($full_url ?: $thumb_url); ?>">
                        <div class="dj-gallery-image-wrapper">
                            <img
                                src="<?php echo esc_url($thumb_url); ?>"
                                alt="<?php echo esc_attr(get_the_title()); ?>"
                                class="dj-gallery-image"
                                loading="lazy"
                            >
                            <div class="dj-gallery-overlay">
                                <span class="dj-gallery-pill">
                                    <?php esc_html_e('View', 'dj-tropix'); ?>
                                </span>
                            </div>
                        </div>
                    </figure>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="text-gray-300">
                <h3 class="text-2xl font-semibold mb-3">
                    <?php esc_html_e('Gallery coming soon', 'dj-tropix'); ?>
                </h3>
                <p>
                    <?php esc_html_e('Add some Gallery Images in the dashboard to bring this section to life.', 'dj-tropix'); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>

