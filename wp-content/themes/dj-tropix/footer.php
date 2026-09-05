<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<footer class="site-footer text-white">
    <?php if (is_active_sidebar('contact-content')) : ?>
        <section class="contact-section">
            <?php dynamic_sidebar('contact-content'); ?>
        </section>
    <?php endif; ?>

    <div class="footer-inner text-center py-6">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

