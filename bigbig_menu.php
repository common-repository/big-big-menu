<?php
/*
Plugin Name: Big Big Menu
Plugin URI: http://www.bigbigtech.com/wordpress-plugins/big-big-menu/
Description: Big Big Menu provides a simple Admin interface for creating and re-ordering the main navigation menu on your blog.
Version: 0.1.1
Author: Jason Tremblay
Author URI: http://www.alertmybanjos.com
*/

/*  Copyright 2008  Jason Tremblay  (email : info@bigbigtech.com) */

/* ----------------------------------------
* SET 'EM UP
* ----------------------------------------*/
define(BIGBIG_MENU_URL, get_bloginfo('url').'/wp-content/plugins/bigbig_menu');


/* ----------------------------------------
* DO IT WITH CLASS
* ----------------------------------------*/
class BigBig_Menu
{
	function BigBig_Menu()
	{
		/* ----------------------------------------
		* MAKE IT WORK WITH ACTION HOOKS
		* add_action ( 'hook_name', 'your_function_name', [priority], [accepted_args] );
		* ----------------------------------------*/
		if ('plugin' == get_option('bigbig_menu_whichcss')) {
			add_action('wp_head', array("BigBig_Menu","public_css"));
		}
		if ('templatetag' != get_option('bigbig_menu_insertmethod')) {
			add_action('wp_list_pages', array("BigBig_Menu","list_pages"));
		}
	}
	
	// Return the menu
	function get_menu($args = array())
	{
		global $wpdb;
		
		// DEFAULTS
		$id = 'BigBigMenu';
		$class = 'bigbigmenu';
		$ul = TRUE;
		
		// OVERRIDE DEFAULTS
		extract($args);
		
		// GET AN ARRAY OF AVAILABLE PAGES
		$include_home = get_option('bigbig_menu_home');
		$menu_saved = get_option('bigbig_menu_order');
		$orientation = get_option('bigbig_menu_orientation');
		$bigbig_menu = '';
		if ($ul) $bigbig_menu .= '<ul class="'.$class.'" id="'.$id.'">';
		if ($include_home) {
			$bigbig_menu .= '<li class="'.$orientation.' menu-item home-item '.(is_home() ? 'menu-item-active' : '').'"><a title="Home" href="'.get_bloginfo('url').'">Home</a></li>';
		}
		foreach ($menu_saved as $item) {
			$item['class'] = array();
			switch ($item['type']) {
				case 'category':
					$item['object'] = get_category($item['id']);
					$item['object']->ID = $item['object']->term_id;
					$item['display'] = $item['object']->name;
					$item['link'] = get_category_link($item['object']->ID);
					if (is_category($item['object']->ID)) { // category itself
						array_push($item['class'], 'menu-item-active');
					}
					if (cat_is_ancestor_of($item['object']->ID, $GLOBALS['cat'])) { // ancestor category
						array_push($item['class'], 'menu-item-active');
					}
					if (is_post() && in_category($item['object']->ID)) { // post in category
						array_push($item['class'], 'menu-item-active');
					}
					break;
				case 'page':
					$item['object'] = get_page($item['id']);
					$item['display'] = $item['object']->post_title;
					$item['link'] = get_page_link($item['object']->ID);
					if (is_page($item['object']->ID)) {
						array_push($item['class'], 'menu-item-active');
					}
					// JT: NEED A post_is_ancestor_of() function
					break;
				case 'author':
					$item['object'] = new WP_User($item['id']);
					$item['display'] = $item['object']->display_name;
					$item['link'] = get_author_posts_url($item['object']->ID);
					if (is_author($item['object']->ID)) {
						array_push($item['class'], 'menu-item-active');
					}
					break;
				case 'link':
					$item['object'] = get_bookmark($item['id']);
					$item['display'] = $item['object']->link_name;
					$item['link'] = $item['object']->link_url;
					break;
			}
			array_push($item['class'], 'menu-item');
			if ($item['object']) {
				$bigbig_menu .= "<li class=\"$orientation ".implode(' ', $item['class'])."\"><a href=\"{$item['link']}\">{$item['display']}</a></li>";
			}
		}
		if ($ul) $bigbig_menu .= '</ul>';

		return $bigbig_menu;
	}
	
