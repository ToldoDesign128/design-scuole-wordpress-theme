<?php
if (!is_array($args) ) return;
if (!isset($args['sections']) ) return;
if (!isset($args['labels']) ) return;
if (!isset($args['id']) ) $args['id'] = 'crsl';
if (!isset($args['limit']) ) $args['limit'] = 8;
$length = count($args['labels']);
if ($length > $args['limit']) $length = $args['limit'];
?>

<section class="carousel" style="height: 20rem; --grid-rows-num:<?php 
echo $length; 
?>;">
    <?php

    if (!is_bool($args['title']) ) 
    echo  '<h3>'.$args['title'].'</h3>';

    echo '<div></div>';

    $index=0;
    foreach ($args['sections'] as $key=>$value){
        if (!isset($args['labels'][$key])) continue;
        if ($index >= $args['limit']) break;
        ?>
        <!-- <?php echo $key; ?> -->
        <input type="radio" id="crsl-<?php echo $args['id']; ?>-<?php echo $index; ?>" name="crsl-<?php echo $args['id']; ?>" <?php 
            if (!$index) echo 'checked'; 
        ?>>
        <label for="crsl-<?php echo $args['id']; ?>-<?php echo $index; ?>">
            <?php echo $args['labels'][$key]; ?>
        </label> 
        <article>
            <?php echo $value; ?>
        </article>
        <?php
        $index++;
    }
    ?>
</section>
