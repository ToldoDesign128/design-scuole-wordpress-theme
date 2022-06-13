
<?php
/**
 * Nav Menu API: Header_Walker_Nav_Menu class
 *
 * @package WordPress
 * @subpackage Nav_Menus
 * @since 4.6.0
 */

/**
 * Custom class used to implement an HTML list of nav menu items.
 *
 * @since 3.0.0
 *
 * @see Walker
 */

class Footer_Menu_Walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
		$output .= "<li>";

		if ($item->post_name == 'privacy-policy' || $item->post_name == 'dichiarazione-di-accessibilita') { 
			$custom_id = $item->post_name == 'privacy-policy' 
			? 'privacy-policy' 
			: 'dichiarazione-accessibilita';
			if ($item->url) {
				$output .= '<a class="text-underline-hover" href="' . $item->url . '" aria-label="Vai alla pagina ' . $item->title . '" id="'.$custom_id.'">';
			} else {
				$output .= '<a class="text-underline-hover" href="#" id="'.$custom_id.'">';
			}
		} else {
			if ($item->url) {
				$output .= '<a class="text-underline-hover" href="' . $item->url . '" aria-label="Vai alla pagina ' . $item->title . '">';
			} else {
				$output .= '<a class="text-underline-hover" href="#">';
			}
		}
 
		$output .= $item->title;
        
        $output .= '</a>';

		$output .= "</li>";
	}
}