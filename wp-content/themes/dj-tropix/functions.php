<?php

if (!defined('ABSPATH')) {
    exit;
}

function dj_tropix_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 80,
        'flex-width'  => true,
        'flex-height' => true,
    ]);

    register_nav_menus([
        'primary' => __('Primary Menu', 'dj-tropix'),
    ]);
}
add_action('after_setup_theme', 'dj_tropix_theme_setup');

function dj_tropix_enqueue_assets() {
    $theme_version = wp_get_theme()->get('Version');

    // Main theme stylesheet (minimal, required by WP)
    wp_enqueue_style(
        'dj-tropix-style',
        get_stylesheet_uri(),
        [],
        $theme_version
    );

    // Custom compiled CSS from figma_sourcecode build
    $custom_css = get_template_directory_uri() . '/assets/app.css';
    wp_enqueue_style(
        'dj-tropix-app',
        $custom_css,
        ['dj-tropix-style'],
        $theme_version
    );

    wp_enqueue_style(
        'dj-tropix-hero',
        get_template_directory_uri() . '/assets/hero.css',
        ['dj-tropix-style'],
        $theme_version
    );

    wp_enqueue_style(
        'dj-tropix-about',
        get_template_directory_uri() . '/assets/about.css',
        ['dj-tropix-style'],
        $theme_version
    );

    wp_enqueue_style(
        'dj-tropix-events',
        get_template_directory_uri() . '/assets/events.css',
        ['dj-tropix-style'],
        $theme_version
    );

    wp_enqueue_style(
        'dj-tropix-mixes',
        get_template_directory_uri() . '/assets/mixes.css',
        ['dj-tropix-style'],
        $theme_version
    );

    wp_enqueue_style(
        'dj-tropix-gallery',
        get_template_directory_uri() . '/assets/gallery.css',
        ['dj-tropix-style'],
        $theme_version
    );

    wp_enqueue_style(
        'dj-tropix-header',
        get_template_directory_uri() . '/assets/header.css',
        ['dj-tropix-style'],
        $theme_version
    );

    wp_enqueue_style(
        'dj-tropix-contact',
        get_template_directory_uri() . '/assets/contact.css',
        ['dj-tropix-style'],
        $theme_version
    );

    wp_enqueue_style(
        'dj-tropix-first-event',
        get_template_directory_uri() . '/assets/first-event-bar.css',
        ['dj-tropix-style'],
        $theme_version
    );

    wp_enqueue_script(
        'dj-tropix-header',
        get_template_directory_uri() . '/assets/header.js',
        [],
        $theme_version,
        true
    );

    if (is_front_page()) {
        wp_enqueue_script(
            'dj-tropix-hero',
            get_template_directory_uri() . '/assets/hero.js',
            [],
            $theme_version,
            true
        );

        wp_enqueue_script(
            'dj-tropix-mixes',
            get_template_directory_uri() . '/assets/mixes.js',
            [],
            $theme_version,
            true
        );

        wp_enqueue_script(
            'dj-tropix-gallery',
            get_template_directory_uri() . '/assets/gallery.js',
            [],
            $theme_version,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'dj_tropix_enqueue_assets');

function dj_tropix_register_sidebars() {
    register_sidebar([
        'name'          => __('Hero Content', 'dj-tropix'),
        'id'            => 'hero-content',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => __('About Content', 'dj-tropix'),
        'id'            => 'about-content',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => __('Music Content', 'dj-tropix'),
        'id'            => 'music-content',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => __('Events Content', 'dj-tropix'),
        'id'            => 'events-content',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => __('Gallery Content', 'dj-tropix'),
        'id'            => 'gallery-content',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => __('Contact Content', 'dj-tropix'),
        'id'            => 'contact-content',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
}
add_action('widgets_init', 'dj_tropix_register_sidebars');

function dj_tropix_sanitize_link_or_hash($value) {
    $value = trim((string) $value);
    if ($value == '') {
        return '';
    }

    if (isset($value[0]) && $value[0] === '#') {
        $anchor = trim(substr($value, 1));
        if ($anchor === '') {
            return '#';
        }

        return '#' . sanitize_title($anchor);
    }

    return esc_url_raw($value);
}

function dj_tropix_escape_link_or_hash($value) {
    $value = trim((string) $value);
    if ($value == '') {
        return '#';
    }

    if (isset($value[0]) && $value[0] === '#') {
        $anchor = trim(substr($value, 1));
        if ($anchor === '') {
            return '#';
        }

        return '#' . sanitize_title($anchor);
    }

    return esc_url($value);
}

// --- Hero Banners (multiple header banners) ---
function dj_tropix_register_hero_banners() {
    register_post_type('dj_hero_banner', [
        'labels'             => [
            'name'               => __('Hero Banners', 'dj-tropix'),
            'singular_name'      => __('Hero Banner', 'dj-tropix'),
            'add_new'            => __('Add Banner', 'dj-tropix'),
            'add_new_item'       => __('Add New Hero Banner', 'dj-tropix'),
            'edit_item'          => __('Edit Hero Banner', 'dj-tropix'),
            'new_item'           => __('New Hero Banner', 'dj-tropix'),
            'view_item'          => __('View Hero Banner', 'dj-tropix'),
            'search_items'       => __('Search Hero Banners', 'dj-tropix'),
            'not_found'          => __('No hero banners found.', 'dj-tropix'),
            'not_found_in_trash' => __('No hero banners in trash.', 'dj-tropix'),
        ],
        'public'             => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-format-image',
        'menu_position'       => 21,
        'supports'            => ['title', 'thumbnail'],
        'has_archive'         => false,
        'rewrite'             => false,
    ]);
}
add_action('init', 'dj_tropix_register_hero_banners');

function dj_tropix_hero_banner_meta_boxes() {
    add_meta_box(
        'dj_hero_banner_content',
        __('Banner content (overlay text & buttons)', 'dj-tropix'),
        'dj_tropix_hero_banner_meta_box_cb',
        'dj_hero_banner',
        'normal'
    );
}

function dj_tropix_hero_banner_meta_box_cb($post) {
    wp_nonce_field('dj_hero_banner_save', 'dj_hero_banner_nonce');
    $tagline       = get_post_meta($post->ID, '_dj_hero_tagline', true) ?: '';
    $description   = get_post_meta($post->ID, '_dj_hero_description', true) ?: '';
    $btn1_text     = get_post_meta($post->ID, '_dj_hero_btn1_text', true) ?: __('Listen Now', 'dj-tropix');
    $btn1_url      = get_post_meta($post->ID, '_dj_hero_btn1_url', true) ?: '#mixes';
    $btn2_text     = get_post_meta($post->ID, '_dj_hero_btn2_text', true) ?: __('Book a Set', 'dj-tropix');
    $btn2_url      = get_post_meta($post->ID, '_dj_hero_btn2_url', true) ?: '#';
    ?>
    <p><label><strong><?php esc_html_e('Tagline (orange line)', 'dj-tropix'); ?></strong><br>
        <input type="text" name="dj_hero_tagline" value="<?php echo esc_attr($tagline); ?>" class="widefat" placeholder="<?php esc_attr_e("e.g. BALI'S PREMIER ELECTRONIC MUSIC ARTIST", 'dj-tropix'); ?>"></label></p>
    <p><label><strong><?php esc_html_e('Description', 'dj-tropix'); ?></strong><br>
        <textarea name="dj_hero_description" rows="3" class="widefat" placeholder="<?php esc_attr_e('Bringing tropical vibes and unforgettable beats to paradise', 'dj-tropix'); ?>"><?php echo esc_textarea($description); ?></textarea></label></p>
    <p><strong><?php esc_html_e('Button 1 (primary orange)', 'dj-tropix'); ?></strong><br>
        <input type="text" name="dj_hero_btn1_text" value="<?php echo esc_attr($btn1_text); ?>" placeholder="<?php esc_attr_e('Listen Now', 'dj-tropix'); ?>">
        <input type="text" name="dj_hero_btn1_url" value="<?php echo esc_attr($btn1_url); ?>" placeholder="#mixes or https://..." class="widefat"></p>
    <p><strong><?php esc_html_e('Button 2 (outline)', 'dj-tropix'); ?></strong><br>
        <input type="text" name="dj_hero_btn2_text" value="<?php echo esc_attr($btn2_text); ?>" placeholder="<?php esc_attr_e('Book a Set', 'dj-tropix'); ?>">
        <input type="text" name="dj_hero_btn2_url" value="<?php echo esc_attr($btn2_url); ?>" placeholder="#contact or https://..." class="widefat"></p>
    <p class="description"><?php esc_html_e('Banner image: set the Featured Image for this post. Title = main heading (e.g. DJ TROPIX). Order banners via the list (drag to reorder with a plugin) or by Publish date.', 'dj-tropix'); ?></p>
    <?php
}

function dj_tropix_hero_banner_save_meta($post_id) {
    if (!isset($_POST['dj_hero_banner_nonce']) || !wp_verify_nonce($_POST['dj_hero_banner_nonce'], 'dj_hero_banner_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    $fields = [
        'dj_hero_tagline'   => '_dj_hero_tagline',
        'dj_hero_description' => '_dj_hero_description',
        'dj_hero_btn1_text' => '_dj_hero_btn1_text',
        'dj_hero_btn1_url'  => '_dj_hero_btn1_url',
        'dj_hero_btn2_text' => '_dj_hero_btn2_text',
        'dj_hero_btn2_url'  => '_dj_hero_btn2_url',
    ];
    foreach ($fields as $input => $meta_key) {
        if (isset($_POST[$input])) {
            $value = in_array($input, ['dj_hero_btn1_url', 'dj_hero_btn2_url'], true)
                ? dj_tropix_sanitize_link_or_hash(wp_unslash($_POST[$input]))
                : sanitize_text_field(wp_unslash($_POST[$input]));
            update_post_meta($post_id, $meta_key, $value);
        }
    }
}
add_action('add_meta_boxes', 'dj_tropix_hero_banner_meta_boxes');
add_action('save_post_dj_hero_banner', 'dj_tropix_hero_banner_save_meta');

// --- DJ Events (schedule) ---
function dj_tropix_register_events() {
    register_post_type('dj_event', [
        'labels' => [
            'name'               => __('Events', 'dj-tropix'),
            'singular_name'      => __('Event', 'dj-tropix'),
            'add_new'            => __('Add Event', 'dj-tropix'),
            'add_new_item'       => __('Add New Event', 'dj-tropix'),
            'edit_item'          => __('Edit Event', 'dj-tropix'),
            'new_item'           => __('New Event', 'dj-tropix'),
            'view_item'          => __('View Event', 'dj-tropix'),
            'search_items'       => __('Search Events', 'dj-tropix'),
            'not_found'          => __('No events found.', 'dj-tropix'),
            'not_found_in_trash' => __('No events in trash.', 'dj-tropix'),
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-calendar-alt',
        'menu_position'=> 22,
        'supports'     => ['title', 'editor'],
        'has_archive'  => false,
        'rewrite'      => false,
    ]);
}
add_action('init', 'dj_tropix_register_events');

function dj_tropix_event_meta_boxes() {
    add_meta_box(
        'dj_event_details',
        __('Event details', 'dj-tropix'),
        'dj_tropix_event_meta_box_cb',
        'dj_event',
        'normal'
    );
}
add_action('add_meta_boxes', 'dj_tropix_event_meta_boxes');

function dj_tropix_event_meta_box_cb($post) {
    wp_nonce_field('dj_event_save', 'dj_event_nonce');

    $date        = get_post_meta($post->ID, '_dj_event_date', true) ?: '';
    $start_time  = get_post_meta($post->ID, '_dj_event_start_time', true) ?: '';
    $end_time    = get_post_meta($post->ID, '_dj_event_end_time', true) ?: '';
    $venue       = get_post_meta($post->ID, '_dj_event_venue', true) ?: '';
    $location    = get_post_meta($post->ID, '_dj_event_location', true) ?: '';
    $status      = get_post_meta($post->ID, '_dj_event_status', true) ?: '';
    $tickets_url = get_post_meta($post->ID, '_dj_event_tickets_url', true) ?: '';
    $tickets_label = get_post_meta($post->ID, '_dj_event_tickets_label', true) ?: __('Get Tickets', 'dj-tropix');
    ?>
    <p><label><strong><?php esc_html_e('Event date', 'dj-tropix'); ?></strong><br>
        <input type="date" name="dj_event_date" value="<?php echo esc_attr($date); ?>"></label>
    </p>
    <p><label><strong><?php esc_html_e('Start time', 'dj-tropix'); ?></strong><br>
        <input type="time" name="dj_event_start_time" value="<?php echo esc_attr($start_time); ?>"></label>
    </p>
    <p><label><strong><?php esc_html_e('End time', 'dj-tropix'); ?></strong><br>
        <input type="time" name="dj_event_end_time" value="<?php echo esc_attr($end_time); ?>"></label>
    </p>
    <p><label><strong><?php esc_html_e('Venue name', 'dj-tropix'); ?></strong><br>
        <input type="text" name="dj_event_venue" value="<?php echo esc_attr($venue); ?>" class="widefat" placeholder="<?php esc_attr_e('e.g. Sunset Sessions @ Potato Head', 'dj-tropix'); ?>"></label>
    </p>
    <p><label><strong><?php esc_html_e('Location', 'dj-tropix'); ?></strong><br>
        <input type="text" name="dj_event_location" value="<?php echo esc_attr($location); ?>" class="widefat" placeholder="<?php esc_attr_e('e.g. Seminyak, Bali', 'dj-tropix'); ?>"></label>
    </p>
    <p><label><strong><?php esc_html_e('Status label', 'dj-tropix'); ?></strong><br>
        <input type="text" name="dj_event_status" value="<?php echo esc_attr($status); ?>" class="widefat" placeholder="<?php esc_attr_e('e.g. Tickets Available / Almost Sold Out / VIP Available', 'dj-tropix'); ?>"></label>
    </p>
    <p><label><strong><?php esc_html_e('Tickets URL', 'dj-tropix'); ?></strong><br>
        <input type="url" name="dj_event_tickets_url" value="<?php echo esc_attr($tickets_url); ?>" class="widefat" placeholder="https://"></label>
    </p>
    <p><label><strong><?php esc_html_e('Tickets button label', 'dj-tropix'); ?></strong><br>
        <input type="text" name="dj_event_tickets_label" value="<?php echo esc_attr($tickets_label); ?>" class="widefat" placeholder="<?php esc_attr_e('Get Tickets', 'dj-tropix'); ?>"></label>
    </p>
    <?php
}

function dj_tropix_event_save_meta($post_id) {
    if (!isset($_POST['dj_event_nonce']) || !wp_verify_nonce($_POST['dj_event_nonce'], 'dj_event_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        'dj_event_date'          => '_dj_event_date',
        'dj_event_start_time'    => '_dj_event_start_time',
        'dj_event_end_time'      => '_dj_event_end_time',
        'dj_event_venue'         => '_dj_event_venue',
        'dj_event_location'      => '_dj_event_location',
        'dj_event_status'        => '_dj_event_status',
        'dj_event_tickets_url'   => '_dj_event_tickets_url',
        'dj_event_tickets_label' => '_dj_event_tickets_label',
    ];

    foreach ($fields as $input => $meta_key) {
        if (isset($_POST[$input])) {
            $value = 'dj_event_tickets_url' === $input ? esc_url_raw($_POST[$input]) : sanitize_text_field($_POST[$input]);
            update_post_meta($post_id, $meta_key, $value);
        }
    }
}
add_action('save_post_dj_event', 'dj_tropix_event_save_meta');

// --- DJ Mixes (Latest Mixes) ---
function dj_tropix_register_mixes() {
    register_post_type('dj_mix', [
        'labels' => [
            'name'               => __('Mixes', 'dj-tropix'),
            'singular_name'      => __('Mix', 'dj-tropix'),
            'add_new'            => __('Add Mix', 'dj-tropix'),
            'add_new_item'       => __('Add New Mix', 'dj-tropix'),
            'edit_item'          => __('Edit Mix', 'dj-tropix'),
            'new_item'           => __('New Mix', 'dj-tropix'),
            'view_item'          => __('View Mix', 'dj-tropix'),
            'search_items'       => __('Search Mixes', 'dj-tropix'),
            'not_found'          => __('No mixes found.', 'dj-tropix'),
            'not_found_in_trash' => __('No mixes in trash.', 'dj-tropix'),
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-playlist-audio',
        'menu_position'=> 23,
        'supports'     => ['title', 'editor', 'thumbnail'],
        'has_archive'  => false,
        'rewrite'      => false,
    ]);
}
add_action('init', 'dj_tropix_register_mixes');

function dj_tropix_mix_meta_boxes() {
    add_meta_box(
        'dj_mix_details',
        __('Mix details', 'dj-tropix'),
        'dj_tropix_mix_meta_box_cb',
        'dj_mix',
        'normal'
    );
}
add_action('add_meta_boxes', 'dj_tropix_mix_meta_boxes');

function dj_tropix_mix_meta_box_cb($post) {
    wp_nonce_field('dj_mix_save', 'dj_mix_nonce');

    $date        = get_post_meta($post->ID, '_dj_mix_date', true) ?: '';
    $location    = get_post_meta($post->ID, '_dj_mix_location', true) ?: '';
    $media_url = get_post_meta($post->ID, '_dj_mix_youtube_url', true) ?: '';
    $featured    = get_post_meta($post->ID, '_dj_mix_featured', true) === '1';
    $description = get_post_meta($post->ID, '_dj_mix_description', true) ?: '';
    ?>
    <p><label><strong><?php esc_html_e('Mix date', 'dj-tropix'); ?></strong><br>
        <input type="date" name="dj_mix_date" value="<?php echo esc_attr($date); ?>"></label>
    </p>
    <p><label><strong><?php esc_html_e('Location', 'dj-tropix'); ?></strong><br>
        <input type="text" name="dj_mix_location" value="<?php echo esc_attr($location); ?>" class="widefat" placeholder="<?php esc_attr_e('e.g. Bali, Live from Potato Head', 'dj-tropix'); ?>"></label>
    </p>
    <p><label><strong><?php esc_html_e('Media URL', 'dj-tropix'); ?></strong><br>
        <input type="url" name="dj_mix_youtube_url" value="<?php echo esc_attr($media_url); ?>" class="widefat" placeholder="https://... (YouTube / SoundCloud / Mixcloud / .mp4)"></label>
    </p>
    <p><label><input type="checkbox" name="dj_mix_featured" value="1" <?php checked($featured); ?>> <?php esc_html_e('Show this mix in the Latest Mixes section on the homepage', 'dj-tropix'); ?></label></p>
    <p><label><strong><?php esc_html_e('Short description (shown under title)', 'dj-tropix'); ?></strong><br>
        <textarea name="dj_mix_description" rows="3" class="widefat" placeholder="<?php esc_attr_e('Deep House / Tropical House set crafted for sunset vibes...', 'dj-tropix'); ?>"><?php echo esc_textarea($description); ?></textarea></label>
    </p>
    <?php
}

function dj_tropix_mix_save_meta($post_id) {
    if (!isset($_POST['dj_mix_nonce']) || !wp_verify_nonce($_POST['dj_mix_nonce'], 'dj_mix_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        'dj_mix_date'        => '_dj_mix_date',
        'dj_mix_location'    => '_dj_mix_location',
        'dj_mix_youtube_url' => '_dj_mix_youtube_url',
        'dj_mix_description' => '_dj_mix_description',
    ];

    foreach ($fields as $input => $meta_key) {
        if (isset($_POST[$input])) {
            $value = 'dj_mix_youtube_url' === $input ? esc_url_raw($_POST[$input]) : sanitize_text_field($_POST[$input]);
            update_post_meta($post_id, $meta_key, $value);
        }
    }

    // Checkbox: featured on front page
    $featured = isset($_POST['dj_mix_featured']) && $_POST['dj_mix_featured'] === '1' ? '1' : '0';
    update_post_meta($post_id, '_dj_mix_featured', $featured);
}
add_action('save_post_dj_mix', 'dj_tropix_mix_save_meta');

// --- DJ Gallery (image grid on homepage) ---
function dj_tropix_register_gallery_items() {
    register_post_type('dj_gallery_item', [
        'labels' => [
            'name'               => __('Gallery Images', 'dj-tropix'),
            'singular_name'      => __('Gallery Image', 'dj-tropix'),
            'add_new'            => __('Add Image', 'dj-tropix'),
            'add_new_item'       => __('Add New Gallery Image', 'dj-tropix'),
            'edit_item'          => __('Edit Gallery Image', 'dj-tropix'),
            'new_item'           => __('New Gallery Image', 'dj-tropix'),
            'view_item'          => __('View Gallery Image', 'dj-tropix'),
            'search_items'       => __('Search Gallery Images', 'dj-tropix'),
            'not_found'          => __('No gallery images found.', 'dj-tropix'),
            'not_found_in_trash' => __('No gallery images in trash.', 'dj-tropix'),
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-format-gallery',
        'menu_position'=> 24,
        'supports'     => ['title', 'thumbnail'],
        'has_archive'  => false,
        'rewrite'      => false,
    ]);
}
add_action('init', 'dj_tropix_register_gallery_items');

// --- Theme Customizer: Hero section (fallback when no banners) ---
function dj_tropix_customize_register($wp_customize) {
    $wp_customize->add_section('dj_tropix_hero', [
        'title'    => __('Hero Section (header)', 'dj-tropix'),
        'priority' => 30,
    ]);

    $wp_customize->add_setting('dj_hero_heading', ['default' => 'DJ TROPIX', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_hero_heading', [
        'label'   => __('Main heading', 'dj-tropix'),
        'section' => 'dj_tropix_hero',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('dj_hero_tagline', ['default' => "BALI'S PREMIER ELECTRONIC MUSIC ARTIST", 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_hero_tagline', [
        'label'   => __('Tagline (orange)', 'dj-tropix'),
        'section' => 'dj_tropix_hero',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('dj_hero_description', ['default' => 'Bringing tropical vibes and unforgettable beats to paradise', 'sanitize_callback' => 'sanitize_textarea_field']);
    $wp_customize->add_control('dj_hero_description', [
        'label'   => __('Description', 'dj-tropix'),
        'section' => 'dj_tropix_hero',
        'type'    => 'textarea',
    ]);

    $wp_customize->add_setting('dj_hero_btn1_text', ['default' => 'Listen Now', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_hero_btn1_text', ['label' => __('Button 1 text', 'dj-tropix'), 'section' => 'dj_tropix_hero', 'type' => 'text']);
    $wp_customize->add_setting('dj_hero_btn1_url', ['default' => '#mixes', 'sanitize_callback' => 'dj_tropix_sanitize_link_or_hash']);
    $wp_customize->add_control('dj_hero_btn1_url', ['label' => __('Button 1 link or #anchor', 'dj-tropix'), 'section' => 'dj_tropix_hero', 'type' => 'text']);

    $wp_customize->add_setting('dj_hero_btn2_text', ['default' => 'Book a Set', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_hero_btn2_text', ['label' => __('Button 2 text', 'dj-tropix'), 'section' => 'dj_tropix_hero', 'type' => 'text']);
    $wp_customize->add_setting('dj_hero_btn2_url', ['default' => '#', 'sanitize_callback' => 'dj_tropix_sanitize_link_or_hash']);
    $wp_customize->add_control('dj_hero_btn2_url', ['label' => __('Button 2 link or #anchor', 'dj-tropix'), 'section' => 'dj_tropix_hero', 'type' => 'text']);

    $wp_customize->add_setting('dj_hero_default_image', ['default' => 0, 'sanitize_callback' => 'absint']);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'dj_hero_default_image', [
        'label'     => __('Default banner image (when no banners or fallback)', 'dj-tropix'),
        'section'   => 'dj_tropix_hero',
        'mime_type' => 'image',
    ]));

    // --- About Section ---
    $wp_customize->add_section('dj_tropix_about', [
        'title'    => __('About Section', 'dj-tropix'),
        'priority' => 31,
    ]);

    $wp_customize->add_setting('dj_about_heading_prefix', ['default' => 'About', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_about_heading_prefix', [
        'label'   => __('Heading (first part)', 'dj-tropix'),
        'section' => 'dj_tropix_about',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('dj_about_heading_highlight', ['default' => 'DJ TROPIX', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_about_heading_highlight', [
        'label'   => __('Heading (orange part)', 'dj-tropix'),
        'section' => 'dj_tropix_about',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('dj_about_paragraph', [
        'default'           => "Born from the vibrant energy of Bali's nightlife, DJ TROPIX has become synonymous with unforgettable tropical house, deep house, and progressive beats. From intimate beach clubs to massive festival stages, every set is a journey through sound and emotion.",
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('dj_about_paragraph', [
        'label'   => __('Description paragraph', 'dj-tropix'),
        'section' => 'dj_tropix_about',
        'type'    => 'textarea',
    ]);

    $icons = ['music' => __('Music note', 'dj-tropix'), 'users' => __('People', 'dj-tropix'), 'trophy' => __('Trophy', 'dj-tropix'), 'sparkles' => __('Sparkles', 'dj-tropix')];
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('dj_about_stat' . $i . '_value', ['default' => ($i === 1 ? '500+' : ($i === 2 ? '100K+' : ($i === 3 ? '8+' : '50+'))), 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control('dj_about_stat' . $i . '_value', ['label' => sprintf(__('Stat %d – Number', 'dj-tropix'), $i), 'section' => 'dj_tropix_about', 'type' => 'text']);
        $wp_customize->add_setting('dj_about_stat' . $i . '_label', ['default' => ($i === 1 ? 'EVENTS PLAYED' : ($i === 2 ? 'HAPPY DANCERS' : ($i === 3 ? 'YEARS EXPERIENCE' : 'VENUES'))), 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control('dj_about_stat' . $i . '_label', ['label' => sprintf(__('Stat %d – Label', 'dj-tropix'), $i), 'section' => 'dj_tropix_about', 'type' => 'text']);
        $wp_customize->add_setting('dj_about_stat' . $i . '_icon', ['default' => array_keys($icons)[$i - 1], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control('dj_about_stat' . $i . '_icon', [
            'label'   => sprintf(__('Stat %d – Icon', 'dj-tropix'), $i),
            'section' => 'dj_tropix_about',
            'type'    => 'select',
            'choices' => $icons,
        ]);
    }

    // --- Events Section (schedule heading) ---
    $wp_customize->add_section('dj_tropix_events', [
        'title'    => __('Events Section', 'dj-tropix'),
        'priority' => 32,
    ]);

    $wp_customize->add_setting('dj_events_heading', ['default' => 'Upcoming Events', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_events_heading', [
        'label'   => __('Heading', 'dj-tropix'),
        'section' => 'dj_tropix_events',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('dj_events_subtitle', ['default' => 'Catch me live at these amazing venues across Bali', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_events_subtitle', [
        'label'   => __('Subtitle', 'dj-tropix'),
        'section' => 'dj_tropix_events',
        'type'    => 'text',
    ]);

    // --- Contact Section ---
    $wp_customize->add_section('dj_tropix_contact', [
        'title'    => __('Contact Section', 'dj-tropix'),
        'priority' => 33,
    ]);

    $wp_customize->add_setting('dj_contact_heading_white', ['default' => 'Get in', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_contact_heading_white', [
        'label'   => __('Heading (white part)', 'dj-tropix'),
        'section' => 'dj_tropix_contact',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('dj_contact_heading_highlight', ['default' => 'Touch', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_contact_heading_highlight', [
        'label'   => __('Heading (orange part)', 'dj-tropix'),
        'section' => 'dj_tropix_contact',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('dj_contact_subtitle', [
        'default'           => "Ready to book an unforgettable experience? Let's create magic together",
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('dj_contact_subtitle', [
        'label'   => __('Subtitle', 'dj-tropix'),
        'section' => 'dj_tropix_contact',
        'type'    => 'textarea',
    ]);

    $wp_customize->add_setting('dj_contact_connect_title', ['default' => 'Connect With Me', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_contact_connect_title', [
        'label'   => __('Right column – Title', 'dj-tropix'),
        'section' => 'dj_tropix_contact',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('dj_contact_connect_desc', [
        'default'           => 'Follow my journey and stay updated on upcoming events, new mixes, and exclusive content.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('dj_contact_connect_desc', [
        'label'   => __('Right column – Description', 'dj-tropix'),
        'section' => 'dj_tropix_contact',
        'type'    => 'textarea',
    ]);

    $wp_customize->add_setting('dj_contact_instagram_url', ['default' => '#', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('dj_contact_instagram_url', ['label' => __('Instagram URL', 'dj-tropix'), 'section' => 'dj_tropix_contact', 'type' => 'url']);
    $wp_customize->add_setting('dj_contact_instagram_label', ['default' => '@djtropix', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_contact_instagram_label', ['label' => __('Instagram label', 'dj-tropix'), 'section' => 'dj_tropix_contact', 'type' => 'text']);

    $wp_customize->add_setting('dj_contact_youtube_url', ['default' => '#', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('dj_contact_youtube_url', ['label' => __('YouTube URL', 'dj-tropix'), 'section' => 'dj_tropix_contact', 'type' => 'url']);
    $wp_customize->add_setting('dj_contact_youtube_label', ['default' => 'DJ TROPIX', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_contact_youtube_label', ['label' => __('YouTube label', 'dj-tropix'), 'section' => 'dj_tropix_contact', 'type' => 'text']);

    $wp_customize->add_setting('dj_contact_soundcloud_url', ['default' => '#', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('dj_contact_soundcloud_url', ['label' => __('SoundCloud URL', 'dj-tropix'), 'section' => 'dj_tropix_contact', 'type' => 'url']);
    $wp_customize->add_setting('dj_contact_soundcloud_label', ['default' => 'djtropix', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('dj_contact_soundcloud_label', ['label' => __('SoundCloud label', 'dj-tropix'), 'section' => 'dj_tropix_contact', 'type' => 'text']);
}
add_action('customize_register', 'dj_tropix_customize_register');

function dj_tropix_contact_social_icon_svg($network) {
    $icons = [
        'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.451" y1="6.5" y2="6.549"/></svg>',
        'youtube'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg>',
        'soundcloud' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 18a1 1 0 0 0 1-1V7a1 1 0 0 0-2 0v10a1 1 0 0 0 1 1Z"/><path d="M6 18a1 1 0 0 0 1-1V7a1 1 0 0 0-2 0v10a1 1 0 0 0 1 1Z"/><path d="M10 18a1 1 0 0 0 1-1v-4a1 1 0 0 0-2 0v4a1 1 0 0 0 1 1Z"/><path d="M14 18a1 1 0 0 0 1-1v-2a1 1 0 0 0-2 0v2a1 1 0 0 0 1 1Z"/><path d="M18 18a1 1 0 0 0 1-1V7a1 1 0 0 0-2 0v10a1 1 0 0 0 1 1Z"/><path d="M22 15v2a1 1 0 0 1-2 0v-2a1 1 0 0 1 2 0Z"/></svg>',
    ];
    return isset($icons[$network]) ? $icons[$network] : '';
}

function dj_tropix_about_icon_svg($icon) {
    $icons = [
        'music'    => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>',
        'users'    => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'trophy'   => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>',
        'sparkles' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></svg>',
    ];
    return isset($icons[$icon]) ? $icons[$icon] : $icons['music'];
}




/**
 * Remove 'Gallery' from the primary navigation menu.
 */
function dj_tropix_remove_gallery_item($items) {
    foreach ($items as $key => $item) {
        if (trim($item->title) == 'Gallery') {
            unset($items[$key]);
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'dj_tropix_remove_gallery_item');