	// Output the CSS for a public page
	function public_css()
	{
		$data = array('plugin_url' => BIGBIG_MENU_URL);
		BigBig_Menu::display('public-css', $data);
	}
	
	// Filter for list_pages
	function list_pages($input)
	{
		return self::get_menu(array('ul' => FALSE));
	}
	
	// Display a view
	function display($view, $data = array())
	{
		extract($data);
		include(dirname(__FILE__)."/views/$view.php");
	}
	
}


class BigBig_Menu_AJAX extends BigBig_Menu
{
	function BigBig_Menu_AJAX()
	{
		// PARENT CONSTRUCTOR
		parent::BigBig_Menu();
		
		/* ----------------------------------------
		* MAKE IT WORK WITH ACTION HOOKS
		* add_action ( 'hook_name', 'your_function_name', [priority], [accepted_args] );
		* ----------------------------------------*/
		add_action('wp_ajax_bigbig_menu_ajax_update_menu_order', array("BigBig_Menu_AJAX","update_menu_order"));
		add_action('wp_ajax_bigbig_menu_ajax_toggle_home', array("BigBig_Menu_AJAX","toggle_home"));
		add_action('wp_ajax_bigbig_menu_ajax_set_insertmethod', array("BigBig_Menu_AJAX","set_insertmethod"));
		add_action('wp_ajax_bigbig_menu_ajax_set_orientation', array("BigBig_Menu_AJAX","set_orientation"));
		add_action('wp_ajax_bigbig_menu_ajax_set_whichcss', array("BigBig_Menu_AJAX","set_whichcss"));
	}
	
	// Update the menu from submitted value
	function update_menu_order()
	{
		$bigbig_menu_order = urldecode($_POST['bigbig_menu_order']);
		$bigbig_menu_order = explode(',',$bigbig_menu_order);
		foreach($bigbig_menu_order as $k => $v) {
			list($type, $id) = explode('-', $v);
			$bigbig_menu_order[$k] = array(
				'type' => $type,
				'id' => $id
			);
		}
		update_option('bigbig_menu_order', $bigbig_menu_order);
		exit('1');
	}
	
	// Toggle the home link on or off
	function toggle_home()
	{
		update_option('bigbig_menu_home', (int) $_POST['bigbig_menu_home']);
		exit('1');
	}
	
	// Set insert method
	function set_insertmethod()
	{
		update_option('bigbig_menu_insertmethod', $_POST['bigbig_menu_insertmethod']);
		exit('1');
	}
	
	// Set orientation
	function set_orientation()
	{
		update_option('bigbig_menu_orientation', $_POST['bigbig_menu_orientation']);
		exit('1');
	}
	
	// Set whichcss
	function set_whichcss()
	{
		update_option('bigbig_menu_whichcss', $_POST['bigbig_menu_whichcss']);
		exit('1');
	}
}


class BigBig_Menu_Admin extends BigBig_Menu
{
	// Constructor
	function BigBig_Menu_Admin()
	{
		// PARENT CONSTRUCTOR
		parent::BigBig_Menu();
		
		/* ----------------------------------------
		* MAKE IT WORK WITH ACTION HOOKS
		* add_action ( 'hook_name', 'your_function_name', [priority], [accepted_args] );
		* ----------------------------------------*/
		// hook the setup action to the admin_menu
		// after we add the management page, we'll add all the plugin-specific stuff
		add_action('admin_menu', array("BigBig_Menu_Admin","setup"));
	}
	
	// Setup the plugin
	function setup()
	{
		// add the management page, and use the page hook to add plugin-specific stuff
		$pagehook = add_management_page('Big Big Menu Management', 'Big Big Menu', 8, 'bigbig_menu', array("BigBig_Menu_Admin","page"));
		add_action("admin_print_scripts-$pagehook", array("BigBig_Menu_Admin","enqueue_js"));
		add_action("admin_head-$pagehook", array("BigBig_Menu_Admin","page_css"));
		add_action("admin_head-$pagehook", array("BigBig_Menu_Admin","page_js"));
	}
	
	// Router for the menu admin page
	function page()
	{
		// if form posted
		if ($_GET['sort_order']) {
			BigBig_Menu_Admin::update_menu($_GET['sort_order']);
		} else {
			BigBig_Menu_Admin::page_form();
		}
	}
	
