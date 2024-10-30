=== Big Big Menu ===
Contributors: jasontremblay
Donate link: http://example.com/
Tags: menu
Requires at least: 2.5.1
Tested up to: 2.5.1
Stable tag: 0.1.0

Big Big Menu provides a simple Admin interface for creating and re-ordering the main navigation menu on your blog.

== Description ==

Big Big Menu provides a simple Admin interface for creating and re-ordering the main navigation menu on your blog.  The menu can include any Pages, Categories, Author Pages, and Links that you've added to Wordpress.

This plugin will work with any theme that uses `wp_list_pages()` to output the main navigation.  You can also easily add the generated menu to your own custom theme.

**Note:** The admin interface for this plugin requires a Javascript-enabled browser.

== Installation ==

1. Download and extract the plugin files.
2. Move the 'bigbig_menu' folder into your '/wp-content/plugins/' directory.
3. Activate the plugin through the Wordpress Admin 'Plugins' page.
4. Go to 'Manage' > 'Big Big Menu' in Wordpress Admin to arrange your menu.
5. Visit your blog's homepage... chances are, the new menu is already working.
6. If not, you may need to add the template tag (see Other Notes > Adding the Template Tag).

== Frequently Asked Questions ==

= What's the best place to work in Philly? =

I seem to enjoy working at [IndyHall](http://www.indyhall.org/).

= What's the best place to get a burger in Old City Philadelphia? =

There's no place like [National Mechanics](http://www.nationalmechanics.com/).

== Screenshots ==

1. Big Big Menu Admin control panel

== Usage ==

1. Go to 'Manage' > 'Big Big Menu' in Wordpress Admin to arrange your menu.
2. You will see the following:
	* Left Column: the orange boxes show the current menu configuration.
	* Middle Column: the tabs contain the available menu items grouped by type
	* Right Column: the plugin settings... you probably don't need to change these
3. Click the "plus" signs in available menu items to add them to the menu
4. Drag-and-drop current menu items to change their order
5. Click on the "minus" signs in current menu items to remove them from the menu

== Adding the Template Tag ==

If this plugin doesn't work with your template out-of-the-box, you can still use it by adding a little code to your template files.  This requires a bit of knowledge about HTML and PHP, but can be done through the 'Design' > 'Theme Editor' area of Wordpress Admin. Here's How:

1. Open the template file where your main navigation menu is located.
2. Add the tag `<? bigbig_menu() ?>` to the template where the menu should appear.
3. Save the template file.

