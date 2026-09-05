<?php
/**
 * Upcoming event bar – shown beneath the hero banner.
 * Displays only the first upcoming event.
 */

if (!defined('ABSPATH')) {
    exit;
}

$today = current_time('Y-m-d');
$events_query = new WP_Query([
    'post_type'      => 'dj_event',
    'post_status'    => 'publish',
    'posts_per_page' => 1,
    'meta_key'       => '_dj_event_date',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
    'meta_query'     => [
        [
            'key'     => '_dj_event_date',
            'value'   => $today,
            'compare' => '>=',
            'type'    => 'DATE',
        ],
    ],
]);

if (!$events_query->have_posts()) {
    return;
}
?>

<div class="dj-events-bar-wrap">
    <div class="dj-events-bar-rule" aria-hidden="true"></div>
    <?php
    $events_query->the_post();
    $event_id   = get_the_ID();
    $raw_date   = get_post_meta($event_id, '_dj_event_date', true);
    $start_time = get_post_meta($event_id, '_dj_event_start_time', true);
    $location   = get_post_meta($event_id, '_dj_event_location', true);
    $venue      = get_post_meta($event_id, '_dj_event_venue', true);

    $date_display = '';
    if ($raw_date && strtotime($raw_date)) {
        $date_display = strtoupper(date_i18n('M j', strtotime($raw_date)));
    }

    $time_display = '';
    if ($start_time && strtotime($start_time)) {
        $time_display = date_i18n('g:i A', strtotime($start_time));
    }

    $location_display = $location ?: $venue;
    ?>

    <div class="dj-events-bar-row">
        <?php if ($date_display) : ?>
            <span class="dj-ebar-date"><?php echo esc_html($date_display); ?></span>
            <span class="dj-ebar-sep" aria-hidden="true"></span>
        <?php endif; ?>

        <span class="dj-ebar-title"><?php the_title(); ?></span>

        <?php if ($location_display || $time_display) : ?>
            <span class="dj-ebar-sep dj-ebar-sep--right" aria-hidden="true"></span>
        <?php endif; ?>

        <?php if ($location_display) : ?>
            <span class="dj-ebar-meta dj-ebar-location">
                <svg class="dj-ebar-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                <?php echo esc_html($location_display); ?>
            </span>
        <?php endif; ?>

        <?php if ($location_display && $time_display) : ?>
            <span class="dj-ebar-sep" aria-hidden="true"></span>
        <?php endif; ?>

        <?php if ($time_display) : ?>
            <span class="dj-ebar-meta dj-ebar-time">
                <svg class="dj-ebar-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <?php echo esc_html($time_display); ?>
            </span>
        <?php endif; ?>
    </div>

    <?php wp_reset_postdata(); ?>

    <div class="dj-events-bar-rule" aria-hidden="true"></div>
</div>
