<?php
    
    // Border
    $border_style = sanitize_text_field(get_theme_mod('ajaxinwp_border_style', 'solid'));
    $border_width = absint(get_theme_mod('ajaxinwp_border_width', '1'));
    $border_color = sanitize_hex_color(get_theme_mod('ajaxinwp_border_color', '#dee2e6'));

    color: #e1eaf3