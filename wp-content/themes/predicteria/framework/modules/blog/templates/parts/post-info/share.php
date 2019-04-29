<?php
$share_type = isset($share_type) ? $share_type : 'dropdown';
?>
<?php if(wellexpo_select_options()->getOptionValue('enable_social_share') === 'yes' && wellexpo_select_options()->getOptionValue('enable_social_share_on_post') === 'yes') { ?>
    <div class="qodef-blog-share">
        <?php echo wellexpo_select_get_social_share_html(array('type' => $share_type)); ?>
    </div>
<?php } ?>