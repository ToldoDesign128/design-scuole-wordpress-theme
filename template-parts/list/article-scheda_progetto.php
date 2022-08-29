<?php
global $post;

$image_url = get_the_post_thumbnail_url($post, "article-simple-thumb");
$class = dsi_get_post_types_color_class($post->post_type);
$icon = dsi_get_post_types_icon_class($post->post_type);


$excerpt =  dsi_get_meta("descrizione", "", $post->ID);
$anno_scolastico =  dsi_get_meta("anno_scolastico", "", $post->ID);
if(!$excerpt)
    $excerpt = get_the_excerpt($post);

$argomenti = dsi_get_argomenti_of_post();

?>
<div class="col-12 col-lg-3">
<article class="card card-bg card-article card-article-<?php echo $class; ?> cursorhand p-0" >
    <div class="card-body row p-0">
        
            <div class="card-thumb col-12 p-0">
                <img src="<?php echo $image_url; ?>" alt="" class="col-12">
				<div id="card_article_badge">
                <?php get_template_part("template-parts/common/ badges-argomenti"); ?>
				</div>
			</div>
        
        <div class="card-article-content"  id="card_article_content">
            <h2 class="h3"><a href="<?php echo get_permalink($post); ?>" aria-label="Apre <?php echo get_the_title($post); ?>"><?php echo get_the_title($post); ?></a></h2>

            <?php
            // recupero l'anno scolastico di riferimento del progetto
            if($anno_scolastico){
                ?>
                <i><small><?php _e("Anno scolastico", "design_scuole_italia"); ?> <?php echo dsi_convert_anno_scuola($anno_scolastico) ?></small></i>
                <?php
            }
            ?>
            <p><?php echo $excerpt; ?></p>
            <a href="<?php echo get_permalink($post); ?>"aria-label="Apre" class="btn btn-primary">Approfondisci</a>
        </div><!-- /card-avatar-content -->
    </div><!-- /card-body -->
</article><!-- /card card-bg card-article -->
</div>
