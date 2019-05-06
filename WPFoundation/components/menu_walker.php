<?php
class wpf_nav_menu_walker extends Walker_Nav_Menu {
	private $curItemID;
	
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        //$output .= "\n$indent<div class=\"dropdown-pane expand\" id=\"nav-dropdown-$this->curItemID\" data-dropdown data-hover=\"true\" data-hover-pane=\"true\" data-position=\"bottom\">\n$indent<ul class=\"grid-x grid-padding-x small-up-1 medium-up-2 large-up-3\">\n";
        $output .= "\n$indent<ul class=\"menu vertical nested\">\n";
    }
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$this->curItemID = $item->ID;
		
		$indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array)$item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		$hasChildren = false;
		if( !empty($item->classes) && is_array($item->classes) && in_array('menu-item-has-children', $item->classes) ){
			$hasChildren = true;
		}
		
		//if ($depth != 0) $classes[] = 'cell'; // ADD Cell class to submenus

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

        //if ($args->has_children) $class_names .= ' dropdown';

       // if (in_array('current-menu-item', $classes))  $class_names .= ' active';
       if ($hasChildren && $depth === 0) $class_names .= ' has-submenu';

        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $prefix = $indent . '<li' . $id . $value . $class_names . '>';

        $atts = array();
        $atts['title'] = !empty($item->title) ? $item->title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';


        $atts['custom'] = !empty($item->custom) ? $item->custom : '';
		

        // If item has_children add atts to a.
        if ($hasChildren && $depth === 0) {
            $atts['href'] = !empty($item->url) ? $item->url : '#';;
            //$atts['data-toggle'] = 'nav-dropdown-'.$item->ID;
			
        } else {
            $atts['href'] = !empty($item->url) ? $item->url : '';
        }

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);


        $attributes = '';
        foreach ($atts as $attr => $value) {


            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;

        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= ($hasChildren && 0 === $depth) ? ' <span class="caret"></span></a>' : '</a>';
        $item_output .= $args->after;

        $output .= $prefix . apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    
	}
	
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        //$output .= "$indent</ul>\n</div>\n";
        $output .= "$indent</ul>\n";
    }
	
}
?>