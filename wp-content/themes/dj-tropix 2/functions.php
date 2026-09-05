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

