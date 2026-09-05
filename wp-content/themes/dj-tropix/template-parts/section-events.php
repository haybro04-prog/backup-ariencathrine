<?php
/**
 * Events section – upcoming DJ schedule from DJ Events CPT.
 */

if (!defined('ABSPATH')) {
    exit;
}

$heading  = get_theme_mod('dj_events_heading', 'Upcoming Events');
$subtitle = get_theme_mod('dj_events_subtitle', 'Catch me live at these amazing venues across Bali');

$today = current_time('Y-m-d');

$events_query = new WP_Query([
    'post_type'      => 'dj_event',
    'post_status'    => 'publish',
    'posts_per_page' => 4,
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
?>

<section class="dj-events-section" id="events">
    <div class="dj-events-inner">
        <div class="dj-events-header">
            <h2 class="dj-events-title"><?php echo esc_html($heading); ?></h2>
            <div class="dj-events-underline"></div>
            <?php if ($subtitle) : ?>
                <p class="dj-events-subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>

        <div class="dj-events-2col">
            <div class="dj-events-maincol">
                <?php
                // Get all upcoming events
                $all_events = [];
                if ($events_query->have_posts()) {
                    while ($events_query->have_posts()) {
                        $events_query->the_post();
                        $all_events[] = [
                            'ID' => get_the_ID(),
                            'title' => get_the_title(),
                            'date' => get_post_meta(get_the_ID(), '_dj_event_date', true),
                            'start_time' => get_post_meta(get_the_ID(), '_dj_event_start_time', true),
                            'end_time' => get_post_meta(get_the_ID(), '_dj_event_end_time', true),
                            'venue' => get_post_meta(get_the_ID(), '_dj_event_venue', true),
                            'location' => get_post_meta(get_the_ID(), '_dj_event_location', true),
                            'status' => get_post_meta(get_the_ID(), '_dj_event_status', true),
                            'tickets_url' => get_post_meta(get_the_ID(), '_dj_event_tickets_url', true),
                            'tickets_label' => get_post_meta(get_the_ID(), '_dj_event_tickets_label', true) ?: __('Get Tickets', 'dj-tropix'),
                        ];
                    }
                    wp_reset_postdata();
                }

                // Next Show (soonest event)
                $next_show = !empty($all_events) ? $all_events[0] : null;
                $upcoming_events = array_slice($all_events, 1);
                ?>

                <?php if ($next_show) : ?>
                <div class="dj-next-show-card">
                    <div class="dj-next-show-bg"><!-- Optionally add a background image here --></div>
                    <div class="dj-next-show-content">
                        <div class="dj-next-show-label">Next Show</div>
                        <div class="dj-next-show-flex">
                            <div class="dj-next-show-left">
                                <h3 class="dj-next-show-title"><?php echo esc_html($next_show['title']); ?></h3>
                                <div class="dj-next-show-meta">
                                    <div><span class="dj-next-show-meta-label">Location:</span> <?php echo esc_html($next_show['location']); ?></div>
                                    <div><span class="dj-next-show-meta-label">Date:</span> <?php echo esc_html(date_i18n('F j, Y', strtotime($next_show['date']))); ?></div>
                                    <div><span class="dj-next-show-meta-label">Time:</span> 11PM - Late</div>
                                </div>
                                <?php if ($next_show['tickets_url']) : ?>
                                    <a class="dj-next-show-tickets-btn" href="<?php echo esc_url($next_show['tickets_url']); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($next_show['tickets_label']); ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="dj-next-show-right">
                                <?php
                                // Days countdown calculation
                                $days_left = '';
                                if ($next_show['date']) {
                                    $event_ts = strtotime($next_show['date']);
                                    $now_ts = strtotime(current_time('Y-m-d'));
                                    $days_left = ($event_ts - $now_ts) / 86400;
                                    $days_left = $days_left >= 0 ? ceil($days_left) : 0;
                                }
                                ?>
                                <?php if ($days_left !== '') : ?>
                                <div class="dj-next-show-countdown-circle">
                                    <div class="dj-next-show-countdown-number"><?php echo esc_html($days_left); ?></div>
                                    <div class="dj-next-show-countdown-label">DAYS</div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <h3 class="dj-upcoming-events-title">Upcoming Events</h3>
                <div class="dj-upcoming-events-list">
                    <?php if (!empty($upcoming_events)) : ?>
                        <?php foreach ($upcoming_events as $event) : ?>
                            <div class="dj-upcoming-event-card">
                                <div class="dj-upcoming-event-date-left">
                                    <span class="dj-upcoming-event-day"><?php echo esc_html(date_i18n('j', strtotime($event['date']))); ?></span>
                                    <span class="dj-upcoming-event-month"><?php echo esc_html(strtoupper(date_i18n('M', strtotime($event['date'])))); ?></span>
                                </div>
                                <div class="dj-upcoming-event-info">
                                    <div class="dj-upcoming-event-title"><?php echo esc_html($event['title']); ?></div>
                                </div>
                                <div class="dj-upcoming-event-meta-right">
                                    <?php if ($event['location']) : ?><span><?php echo esc_html($event['location']); ?></span><?php endif; ?>
                                    <span class="dj-upcoming-event-time">11PM - Late</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="dj-upcoming-event-empty">No more upcoming events.</div>
                    <?php endif; ?>
                </div>
            </div>
            <aside class="dj-events-sidebar">
                <h3 class="dj-played-at-title">Played At</h3>
                <div class="dj-played-at-list">
                    <div class="dj-played-at-card">
                        <div class="dj-played-at-thumb" style="background-image:url('https://example.com/venue1.jpg');"></div>
                        <div class="dj-played-at-info">
                            <div class="dj-played-at-venue">Red Ruby</div>
                            <div class="dj-played-at-meta">Bali, Indonesia</div>
                        </div>
                    </div>
</div>
                <a class="dj-played-at-all-btn" href="#">View All Venues</a>
            </aside>
        </div>
    </div>





