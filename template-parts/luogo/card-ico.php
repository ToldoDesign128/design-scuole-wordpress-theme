<?php
global $luogo, $tipologia_luogo, $struttura, $c, $locations;
$card_title = $luogo->post_title;
$id = 0;
// controllo se è un parent, in caso recupero i dati del genitore
if($luogo->post_parent == 0){
    $id = $luogo->ID;
    $posizione_gps = dsi_get_meta("posizione_gps", '_dsi_luogo_', $luogo->ID);
    $indirizzo = dsi_get_meta("indirizzo", '', $luogo->ID);
}else{
    $parent = get_post($luogo->post_parent);
    $id = $parent->ID;
    $posizione_gps = dsi_get_meta("posizione_gps", "_dsi_luogo_", $luogo->post_parent);
    $indirizzo = dsi_get_meta("indirizzo", "", $luogo->post_parent);
}

/*$locations[$posizione_gps['lat']."|".$posizione_gps['lng']][] = [
    'title' => $card_title,
    'lat' => $posizione_gps['lat'],
    'lng' => $posizione_gps['lng'],
    'indirizzo' => $indirizzo,
    'permalink' => get_permalink($luogo)
];*/
if (is_array($posizione_gps) && isset($posizione_gps['lat']) && isset($posizione_gps['lng'])) {

    $locations[$id][] = [
        'title' => $card_title,
        'lat' => $posizione_gps['lat'],
        'lng' => $posizione_gps['lng'],
        'indirizzo' => $indirizzo,
        'permalink' => get_permalink($luogo)
    ];
    ?>
<div class="card card-icon rounded mb-3 p-0">
    <a href="<?php echo get_permalink($luogo); ?>" aria-label="<?php echo 'Vedi scheda dell\'edificio ' .$tipologia_luogo->name . ' ' . $luogo->post_title .'' ?>">
        <div class="card-body p-0 pt-2">
            <svg class="icon svg-marker-simple"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-marker-simple"></use></svg>
            <div class="card-icon-content p-0">
                <p><strong><?php echo $card_title; ?></strong></p>
                <small><?php echo $indirizzo; ?></small>
            </div><!-- /card-icon-content -->
        </div><!-- /card-body -->
    </a>
</div>
<?php 
}
?>