<?php
/**
 * Latest Mixes section – featured DJ mixes with YouTube players.
 */

if (!defined('ABSPATH')) {
    exit;
}

$heading  = __('Latest Mixes', 'dj-tropix');
$subtitle = __('Explore the latest sets and mixes crafted for your listening pleasure', 'dj-tropix');

// Get featured mixes (checkbox) ordered by date desc.
$mixes_query = new WP_Query([
    'post_type'      => 'dj_mix',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'meta_key'       => '_dj_mix_featured',
    'meta_value'     => '1',
    'orderby'        => 'date',
    'order'          => 'ASC', // Oldest to newest by publish date
]);

function dj_tropix_extract_youtube_id($url) {
    if (!$url) {
        return '';
    }
    // Match youtu.be/ID or youtube.com/watch?v=ID or /embed/ID
    if (preg_match('~youtu\.be/([^?&]+)~', $url, $m)) {
        return $m[1];
    }
    if (preg_match('~youtube\.com/watch\?v=([^&]+)~', $url, $m)) {
        return $m[1];
    }
    if (preg_match('~/embed/([^?&]+)~', $url, $m)) {
        return $m[1];
    }
    return '';
}

function dj_tropix_detect_mix_media_type($url) {
    if (!$url) {
        return '';
    }
    $u = strtolower(trim($url));
    if (strpos($u, 'youtube.com') !== false || strpos($u, 'youtu.be') !== false) {
        return 'youtube';
    }
    if (strpos($u, 'soundcloud.com') !== false) {
        return 'soundcloud';
    }
    if (strpos($u, 'mixcloud.com') !== false) {
        return 'mixcloud';
    }
    if (preg_match('~\.mp4(\?.*)?$~i', $u)) {
        return 'mp4';
    }
    return '';
}
?>

<section class="dj-mixes-section" id="mixes">
    <div class="dj-mixes-inner">
        <div class="dj-mixes-header">
            <h2 class="dj-mixes-title">
                <?php echo esc_html__('Latest', 'dj-tropix'); ?> <span><?php echo esc_html__('Mixes', 'dj-tropix'); ?></span>
            </h2>
            <div class="dj-mixes-underline"></div>
            <p class="dj-mixes-subtitle">
                <?php echo esc_html($subtitle); ?>
            </p>
        </div>

        <?php if ($mixes_query->have_posts()) : ?>
            <div class="dj-mixes-grid">
                <?php
                while ($mixes_query->have_posts()) :
                    $mixes_query->the_post();
                    $media_url  = get_post_meta(get_the_ID(), '_dj_mix_youtube_url', true);
                    $media_type = dj_tropix_detect_mix_media_type($media_url);
                    if (!$media_type) {
                        continue;
                    }

                    $video_id = '';
                    $thumb    = '';
                    // Use featured image if set, otherwise fallback to YouTube thumbnail or placeholder
                    if (has_post_thumbnail()) {
                        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    } elseif ($media_type === 'youtube') {
                        $video_id = dj_tropix_extract_youtube_id($media_url);
                        if (!$video_id) {
                            continue;
                        }
                        $thumb = 'https://img.youtube.com/vi/' . $video_id . '/hqdefault.jpg';
                    }
                    $location    = get_post_meta(get_the_ID(), '_dj_mix_location', true);
                    $mix_date    = get_post_meta(get_the_ID(), '_dj_mix_date', true);
                    $description = get_post_meta(get_the_ID(), '_dj_mix_description', true);
                    $date_label  = $mix_date ? date_i18n(get_option('date_format'), strtotime($mix_date)) : '';
                    ?>

                    <article
                        class="dj-mix-card"
                        data-media-type="<?php echo esc_attr($media_type); ?>"
                        data-media-url="<?php echo esc_url($media_url); ?>"
                        <?php if ($video_id) : ?>
                            data-youtube-id="<?php echo esc_attr($video_id); ?>"
                        <?php endif; ?>
                    >
                        <div class="dj-mix-banner">
                            <?php if ($thumb) : ?>
                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php else : ?>
                                <div class="dj-mix-placeholder" aria-hidden="true"></div>
                            <?php endif; ?>
                            <div class="dj-mix-overlay"></div>
                            <div class="dj-mix-play-button">
                                <button type="button" aria-label="<?php esc_attr_e('Play mix', 'dj-tropix'); ?>">
                                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="28" cy="28" r="28" fill="rgba(249,115,22,0.7)" />
                                        <polygon points="22,17 22,39 40,28" fill="rgba(255,255,255,0.7)" />
                                    </svg>
                                </button>
                            </div>
                            <iframe
                                class="dj-mix-embed dj-mix-iframe"
                                src="about:blank"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                title="<?php the_title_attribute(); ?>"
                            ></iframe>
                            <video class="dj-mix-embed dj-mix-video" controls playsinline preload="none">
                                <source src="" type="video/mp4">
                            </video>
                        </div>

                        <div class="dj-mix-meta">
                            <div class="dj-mix-meta-title"><?php the_title(); ?></div>
                            <?php if ($location) : ?>
                                <div class="dj-mix-meta-location"><?php echo esc_html($location); ?></div>
                            <?php endif; ?>
                            <?php if ($date_label) : ?>
                                <div class="dj-mix-meta-date"><?php echo esc_html($date_label); ?></div>
                            <?php endif; ?>
                            <?php if ($description) : ?>
                                <div class="dj-mix-meta-description"><?php echo esc_html($description); ?></div>
                            <?php endif; ?>
                        </div>
                    </article>

                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php else : ?>
            <p class="dj-events-empty">
                <?php esc_html_e('No featured mixes yet. Mark some mixes as featured to show them here.', 'dj-tropix'); ?>
            </p>
        <?php endif; ?>
    </div>
</section>

