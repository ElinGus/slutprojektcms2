<?php
// Läser in stylesheets och scripts
function my_theme_enqueues() {
  wp_enqueue_script('jQuery');
  wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/bulma-carousel.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'accordionscript', get_stylesheet_directory_uri() . '/js/bulma-accordion.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'aosJS', get_stylesheet_directory_uri() . '/js/aos.js', array( 'jquery' ), false, true );
  wp_enqueue_style( 'bulma', get_stylesheet_directory_uri() . '/bulma-0.7.2/css/bulma.min.css' );
  wp_enqueue_style( 'carouselcss', get_stylesheet_directory_uri() . '/css/bulma-carousel.min.css' );
  wp_enqueue_style( 'accordioncss', get_stylesheet_directory_uri() . '/css/bulma-accordion.min.css' );
  wp_enqueue_style( 'aosCSS', get_stylesheet_directory_uri() . '/css/aos.css' );
  wp_enqueue_style( 'css', get_stylesheet_directory_uri() . '/style.css' );
  wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.css' );
}
    add_action( 'wp_enqueue_scripts', 'my_theme_enqueues' );

// Registrerar meny
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => ('Header menu'),
    )
  );
}
    add_action('init', 'register_my_menus');

// Options page för header och footer
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
}

// Läser in thumbnail på poster
add_theme_support('post-thumbnails');

// Kod för sidebar
function wpdocs_theme_slug_widgets_init() {
  register_sidebar( array(
      'name'          => __( 'Main Sidebar', 'textdomain' ),
      'id'            => 'sidebar-1',
      'description'   => __( 'Widgets här kommer synas i sidokolumnen', 'textdomain' ),
      'before_widget' => '<li id="%1$s" class="widget %2$s">',
      'after_widget'  => '</li>',
      'before_title'  => '<h2 class="widgettitle">',
      'after_title'   => '</h2>',
  ) );
  }
    add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );

// Kod för att ändra 'read more' på excerpts på blogginlägg
function modify_read_more_link() {
  return '<a class="more-link" href="' . get_permalink() . '">Läs mer</a>';
}
    add_filter( 'the_content_more_link', 'modify_read_more_link' );

//Custom post types - stores
function stores() {
  $postType = 'stores';

  $storeLabels = array(
    'name' => 'Stores',
    'add_new' => 'New store',
  );
  $supports = array(
    'title',
    'editor',
    'thumbnail',
  );
  $argument = array(
    'label' => 'Stores',
    'labels' => $storeLabels,
    'description' => 'Stores post type',
    'public' => true,
    'menu_position' => 5,
    'supports' => $supports,
    'has_archive' => true,
  );

  register_post_type($postType, $argument);
}

add_action('init', 'stores');

// Byta ut text i Sale-knapp till Rea på Woocommerce produktsida
add_filter( 'woocommerce_sale_flash', 'wc_custom_replace_sale_text' );
  function wc_custom_replace_sale_text( $html ) {
    return str_replace( __( 'Sale!', 'woocommerce' ), __( 'Rea!', 'woocommerce' ), $html );
  }

//För kategorisidan woocommerce
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

    add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

/** ----------------NAVBAR----------------------**/
/**
 * @package bulmascores
 */
/**
 * Class Name: Bulmascores_Nav_Walker
 * Author: Seyong Cho
 */
class Bulmascores_Nav_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '';
    }
    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '';
    }
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        if ($this->hasChildren($item)) {
            $output .= $this->startDropdownButton($item);
        } else {
            $output .= $this->getLinkButton($item);
        }
    }
    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        if ($this->hasChildren($item)) {
            $output .= $this->endDropdownButton($item);
        } else {
            $output .= '';
        }
    }
    public function hasChildren($item)
    {
        if (in_array("menu-item-has-children", $item->classes)) {
            return true;
        }
        return false;
    }
    public function getLinkButton($item)
    {
        $url         = $item->url ?? '';
        $classes     = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = '';

        if (in_array('current-menu-item', $classes)) {
            $class_names .= 'is-active';
        }
        $button = sprintf("<a href='%s' class='navbar-item %s'>%s</a>", $url, $class_names, $item->title);
        return $button;
    }
    public function startDropdownButton($item)
    {
        $url         = $item->url ?? '';
        $classes     = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = '';
        if (in_array('current-menu-item', $classes)) {
            $class_names .= 'is-active';
        }
        $button = sprintf("<a href='%s' class='navbar-link %s'>%s</a>", $url, $class_names, $item->title);
        $dropdown = sprintf("<div class='navbar-item has-dropdown is-hoverable'>%s", $button);
        $dropdown .= "<div class='navbar-dropdown is-boxed'>";
        return $dropdown;
    }
    public function endDropdownButton($item)
    {
        return "</div></div>";
    }
}

/* --- my account, yasmine --*/
add_filter ( 'woocommerce_account_menu_items', 'misha_remove_my_account_links' );
function misha_remove_my_account_links( $menu_links ){
  unset( $menu_links['dashboard'] ); // remove Dashboard from my account menu
	//unset( $menu_links['payment-methods'] ); // remove Payment Methods from my account menu
  unset( $menu_links['downloads'] ); //remove downloads from my account menu

	return $menu_links;
}

?>
