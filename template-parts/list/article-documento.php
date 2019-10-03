<?php
global $post;

$image_url = get_the_post_thumbnail_url($post, "article-simple-thumb");
$class = dsi_get_post_types_color_class($post->post_type);
$icon = dsi_get_post_types_icon_class($post->post_type);


$excerpt =  dsi_get_meta("descrizione", "", $post->ID);
if(!$excerpt)
    $excerpt = get_the_excerpt($post);

$argomenti = dsi_get_argomenti_of_post();
$numerazione_albo =  dsi_get_meta("numerazione_albo", "", $post->ID);


$posizione_gps = false;

?>
<article class="card card-bg card-article card-article-<?php echo $class; ?>">
	<div class="card-body">
		<div class="card-article-img"  <?php if($image_url && !$posizione_gps) echo 'style="background-image: url(\''.$image_url.'\');"'; ?>>
			<a href="<?php the_permalink(); ?>">
				<div class="date">
					<span class="year"><?php echo date_i18n("Y", strtotime($post->post_date)); ?></span>
					<span class="day"><?php echo date_i18n("d", strtotime($post->post_date)); ?></span>
					<span class="month"><?php echo date_i18n("M", strtotime($post->post_date)); ?></span>
				</div>
			</a>
            <?php if(!$image_url){ ?>
            <svg class="icon-<?php echo $class; ?> svg-<?php echo $icon; ?>"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-<?php echo $icon; ?>"></use></svg>
            <?php } ?>

        </div>
		<div class="card-article-content">
            <?php if(dsi_is_albo($post)){ ?>
            <small class="h6 text-redbrown"><?php echo $numerazione_albo; ?></small>
            <?php if($post->post_status == "annullato"){ ?>
                    <span class="bg-redbrown p-1 ml-4"><?php _e("Annullato", "design_scuole_italia"); ?></span>
            <?php
            } else if($post->post_status == "scaduto"){ ?>
                    <span class="bg-redbrown p-1 ml-4"><?php _e("Scaduto", "design_scuole_italia"); ?></span>
                    <?php
                }
            } ?>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p><?php echo $excerpt; ?></p>
            <?php if(count($argomenti)) { ?>
			<div class="badges">
				<?php foreach ( $argomenti as $item ) { ?>
                    <a href="<?php echo get_term_link($item); ?>" title="<?php _e("Vai all'argomento", "design_scuole_italia"); ?>: <?php echo $item->name; ?>"
                       class="badge badge-sm badge-pill badge-outline-<?php echo $class; ?>"><?php echo $item->name; ?></a>
				<?php } ?>
			</div><!-- /badges -->
            <?php } ?>
		</div><!-- /card-avatar-content -->
	</div><!-- /card-body -->
</article><!-- /card card-bg card-article -->
<?php if($posizione_gps != false){ ?>
    <script>
        var mymap = L.map('map_<?php echo $post->ID; ?>', {
            zoomControl: false,
            scrollWheelZoom: false
        }).setView([<?php echo $posizione_gps["lat"]; ?>, <?php echo $posizione_gps["lng"]; ?>], 15);
        var marker = L.marker([<?php echo $posizione_gps["lat"]; ?>, <?php echo $posizione_gps["lng"]; ?>]).addTo(mymap);
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: '',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: '<?php echo dsi_get_mapbox_access_token(); ?>'
        }).addTo(mymap);
    </script>
<?php }  ?>