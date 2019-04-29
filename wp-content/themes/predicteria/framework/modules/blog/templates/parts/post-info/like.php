<?php if(wellexpo_select_core_plugin_installed()) { ?>
    <div class="qodef-blog-like">
        <?php if( function_exists('wellexpo_select_get_like') ) wellexpo_select_get_like(); ?>
    </div>
<?php } ?>