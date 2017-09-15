=== Plugin Name ===
Contributors: jeffrey-wp
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SSNQMST6R28Q2
Tags: category, categories, media, library, medialibrary, image, images, media category, media categories
Requires at least: 3.1
Tested up to: 4.4
Stable tag: 2.1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds the ability to use categories in the media library.

== Description ==

Adds the ability to use categories in the WordPress Media Library. When activated a dropdown of categories will show up in the media library.
You can change the category of multiple items at once with bulk actions.

== Installation ==

For a manual installation via FTP:

1. Upload the 'wp-media-library-categories' directory to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' screen in your WordPress admin area
3. A dropdown of categories will show up in the media library


To upload the plugin through WordPress, instead of FTP:

1. Upload the zip file 'wp-media-library-categories-installable.zip' on the 'Add New' plugins screen (see the 'Upload' tab) in your WordPress admin area and activate.
2. Activate the plugin through the 'Plugins' screen in your WordPress admin area
3. A dropdown of categories will show up in the media library

== Frequently Asked Questions ==

= How to use separate categories for the WordPress Media Library (and don't use the same categories as in posts & pages)? =
By default the WordPress Media Library uses the same categories as WordPress does (such as in posts & pages). If you want to use separate categories for the WordPress Media Library add this code to the file functions.php located in your theme or child-theme:
Add this code to the file functions.php located in your theme or child-theme:
/**
* separate media categories from post categories
* use a custom category called 'category_media' for the categories in the media library
*/
add_filter( 'wpmediacategory_taxonomy', function(){ return 'category_media'; } ); //requires PHP 5.3 or newer

Or if you have an older PHP version:
add_filter( 'wpmediacategory_taxonomy', create_function( '', 'return "category_media";' ) );  //requires PHP 4.0.1 or newer


= How to use category in the [gallery] shortcode? =
To only show images from one category in the gallery you have to add the '`category`' parameter to the `[gallery]` shortcode.
The value passed to the '`category`' parameter can be either the `category slug` or the `term_id`, for example with the category slug:
`[gallery category="my-category-slug"]
Or with term_id:
[gallery category="14"]`
If you use an incorrect slug by default WordPress shows the images that are attached to the page / post that is displayed. If you use an incorrect term_id no images are shown. Aside from this behavior, the `[gallery]` shortcode works as it does by default with the built-in shortcode from WordPress ([see the WordPress gallery shortcode codex page](http://codex.wordpress.org/Gallery_Shortcode)). Some plugins that also use the gallery shortcode (like Jetpack) disable the category option on the gallery shortcode.


= I want to thank you, where can I make a donation? =
Maintaining a plugin and keeping it up to date is hard work. Please support me by making a donation. Thank you.
Please donate here:
https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SSNQMST6R28Q2