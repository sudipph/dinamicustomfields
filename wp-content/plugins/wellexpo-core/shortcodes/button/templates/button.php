<button type="submit" <?php wellexpo_select_inline_style($button_styles); ?> <?php wellexpo_select_class_attribute($button_classes); ?> <?php echo wellexpo_select_get_inline_attrs($button_data); ?> <?php echo wellexpo_select_get_inline_attrs($button_custom_attrs); ?>>
    <span class="qodef-btn-text">
        <span class="qodef-btn-text-inner"><?php echo esc_html($text); ?></span>
        <?php  if ($type == 'solid' && $hover_type == 'svg-arrow') { ?>
            <svg class="qodef-svg-icon" x="0px" y="0px" viewBox="0 0 5 8.7" enable-background="new 0 0 5 8.7" xml:space="preserve" <?php wellexpo_select_inline_style($button_styles); ?>>
                <path d="M0.3,7.6l3.2-3.3L0.3,1.1C0,0.8,0,0.6,0.3,0.3c0.3-0.3,0.5-0.3,0.8,0L4.7,4c0.1,0.1,0.2,0.2,0.2,0.4c0,0.2-0.1,0.3-0.2,0.4 
                        L1.1,8.4c-0.3,0.3-0.5,0.3-0.8,0C0,8.2,0,7.9,0.3,7.6z"/>
            </svg>
        <?php } ?>
    </span>
    <?php echo wellexpo_select_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>