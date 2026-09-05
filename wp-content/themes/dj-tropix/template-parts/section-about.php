<?php
/**
 * About section – content from Customizer (Appearance → Customize → About Section).
 */

if (!defined('ABSPATH')) {
    exit;
}

$heading_prefix   = get_theme_mod('dj_about_heading_prefix', 'About');
$heading_highlight = get_theme_mod('dj_about_heading_highlight', 'DJ TROPIX');
$paragraph        = get_theme_mod('dj_about_paragraph', "Born from the vibrant energy of Bali's nightlife, DJ TROPIX has become synonymous with unforgettable tropical house, deep house, and progressive beats. From intimate beach clubs to massive festival stages, every set is a journey through sound and emotion.");

$stats = [];
for ($i = 1; $i <= 4; $i++) {
    $stats[] = [
        'value' => get_theme_mod('dj_about_stat' . $i . '_value', $i === 1 ? '500+' : ($i === 2 ? '100K+' : ($i === 3 ? '8+' : '50+'))),
        'label' => get_theme_mod('dj_about_stat' . $i . '_label', $i === 1 ? 'EVENTS PLAYED' : ($i === 2 ? 'HAPPY DANCERS' : ($i === 3 ? 'YEARS EXPERIENCE' : 'VENUES'))),
        'icon'  => get_theme_mod('dj_about_stat' . $i . '_icon', $i === 1 ? 'music' : ($i === 2 ? 'users' : ($i === 3 ? 'trophy' : 'sparkles'))),
    ];
}
?>

<section class="dj-about-section" id="about">
    <div class="dj-about-dots" aria-hidden="true"></div>
    <div class="dj-about-inner">
        <h2 class="dj-about-title">
            <?php echo esc_html($heading_prefix); ?> <span class="dj-about-title-highlight"><?php echo esc_html($heading_highlight); ?></span>
        </h2>
        <div class="dj-about-underline"></div>
        <?php if ($paragraph) : ?>
            <p class="dj-about-paragraph"><?php echo esc_html($paragraph); ?></p>
        <?php endif; ?>

        <div class="dj-about-stats">
            <?php foreach ($stats as $stat) : ?>
                <div class="dj-about-stat">
                    <div class="dj-about-stat-icon dj-about-stat-icon--<?php echo esc_attr($stat['icon']); ?>" aria-hidden="true">
                        <?php echo dj_tropix_about_icon_svg($stat['icon']); ?>
                    </div>
                    <div class="dj-about-stat-value"><?php echo esc_html($stat['value']); ?></div>
                    <div class="dj-about-stat-label"><?php echo esc_html($stat['label']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
