<?php
/**
 * Martino Martini Custom Button
 */
?>

<?php
// public function make_button(Array $args = [])
// {
//     # code...
// }
    if (!is_array($args) ) return;
    $defaults = array(
        'text' => 'Fai click!;)',
        'text_below' => '',
        'text_above' => '',
    
        'id' => 'XXXX',
        // 'tag' => 'a', // <a / button>
        'href' => '#TBD',
        'class' => 'button',
        'target' => '_blank',
        'variant' => 'md default',
        // 'size' => 'md',
        // 'variant' => $args['variant'] ?? $button_variant ?? 'primary',

        'button' => false,
        'post' => null,
        'onclick' => null,
        'disabled' => false,
        'attributes' => null,

    );

    $args = array_merge($defaults, $args);
    $isDefault = fn(String $key = '') => $args[$key] == $defaults[$key];

    // function btnGetAttrs(Bool $echo = true) 
    // {
    $attrs = '';
    if (!$isDefault('attributes') && is_array($args['attributes'])) {
        foreach ($args['attributes'] as $key => $value) {
            $attrs .= sprintf(' %s="%s"', $key, $value);
        }
        if (!$isDefault('disabled')) $attrs .= ' disabled';
    }
    //     return $echo ? echo $attrs : $attrs;
    // }

    $classes = $args['class'] . ' ' . $args['variant'];

    $content = '';
    if (!$isDefault('text_above')) $content .= sprintf('<div class="above">%s</div>', $args['text_above']); 
    $content .= sprintf('<div>%s</div>', $args['text']); 
    if (!$isDefault('text_below')) $content .= sprintf('<div class="below">%s</div>', $args['text_below']); 

    if (!isset($args['href']) || $isDefault('href')) {
        if (!$isDefault('button')) {


?>
<button id="<?php echo $args['id']; ?>" class="<?php echo $classes;?>"<?php 
    if (!$isDefault('onclick')) 
        printf(' onclick="%s"', $args['onclick']);
    echo $attrs;
    ?>><?php echo $content; ?></button>
<?php


        } else {
            if (!$isDefault('post')) {
                // $post
                $args['href'] = get_permalink();
            }


?>
<a id="<?php echo $args['id']; ?>" class="<?php echo $classes; ?>"<?php 
    printf(' href="%s"', $args['href']);
    if (!$isDefault('onclick')) printf(' onclick="%s"', $args['onclick']);
    printf(' target="%s"', $args['target']);
    echo $attrs;
    ?>><?php echo $content; ?></a>
<?php


        }
    }

?>
