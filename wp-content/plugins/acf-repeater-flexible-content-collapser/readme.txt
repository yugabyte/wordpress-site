=== ACF Repeater & Flexible Content Collapser ===
Contributors: tmconnect
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=XMLKD8H84HXB4&lc=US&item_name=Donation%20for%20WordPress%20Plugins&no_note=0&cn=Add%20a%20message%3a&no_shipping=1&currency_code=EUR
Tags: acf, acfpro, advanced custom fields, repeater, flexible content, collapse, expand 
Requires at least: 4.7
Tested up to: 4.9.5
Stable tag: 1.2.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Collapse and expand ACF Repeater and Flexible Content fields all at once to get a better overview and enable easier sorting.

== Description ==

If there are a lot of rows within a Repeater or Flexible Content field, you need to scroll a lot to get to the field you want to edit and it is not easy to find the right one. Also, it is difficult to change the order of the rows.

The ACF Repeater & Flexible Content Collapser plugin solves this problem and add a button to collapse or expand all rows at once.

**ACF Repeater & Flexible Content Collapser works in Repeater and Flexible Content Fields and even if they are nested. And the plugin works in all layout modes - no matter whether it is a table, block or row layout.**

After plugin activation you get additional settings when you create an ACF Repeater or Flexible Content field.

You can specify whether all fields of this field group are automatically collapsed when the page is loaded. And you can choose whether the button is only displayed with an icon or with the icon and a text.

**This plugin works with the [ACF PRO](https://www.advancedcustomfields.com/pro/) (version 5.5.0 or higher) *AND* [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) (version 5.7.0 or higher with either the Flexible Content Field or Repeater Field add-on).**

= Localizations =
* English
* Deutsch


== Installation ==

1. Upload the `acf-repeater-flexible-content-collapser` folder to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done!


== Frequently Asked Questions ==

= After collapsing Repeater fields, I can't expand a single repeater row =

This is because ACF adds collapsing/expanding functions of a repeater row only if a sub field is specified in the settings of the repeater field to show when row is collapsed.

If there's no sub field set in the *Collapsed* setting for the repeater field you can't expand/collapse a single row.

I don't know, if this is a feature or a bug and reported this in the [ACF support forum](https://support.advancedcustomfields.com/forums/topic/please-make-the-repeater-collapse-icon-available/ "Show thread").

In some cases, you may not have a field that should be displayed in the collapsed state. There's a workaround to solve this problem:

1. Create a text field in the repeater, doesn’t matter what you call it
1. Set this field as the field to show
1. Delete the field you just created and selected
1. Save the field group

Unfortunately, this bug does not seem to be fixed in the near future:
*"This needs to be repeated whenever you modify the field group, and it’s probably not a good idea to depend on bugs, but I’m guessing that this one isn’t going to be corrected any time soon, especially if no one reports it since it not breaking anything."*


== Screenshots ==

1. Additional settings for Repeater and Flexible content fields
2. Works even if Repeater and Flexible Content fields are nested and in all layout modes


== Changelog ==

= v1.2.3 =
* Optimized code to show collapse button

= v1.2.2 =
* Optimized for ACF Free version

= v1.2.1 =
* Fixed: Class wrapper is no longer overwritten

= v1.2.0 =
* Added option to show/hide the collapse button in field settings

= v1.1.0 =
* Changed class name to prevent future conflicts with ACF

= v1.0.2 =
* Update "Tested up to" version.
* Fixed z-index of toggle button.

= v1.0.1 =
* Fixed CSS of toggle button for new ACF 5.6.

= v1.0.0 =
* Initial release of this plugin, tested and stable.