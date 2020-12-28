=== Redirection for Contact Form 7 ===
Tags: contact form 7 redirect, contact form 7 thank you page, redirect cf7, redirect contact form 7, contact form 7 success page, cf7 redirect
Contributors: yuvalsabar
Requires at least: 4.7.0
Tested up to: 5.2.2
Stable tag: 1.3.5
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

A simple add-on for Contact Form 7 that adds a redirect option after form sent successfully.

== Description ==

A straightforward add-on plugin for Contact Form 7 - adds the option to redirect to any page you choose after mail sent successfully, with DOM Events and without AJAX being disabled.
NOTE: This plugin requires Contact Form 7 version 4.8 or later. 

== Usage ==

Simply go to your form settings, choose the "Redirect Settings" tab and set the page you want to be redirected to.

== Features ==

* Redirect to any URL
* Open page in a new tab
* Run JavaScript after form submission (great for conversion management)
* Pass fields from the form as URL query parameters

* **[Pro]** Create registration forms
* **[Pro]** Create login forms
* **[Pro]** Add to Mailchimp list
* **[Pro]** Conditional error managment
* **[Pro]** Redirect rules
* **[Pro]** Conditional logic for each action
* **[Pro]** Manage email notifications by conditional logic
* **[Pro]** Fire custom JavaScript events by conditional logic
* **[Pro]** Send data to remote servers (3rd-party integration)
* **[Pro]** Send RESTful Json/XML to remote servers
* **[Pro]** Send RESTful POST/GET to remote servers
* **[Pro]** Manage Facebook conversion pixels
* **[Pro]** Manage Google Adwords conversion pixels
* **[Pro]** Leads Manager - save leads to database
* **[Pro]** PayPal Integration


> Note: some features are availible only in the Pro version. Which means you need Redirection for Contact Form 7 Pro to unlock those features. You can [get Redirection for Contact Form 7 Pro here](http://querysol.com/product/contact-form-7-redirection/)!

== Installation ==

Installing Redirection for Contact Form 7 can be done either by searching for "Redirection for Contact Form 7" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

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

= 1.3.5 =
* Fixed a bug: Redirection Pro for Contact Form 7 message not disappearing after clicking the X button (for some users).

= 1.3.4 =
* Fixed a bug: "Changes you made may not be saved" pop-up no longer appears when no changes have been made.
* Fixed a bug: When passing all fields as parameters, "+" sign is now replaced with "%20".
* Minor code styling changes to fully meet WordPress standards.

= 1.3.3 =
* Fixed a bug: URL query parameters are now properly decoded.

= 1.3.2 =
* New feature: delay redirection in milliseconds.

= 1.3.1 =
* Fixed a bug in legacy browsers: the Pro message keep showing.

= 1.3.0 =
* Minor dev improvements.

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
* New feature: add script after the form has been sent successfully.

= 1.0.2 =
* Added full support for form duplication.
* New feature: open page in a new tab.
* Added plugin class CF7_Redirect.

= 1.0.0 =
* Initial release.