	// Enqueue needed javascript libraries
	function enqueue_js()
	{
		wp_enqueue_script('prototype');
		wp_enqueue_script('scriptaculous');
		wp_enqueue_script('jquery-ui-tabs');
	}
	
	// Output the CSS for the admin page
	function page_css()
	{
		$data = array('plugin_url' => BIGBIG_MENU_URL);
		BigBig_Menu_Admin::display('admin-css', $data);
	}
	
	// Output the JS for the admin page
	function page_js()
	{
		$data = array('plugin_url' => BIGBIG_MENU_URL);
		BigBig_Menu_Admin::display('admin-js', $data);
	}
	
	// Output the menu "form" page
	function page_form()
	{
		global $wpdb;
		
		// GET HOME LINK SETTING
		$home = get_option('bigbig_menu_home');
		
		// GET AN ARRAY OF AVAILABLE PAGES
		$menu_found = array();
		$menu_saved = get_option('bigbig_menu_order');
		if ($menu_saved) {
			foreach ($menu_saved as $item) {
				switch ($item['type']) {
					case 'category':
						$item['slug'] = 'category-'.$item['id'];
						$item['object'] = get_category($item['id']);
						$item['display'] = $item['object']->name;
						break;
					case 'page':
						$item['slug'] = 'page-'.$item['id'];
						$item['object'] = get_page($item['id']);
						$item['display'] = $item['object']->post_title;
						break;
					case 'author':
						$item['slug'] = 'author-'.$item['id'];
						$item['object'] = new WP_User($item['id']);
						$item['display'] = $item['object']->display_name;
						break;
					case 'link':
						$item['slug'] = 'link-'.$item['id'];
						$item['object'] = get_bookmark($item['id']);
						$item['display'] = $item['object']->link_name;
						break;
				}
				if ($item['object']) {
					$menu_found[] = $item;
				}
			}
		}
		
		$pages = get_pages();
		$categories = get_categories('hide_empty=0');
		$authors = (array) $wpdb->get_results("SELECT ID, display_name from $wpdb->users ORDER BY display_name ASC");
		$links = get_bookmarks();
		
		// PREPARE OTHER OPTIONS FOR DISPLAY
		if (!$orientation = get_option('bigbig_menu_orientation'))
			$orientation = 'horiz';
		if (!$insertmethod = get_option('bigbig_menu_insertmethod'))
			$insertmethod = 'listpages';
		if (!$whichcss = get_option('bigbig_menu_whichcss'))
			$whichcss = 'plugin';
		
		$data = array(
			'home' => $home,
			'menu' => $menu_found,
			'pages' => $pages,
			'categories' => $categories,
			'authors' => $authors,
			'links' => $links,
			'orientation' => $orientation,
			'insertmethod' => $insertmethod,
			'whichcss' => $whichcss
		);
		BigBig_Menu_Admin::display('admin-page', $data);
	}
	
}


/* --------------------------------------------------
* LOAD AJAX, ADMIN OR FRONTEND CONTROLLER
* --------------------------------------------------*/
if (strpos($_SERVER['REQUEST_URI'], 'admin-ajax') !== false) {
	$bigbigmenu = new BigBig_Menu_AJAX();
} elseif (strpos($_SERVER['REQUEST_URI'], 'wp-admin') !== false) {
	$bigbigmenu = new BigBig_Menu_Admin();
} else {
	$bigbigmenu = new BigBig_Menu();
}


// PLUGIN INITIALIZATION....

// IN SEM GOOGLE ANALYTICS, THEY CALL A STATIC INIT FUNCTION
// INSTEAD OF INSTANTIATING THE CLASS
// BigBig_Menu::init();

// GOOGLE SITEMAP GENERATOR DOES SOMETHING SIMILAR
// Check if ABSPATH and WPINC is defined, this is done in wp-settings.php
// If not defined, we can't guarante that all required functions are available.
// if(defined('ABSPATH') && defined('WPINC')) {
//	 add_action("init",array("GoogleSitemapGenerator","Enable"),1000,0);
// }


/* ----------------------------------------
* SHOW ME YOUR TEMPLATE FUNCTIONS
* ----------------------------------------*/
// Output the menu
function bigbig_menu($args = array())
{
	echo get_bigbig_menu($args);
}

// Return the menu
function get_bigbig_menu($args = array())
{
	global $bigbigmenu;
	return $bigbigmenu->get_menu($args);
}


?>
