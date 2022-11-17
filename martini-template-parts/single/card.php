<?php
global $post;
$image = $args['image'];
// var_dump($post);
// var_dump($args);
if (!$image && (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
    $image = get_the_post_thumbnail($post->ID);
}
// var_dump($image);
$add_badge = $args['add_badge'] ?? true;
$add_btn = $args['add_btn'] ?? true;
$title = $args['title'] ?? get_the_title($post);
$content = $args['content'] ?? (dsi_get_meta("descrizione", "", $post->ID) 
? dsi_get_meta("descrizione", "", $post->ID) 
: get_the_excerpt($post)); 
$link = $args['href'] ?? get_permalink($post);
$btn_text = $args['btn_text'] ?? 'Scopri';
?>
<div class="martini-card">
	<div class="martini-card__body">
        <div class="martini-card__body__image">
            <?php if($image) { ?>
                <?php echo $image; ?>
            <?php  } ?>
            <?php if($add_badge) { ?>
            <div class="martini-card__body__image__badge">
                <?php get_template_part("template-parts/common/badges-argomenti"); ?>
            </div>
            <?php  } ?>
        </div>
        <div class="martini-card__body__content">
            <h3><a href="<?php echo $link; ?>"><?php echo get_the_title($post); ?></a></h3>
            <p><?php echo $content; ?></p>
            <?php if($add_btn) { ?>
            <!-- <a class="btn-lg-default-outline"> -->
            <a class="btn-mini-default" href="<?php echo $link; ?>">
                <button><?php echo $btn_text; ?></button>
            </a>
            <?php  } ?>
        </div>
	</div>
</div>