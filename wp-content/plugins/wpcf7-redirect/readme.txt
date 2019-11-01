=== Contact Form 7 Redirection ===
Tags: contact form 7 redirect, contact form 7 thank you page, redirect cf7, redirect contact form 7, contact form 7 success page, cf7 redirect
Contributors: yuvalsabar
Requires at least: 4.7.0
Tested up to: 5.0
Stable tag: 1.2.9
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

A simple add-on for Contact Form 7 that adds a redirect option after form sent successfully.

== Description ==

A straightforward add-on plugin for Contact Form 7 - adds the option to redirect to any page you choose after mail sent successfully, with DOM Events and without AJAX being disabled.
NOTE: This plugin requires Contact Form 7 version 4.8 or later. 

== Usage ==

Simply go to your form settings, choose the "Redirect Settings" tab and set the page you want to be redirected to.

== Installation ==

Installing Contact Form 7 Redirection can be done either by searching for "Contact Form 7 Redirection" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org.
2. Upload the ZIP file through the "Plugins > Add New > Upload" screen in your WordPress dashboard.
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Visit the settings screen and configure, as desired.

== Frequently Asked Questions ==

= Does the plugin disables Contact Form 7 Ajax? =

No, it doesn't. The plugin does not disables any of Contact Form 7 normal behavior, unlike all other plugins that do the same.

= Does this plugin uses "on_sent_ok" additional setting? =

No. One of the reasons we developed this plugin, is because on_send_ok is now deprecated, and is going to be abolished by the end of 2017. This plugin is the only redirect plugin for Contact Form 7 that has been updated to use [DOM events](https://contactform7.com/dom-events/) to perform redirect, as Contact Form 7 developer Takayuki Miyoshi recommends. 

== Screenshots ==

1. Redirect Settings tab

== Changelog ==

= 1.2.9 =
* Fixed a bug: when passing specific fields as URL query parameters, not all the fields were passed.

= 1.2.8 =
* New feature: Pass specific fields from the form as URL query parameters.
* Minor dev improvements.

= 1.2.7 =
* Script field now accepts special characters, such as < and >. 

= 1.2.6 =
* Added support for browsers that don't support AJAX.
* Minor CSS changes.

= 1.2.5 =
* Added error message if Contact Form 7 version is earlier than 4.8.

= 1.2.4 =
* Fixed a bug regarding sanitizing URL, causing & to change to #038;
* Unnecessary variables removed.

= 1.2.2 =
* New feature: Pass all fields from the form as URL query parameters.
* Minor CSS changes.
* Dev improvements.

= 1.2 =
* Added option to add script after the form has been sent successfully.

= 1.0.2 =
* Added full support for form duplication.
* Added option to open page in a new tab.
* Added plugin class CF7_Redirect.

= 1.0.0 =
* Initial release.