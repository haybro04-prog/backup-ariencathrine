<?php
/**
 * Contact section – "Get in Touch" layout with form [fluentform id="1"] + Connect With Me.
 * Content from Customizer → Contact Section.
 */

if (!defined('ABSPATH')) {
    exit;
}

$heading_white   = get_theme_mod('dj_contact_heading_white', 'Get in');
$heading_highlight = get_theme_mod('dj_contact_heading_highlight', 'Touch');
$subtitle        = get_theme_mod('dj_contact_subtitle', "Ready to book an unforgettable experience? Let's create magic together");
$connect_title   = get_theme_mod('dj_contact_connect_title', 'Connect With Me');
$connect_desc    = get_theme_mod('dj_contact_connect_desc', 'Follow my journey and stay updated on upcoming events, new mixes, and exclusive content.');
$instagram_url   = get_theme_mod('dj_contact_instagram_url', '#');
$instagram_label = get_theme_mod('dj_contact_instagram_label', 'ariencathrine');
$youtube_url     = get_theme_mod('dj_contact_youtube_url', '#');
$youtube_label   = get_theme_mod('dj_contact_youtube_label', 'arien cathrine');
$soundcloud_url  = get_theme_mod('dj_contact_soundcloud_url', '#');
$soundcloud_label = get_theme_mod('dj_contact_soundcloud_label', 'arien cathrine');
?>

<section class="dj-contact-section" id="contact">
    <div class="dj-contact-inner">
        <header class="dj-contact-header">
            <h2 class="dj-contact-title">
                <?php echo esc_html($heading_white); ?> <span class="dj-contact-title-highlight"><?php echo esc_html($heading_highlight); ?></span>
            </h2>
            <div class="dj-contact-underline" aria-hidden="true"></div>
            <?php if ($subtitle) : ?>
                <p class="dj-contact-subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </header>

        <div class="dj-contact-columns">
            <div class="dj-contact-form-col">
                <div class="dj-contact-form-widget">
                    <?php echo do_shortcode('[fluentform id="1"]'); ?>
                </div>
            </div>

            <div class="dj-contact-connect-col">
                <h3 class="dj-contact-connect-title"><?php echo esc_html($connect_title); ?></h3>
                <?php if ($connect_desc) : ?>
                    <p class="dj-contact-connect-desc"><?php echo esc_html($connect_desc); ?></p>
                <?php endif; ?>
                <div class="dj-contact-social-links">
                    <a href="<?php echo esc_url($instagram_url); ?>" class="dj-contact-social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($instagram_label); ?>">
                        <span class="dj-contact-social-icon"><?php echo dj_tropix_contact_social_icon_svg('instagram'); ?></span>
                        <span class="dj-contact-social-label"><?php echo esc_html($instagram_label); ?></span>
                    </a>
                    <a href="<?php echo esc_url($youtube_url); ?>" class="dj-contact-social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($youtube_label); ?>">
                        <span class="dj-contact-social-icon"><?php echo dj_tropix_contact_social_icon_svg('youtube'); ?></span>
                        <span class="dj-contact-social-label"><?php echo esc_html($youtube_label); ?></span>
                    </a>
                    <a href="<?php echo esc_url($soundcloud_url); ?>" class="dj-contact-social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($soundcloud_label); ?>">
                        <span class="dj-contact-social-icon"><?php echo dj_tropix_contact_social_icon_svg('soundcloud'); ?></span>
                        <span class="dj-contact-social-label"><?php echo esc_html($soundcloud_label); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

