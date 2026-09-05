<?php
/**
 * Hero section: multiple banners from CPT or fallback from Customizer.
 * All content editable in admin: Hero Banners + Appearance → Customize → Hero Section.
 */

if (!defined('ABSPATH')) {
    exit;
}

$banners = get_posts([
    'post_type'      => 'dj_hero_banner',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC',
]);

$use_slider = count($banners) > 0;
$default_heading     = get_theme_mod('dj_hero_heading', 'DJ TROPIX');
$default_tagline     = get_theme_mod('dj_hero_tagline', "BALI'S PREMIER ELECTRONIC MUSIC ARTIST");
$default_description = get_theme_mod('dj_hero_description', 'Bringing tropical vibes and unforgettable beats to paradise');
$default_btn1_text   = get_theme_mod('dj_hero_btn1_text', 'Listen Now');
$default_btn1_url    = get_theme_mod('dj_hero_btn1_url', '#mixes');
$default_btn2_text   = get_theme_mod('dj_hero_btn2_text', 'Book a Set');
$default_btn2_url    = get_theme_mod('dj_hero_btn2_url', '#');
$default_image_id   = get_theme_mod('dj_hero_default_image', 0);
?>

<section class="dj-hero-section dj-hero-section--<?php echo $use_slider ? 'slider' : 'single'; ?>" id="hero">
    <?php if ($use_slider) : ?>
        <div class="dj-hero-slider">
            <?php foreach ($banners as $index => $post) : setup_postdata($post);
                $img_id   = get_post_thumbnail_id($post->ID);
                $heading  = get_the_title($post->ID) ?: $default_heading;
                $tagline  = get_post_meta($post->ID, '_dj_hero_tagline', true) ?: $default_tagline;
                $desc     = get_post_meta($post->ID, '_dj_hero_description', true) ?: $default_description;
                $btn1_t   = get_post_meta($post->ID, '_dj_hero_btn1_text', true) ?: $default_btn1_text;
                $btn1_u   = get_post_meta($post->ID, '_dj_hero_btn1_url', true) ?: $default_btn1_url;
                $btn2_t   = get_post_meta($post->ID, '_dj_hero_btn2_text', true) ?: $default_btn2_text;
                $btn2_u   = get_post_meta($post->ID, '_dj_hero_btn2_url', true) ?: $default_btn2_url;
                $slide_id = 'hero-slide-' . $post->ID;
            ?>
                <div class="dj-hero-slide <?php echo $index === 0 ? 'is-active' : ''; ?>" data-slide-index="<?php echo (int) $index; ?>">
                    <div class="dj-hero-bg">
                        <?php if ($img_id) : ?>
                            <?php echo wp_get_attachment_image($img_id, 'full', false, ['class' => 'dj-hero-bg-image']); ?>
                        <?php elseif ($default_image_id) : ?>
                            <?php echo wp_get_attachment_image($default_image_id, 'full', false, ['class' => 'dj-hero-bg-image']); ?>
                        <?php endif; ?>
                        <div class="dj-hero-overlay"></div>
                    </div>
                    <div class="dj-hero-inner">
                        <h1 class="dj-hero-title"><?php echo esc_html($heading); ?></h1>
                        <p class="dj-hero-tagline"><?php echo esc_html($tagline); ?></p>
                        <?php if ($desc) : ?>
                            <p class="dj-hero-description"><?php echo esc_html($desc); ?></p>
                        <?php endif; ?>
                        <div class="dj-hero-buttons">
                            <a href="<?php echo esc_attr(dj_tropix_escape_link_or_hash($btn1_u)); ?>" class="dj-hero-btn dj-hero-btn--primary"><?php echo esc_html($btn1_t); ?></a>
                            <a href="<?php echo esc_attr(dj_tropix_escape_link_or_hash($btn2_u)); ?>" class="dj-hero-btn dj-hero-btn--secondary"><?php echo esc_html($btn2_t); ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        <?php if (count($banners) > 1) : ?>
            <div class="dj-hero-dots" aria-hidden="true">
                <?php foreach ($banners as $i => $p) : ?>
                    <button type="button" class="dj-hero-dot <?php echo $i === 0 ? 'is-active' : ''; ?>" data-slide="<?php echo (int) $i; ?>" aria-label="<?php esc_attr_e('Go to slide', 'dj-tropix'); ?> <?php echo (int) $i + 1; ?>"></button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="dj-hero-slide is-active">
            <div class="dj-hero-bg">
                <?php if ($default_image_id) : ?>
                    <?php echo wp_get_attachment_image($default_image_id, 'full', false, ['class' => 'dj-hero-bg-image']); ?>
                <?php endif; ?>
                <div class="dj-hero-overlay"></div>
            </div>
            <div class="dj-hero-inner">
                <h1 class="dj-hero-title"><?php echo esc_html($default_heading); ?></h1>
                <p class="dj-hero-tagline"><?php echo esc_html($default_tagline); ?></p>
                <p class="dj-hero-description"><?php echo esc_html($default_description); ?></p>
                <div class="dj-hero-buttons">
                    <a href="<?php echo esc_attr(dj_tropix_escape_link_or_hash($default_btn1_url)); ?>" class="dj-hero-btn dj-hero-btn--primary"><?php echo esc_html($default_btn1_text); ?></a>
                    <a href="<?php echo esc_attr(dj_tropix_escape_link_or_hash($default_btn2_url)); ?>" class="dj-hero-btn dj-hero-btn--secondary"><?php echo esc_html($default_btn2_text); ?></a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="dj-hero-scroll" aria-hidden="true">
        <span>↓ <?php esc_html_e('SCROLL', 'dj-tropix'); ?></span>
    </div>
</section>
