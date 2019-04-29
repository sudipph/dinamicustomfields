<?php
$post_classes[] = 'qodef-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="qodef-post-content">
        <div class="qodef-post-heading">
            <?php wellexpo_select_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
        </div>
        <div class="qodef-post-text">
            <div class="qodef-post-text-inner">
                <div class="qodef-post-info-top">
                    <?php wellexpo_select_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                </div>
                <div class="qodef-post-text-main">
                    <?php wellexpo_select_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php wellexpo_select_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                </div>
                <div class="qodef-post-info-bottom clearfix">
                    <div class="qodef-post-info-bottom-left">
                        <?php wellexpo_select_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                        <?php wellexpo_select_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                        <?php wellexpo_select_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    </div>
                    <div class="qodef-post-info-bottom-right">
                        <?php wellexpo_select_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>