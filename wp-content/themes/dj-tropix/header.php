<?php
if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen bg-black'); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="site-header-inner">
        <div class="site-branding">
            <a class="site-branding-link" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php endif; ?>
                <span class="site-title"><?php bloginfo('name'); ?></span>
            </a>
        </div>
        <nav class="primary-nav" aria-label="<?php esc_attr_e('Primary menu', 'dj-tropix'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'primary-menu',
                'fallback_cb'    => false,
            ]);
            ?>
        </nav>
    </div>
</header>

