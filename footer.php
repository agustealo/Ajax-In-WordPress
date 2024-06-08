    </div><!-- #content -->

<?php
$footer_layout = get_theme_mod('ajaxinwp_footer_layout', 'd-block');
?>
<div class="footer-area container-fluid">
    <footer id="colophon" class="site-footer <?php echo esc_attr($footer_layout); ?>" role="contentinfo">
        <div class="site-info row justify-content-center">
            <?php
            $footer_text = get_theme_mod('ajaxinwp_footer_text', '');
            if (!empty($footer_text)) {
                echo '<span class="footer-text col-auto">' . esc_html($footer_text) . '</span>';
            } else {
                echo '<a href="' . esc_url(__('https://wordpress.org/', 'ajaxinwp')) . '" class="col-auto">' . sprintf(esc_html__('Proudly powered by %s', 'ajaxinwp'), 'WordPress') . '</a>';
            }
            ?>
            <!-- Developer's copyright -->
            <span class="col-auto">
                &copy; <?php echo date('Y'); ?> <a href="https://agustealo.com" target="_blank">Zeus Eternal (Agustealo)</a>. All rights reserved.
            </span>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- .card-footer -->

<?php wp_footer(); ?>

</body>
</html>
