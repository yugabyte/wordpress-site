=== iubenda - Cookie and Consent Solution for the GDPR & ePrivacy ===
Contributors: iubenda
Donate link:
Tags: cookies, cookie law, cookie policy, cookie banner, privacy policy, cookie consent, privacy, gdpr, eprivacy
Requires at least: 4.0
Requires PHP: 5.2.4
Tested up to: 5.6.0
Stable tag: 2.3.18
License: MIT License
License URI: http://opensource.org/licenses/MIT

An All-in-One approach developed by iubenda, which includes functionalities of two powerful solutions that help to make your website GDPR and ePrivacy compliant.

== Description ==

This plugin is an All-in-One approach developed by iubenda, which includes functionalities of two powerful solutions (see below) that help to make your website GDPR and ePrivacy compliant. The plugin lets you automate the implementation of ePrivacy (Cookie Law) and GDPR requirements by providing a fully customizable cookie banner, blocking scripts, and by managing all aspects of cookie consent. It also allows you to record, review, and maintain comprehensive GDPR records of consent for your web-forms.

== Cookie Solution ==

This plugin drastically reduces the need for direct interventions in the code of the site by integrating with iubenda’s Cookie Solution. It provides a fully customizable cookie banner, dynamically generates a cookie policy to [match the services in use on your site](https://www.iubenda.com/en/help/19004-how-to-use-the-site-scanner-from-within-the-generator),  and, fully manages cookie-related consent – including the blocking of the most common widgets and third-party cookies before consent is received – in order to comply with the GDPR and ePrivacy.

**Key features:**

* The plugin automatically inserts the iubenda code in the head of every page of the site
* Allows you to automatically or manually block scripts that can install cookies prior to consent, without the need of direct intervention on the code
* Allows you to autodetect and limit prior-blocking and cookie consent requests only to users from the EU – where this is a legal requirement – while running cookies scripts normally in regions where you are still legally allowed to do so.
* Asynchronously re-activates cookie scripts once consent is collected.
* Handles the display of the cookie banner and cookie policy, allowing you to fully customize the banner to match the look and colors of your site if needed
* California Consumer Privacy Act [(CCPA) Support](https://www.iubenda.com/en/help/21165-ccpa-how-to-add-a-notice-of-collection-and-a-do-not-sell-link)
* Saves user preferences about the use of cookies and displays a clean page (without banner) to users who have already provided their consent
* Integrates with IAB’s [Transparency and Consent Framework](https://www.iubenda.com/en/help/7440-enable-preference-management-iab-framework#revenue) (TCF)
* Allows you to provide you users with granular, per-category preference control (e.g. basic functionalities, experience enhancement, targeting & advertising)
* Compatible with Google's Accelerated Mobile Pages (AMP)
* Features an easy-to-use interface for entering custom scripts and iframes
* Detects bots/spiders and serves them a clean page so that your SEO efforts are never compromised

**The plugin is currently capable of automatically detecting and blocking the following scripts:**

* Google Analytics
* Google Maps
* Google AdSense
* Google ReCaptcha
* Google Site Search
* Google Tag Manager
* Google oAuth
* Google+ widgets
* Twitter widgets
* Facebook widgets
* Facebook Comments
* YouTube
* Vimeo
* Linkedin widgets
* ShareThis widgets
* Instagram widgets
* AddThis widgets
* Pinterest widgets
* PayPal widgets
* Disqus
* Optimizely
* Neodata
* Criteo
* Outbrain
* Headway
* Codepen
* Freshchat
* Uservoice
* AdRoll
* Olark
* Segment
* Kissmetrics
* Mixpanel
* Pingdom
* Bing
* Elevio

== Consent Solution ==

Maintaining valid records of consent is a vital part of privacy compliance in general, and it is specifically required under the GDPR. These records should include a userid, timestamp, consent proof, record of the consenting action, and the legal documents available to the user at the time of consent, among other things. This plugin **is THE most complete solution for recording, sorting and maintaining GDPR records of consent**. The plugin also boasts built-in compatibility with WordPress comment form, Contact Form 7 and WP Forms plugins for your convenience, but can be manually integrated with any type of web-form and can even store consent proofs for consents collected offline (e.g in-store sign-ups) via WP media upload.

**Key features:**

* The plugin detects and identifies all supported forms that are embedded in the website
* It’s auto-compatible with and allows super easy mapping of Contact Form 7, WP Forms, WordPress comment and WooCommerce checkout forms
* It allows manual integration with any type of web-form
* For each consent, track the form/wording the user was prompted with
* Flexibly upload any form of proof of consent or legal notice, including a PDF if consent was collected offline
* It provides a high granularity: map individual form fields, exclude fields (like password inputs), add legal notices available at the time of consent collection, indicate double opt-in, set preferences and more
* REST HTTP API and JS SDK, to give you total control and how and when consent is stored
* Store multiple preferences for each user (e.g. if you have multiple newsletters or opt-ins)
* Features an easy-to-use interface for entering custom scripts and iframes
* It provides API input field for quick and easy activation

**Some background information**

If you potentially have any European users, you must comply with laws like the [GDPR](https://www.iubenda.com/en/help/5428-gdpr-guide#consent) and [ePrivacy](https://www.iubenda.com/en/help/6293-cookie-consent-management-faq). These laws are precise in their requirements and technical implementation can be pretty complicated. We've tried to make this process as painless as possible for website and app owners with our suite of compliance software solutions.
Our Cookie and Consent Solution plugin for WordPress simplifies and manages these compliance requirements within a few clicks. This extension works with the iubenda [Cookie Solution](https://www.iubenda.com/en/cookie-solution) and [Consent Solution](https://www.iubenda.com/en/consent-solution).

**Which languages does iubenda work in currently?**

* English
* Italian
* French
* Spanish
* Portuguese (Brazilian)
* German
* Dutch
* Russian

== Installation ==

* Search in your WordPress plugins admin panel for “iubenda Cookie and Consent Solution”, install it;
* Once the plugin is installed and activated, go to the Admin Panel → iubenda menu where you can select either the Cookie Solution or Consent Solution (depending on which you’d like to set up first).
* **For the Cookie Solution**, you will be asked to paste your script into that field – the script is generated from your iubenda account dashboard when you activate the solution. For more information on how to activate the Cookie Solution, see this article (https://www.iubenda.com/en/help/1177-cookie-solution-getting-started#banner).
* At this point the plugin will begin to show your banner on which displays the legal text, the consent options and your cookie policy (link) to users who visit the site for the first time. No need for other configurations;
* Furthermore, the plugin automatically recognizes and blocks cookies that get installed via an extensive list of services such as the YouTube video player, social widgets (e.g the Facebook Like Box) etc. on your site. The full list is included in the “details” above.
* Important note: Scripts can only be automatically blocked when generated from the server side (therefore processed by PHP via WordPress). Scripts that are added to the page via Javascript after page load must be blocked manually. Thankfully, this is fairly easy to do via the Custom Scripts field in the plugin console. Simply enter the custom script or iframe sources you'd like to block within the field, and click on the save changes button. You can find details, examples and further information [here](https://www.iubenda.com/en/help/1215-cookie-solution-wordpress-plugin-installation-guide#blocking-custom-scripts).
* If you’d like to manually block a specific script using a manual “wrap” method, you can use the following:
`<!--IUB-COOKIE-BLOCK-START-->
 <iframe src="...
 <img src="...
<!--IUB-COOKIE-BLOCK-END-->`
* For elements installed directly within WordPress posts (as opposed to elements integrated at the template level – example footer.php) there are shortcodes available:
`[iub-cookie-policy]
[/iub-cookie-policy]`
* In case you’re querying WordPress via API, you can disable our plugin by using the iub_no_parse=true URL parameter, like this: www.example.com/api/get_recent_posts?iub_no_parse=true (http://www.example.com/api/get_recent_posts?iub_no_parse=true).
* **For the Consent Solution**, you will need to paste in your Consent Solution API key. Once you’ve activated the Consent Solution in your iubenda dashboard, you can find your public API key in your dashboard (https://www.iubenda.com/en/dashboard) at [Your website] > Consent Solution > Embed).

== Frequently Asked Questions ==

**Where can I find help?**
You can find a dedicated support forum thread here [Uservoice forum](https://support.iubenda.com/support/discussions/forums/42000118028) or we're happy to answer at info@iubenda.com.

**Do you have more guidance, or a demo?**
Here’s a [quick video](https://iubenda.wistia.com/medias/02ie8av6kt) on what the cookie banner looks like and how you can configure it. More details on how to fully set up the Cookie Solution for wordpress [here](https://www.iubenda.com/en/help/1215-cookie-solution-wordpress-plugin-installation-guide).

Here’s a [quick look](https://iubenda.wistia.com/medias/fsbr465bku) at the Consent Solution dashboard. More details on how to fully set up the Consent Solution for wordpress [here](https://www.iubenda.com/en/help/13083-consent-solution-wordpress-contact-form-7) .

**Bug reports**
The best way you can help us is by providing as much information as possible, including the use of [wp_debug](https://wordpress.org/support/article/debugging-in-wordpress/).
We will be very happy to receive feedback here: [Uservoice forum](https://support.iubenda.com/support/discussions/forums/42000115771)

== Screenshots ==

1. It's as simple as copy-pasting the code from iubenda into the plugin form.
2. Simply enter you API key and click on autodetect to see all forms eligible for mapping.
3. The visual configurator lets you fully customize the look and feel of your banner, wording, and consent collection options.
4. When clicking on the cookie policy link, the user gets a view of the entire cookie policy, where they ultimately can give their consent.
5. IAB Transparency and consent framework integrated.
6. IAB Transparency and consent framework integrated.

== Changelog ==

= 2.3.18 =
* Fix: Avoid overriding the purposes attr if it was set

= 2.3.16 =
* Fix: purpose evaluation for iframes blocking

= 2.3.15 =
* Fix: ConS saves the wrong terms & conditions legal_notice

= 2.3.14 =
* Tweak: Support WP 5.6

= 2.3.13 =
* Fix: Check script type before getting content in GTM

= 2.3.12 =
* Fix: Allow banner customization in AMP
* Tweak: Add alert about lack of permissions on templates folder
* Tweak: Add GA to per-purpose blocking support
* Fix: Add per-purpose on inline script tags

= 2.3.11 =
* Fix: Move the FB connect to experience enhancement
* Tweak: Add Google GPT to per-purpose blocking support in engines

= 2.3.10 =
* Add action (Hook) before rendering the source form
* Change the AMP consent href

= 2.3.9 =
* Fix: Woocommerce custom theme support
* Fix: Detect changes on WPforms

= 2.3.8 =
* Tweak: Add Google GPT to per-purpose blocking support
* Fix: admin.js ready method deprecation

= 2.3.7 =
* Fix: admin.js ready method deprecation

= 2.3.6 =
* TCF v2 Support

= 2.3.6-beta =
* TCF v2 Support

= 2.3.5 =
* Security Fix: limit url sanitize to http protocols

= 2.3.4 =
* Security Fix: limit url sanitize to http protocols

= 2.3.3 =
* Fix: AddThis purpose category

= 2.3.2 =
* Fix: Configuration regular expression issue in some edge cases

= 2.3.1 =
* Fix: Error on AMP configuration during install in some edge cases
* Fix: Invalid www detection during AMP configuration generation process
* Fix: Regex for iubenda script url in AMP configuration
* Tweak: Added noindex for generated AMP configuration file

= 2.3.0 =
* Fix: Multiple consent forms per page support
* Fix: WP Forms checkbox field compatibility
* Tweak: AMP consent geolocation support

= 2.2.0 =
* Fix: Undefined notice during plugin update

= 2.1.0 =
* New: Per-purpose script blocking support
* New: "Reject" button support
* New: Google AMP compatibility option
* Tweak: Improved regular expression on per-purpose feature detection
* Fix: Safari unrecognized expression on CSS wildcards

= 2.1.4-beta =
* New: Multilingual support from AMP

= 2.1.3-beta =
* Tweak: Block tracking code from WP AMP plugins

= 2.1.2-beta =
* New: Google AMP compatibility option

= 2.1.1-beta =
* Tweak: Improved regular expression on per-purpose feature detection
* Fix: Safari unrecognized expression on CSS wildcards

= 2.1.0-beta =
* New: Per-purpose script blocking support
* New: "Reject" button support

= 2.0.2 =
* Fix: initialize iubenda CS on POST requests not working
* Tweak: iubenda generic menu icon switched to iubenda logo

= 2.0.1 =
* New: Jetpack tracking blocking support
* Fix: add_submenu_page and add_menu_page called incorrectly in WP 5.3

= 2.0.0 =
* New: Introducing iubenda Consent Solution integration
* Tweak: Simple HTML Dom update to 1.9

= 2.0.3-beta =
* New: Introducing WooCommerce checkout form field mapping compatibility

= 2.0.2-beta =
* New: Introducing wildcard support for scripts and iframes

= 2.0.1-beta =
* New: Option to initialize iubenda CS on POST requests
* Tweak: Update Cookie Solution and Consent Solution copy

= 2.0-beta =
* New: Introducing iubenda Consent Solution integration
* Tweak: Simple HTML Dom update to 1.9

= 1.15.8 =
* New: Introducing a way to skip specific script parsing
* Fix: Google ReCaptcha with Contact Form 7 initialization issue
* Fix: Improved handling of iubenda script HTML
* Tweak: Support links update

= 1.15.7 =
* Fix: Google ReCaptcha loading issue with Contact Form 7
* Tweak: Improved Youtube and Google Maps script blocking

= 1.15.6 =
* Fix: iubenda script tags removed when Jetpack is active

= 1.15.5 =
* Fix: Skip parsing engine when scripts blocking is disabled
* Tweak: Update iubenda logo

= 1.15.4 =
* New: Option to block custom scripts and iframes
* Tweak: Update and extend the list of blocked scripts including Google Site Search, Google oAuth, Linkedin widgets, PayPal widgets, Freshchat, Uservoice
, AdRoll, Olark, Segment, Kissmetrics, Mixpanel, Pingdom, Bing and Elevio

= 1.15.3 =
* Tweak: Update and extend the list of blocked scripts including Pinterest, AddThis, Disqus, Optimizely, Neodata, Criteo, Outbrain, Headway and Codepen

= 1.15.2 =
* Tweak: Update and unify iubenda parsing engine
* Tweak: Polylang Pro support

= 1.15.1 =
* Fix: iubenda code field removing HTML tags on save
* Tweak: Adjusted the script blocking regex in shortcode

= 1.15.0 =
* New: Option to select iubenda menu position
* Tweak: iubenda faster class regex update
* Tweak: Enable style tag in iubenda code field
* Tweak: Changed default parser method

= 1.14.2 =
* New: iubenda_initial_output filter hook

= 1.14.2-beta1 =
* Fix: repository issues breaking the update

= 1.14.1 =
* New: Option to delete all plugin data upon deactivation
* Fix: Code script attributes stripped from default code block
* Fix: Updated plugin help links
* Fix: Italian language files not loading properly

= 1.14.0 =
* New: i18 support
* New: Polylang support
* Fix: Multiple classes no longer being added to script tags
* Fix: Buffering action hooks adjustments
* General rewrite using WordPress coding standards
* Turned into OOP

= 1.11.1 =
* New: Created a new option that disables the plugin on RSS feeds
* New: Improved the control that checks if the request content type is HTML
* Fixed an issue with the banner script
* Fixed a series of conflicts with UTF-8 special characters caused by the experimental parsing engine

= 1.11.0 =
* New: Introduced a MUCH FASTER experimental parsing engine (visit the plugin options and select the experimental parsing engine)
* New: Created a new option that allow users to enable/disable the parsing engine and to select the parsing engine between stable and experimental
* New: Created a new option that filters the output buffer level to get only the first level ()
* Fixed a series of conflicts with AJAX requests, which were conflicting with Contact Form 7, BackWPUp and other plugins
* Added filter that only activates the plugin when the Content Type is text/html, enabled by default
* Loads of bug fixes and speed improvements

= 1.10.21 =
* Rolling back to 1.10.11

= 1.10.20 =
* Hotfix: moved "is_user_logged_in" method control after the “template_redirect” hook.

= 1.10.19 =
* Fixed a series of conflicts with AJAX requests, which were conflicting with Contact Form 7 and other plugins

= 1.10.18 =
* More bugs fixed
* The content-type restriction option is now on by default

= 1.10.17 =
* Added filter that only activates the plugin when the Content Type is text/html
* Loads of bug fixes and speed improvements

= 1.10.11 =
* iub_no_parse parameter reintroduced
* added XMLRPC control

= 1.10.10 =
* French and Portuguese languages fixed when used with WPML

= 1.10.9 =
* Further bugfixing

= 1.10.9 =
* Further bugfixing

= 1.10.8 =
* Fixed problems with WPML and with using the shortcode

= 1.10.7 =
* Further work on resolving any conflicts with other plugins
* Fixed a problem with the Media library

= 1.10.5 =
* Reverting the parsing method to 1.9.19, slower but more stable

= 1.10.4 =
* Fixed compatibility with the Yoast SEO plugin (and possibly others)
* Fixed preference saving after update from 1.9.19

= 1.10.3 =
* Fixed the WPML activation, which now detects the language of the embedding code and places it in the right tab
* The first tab when WPML is activated is now activated automatically
* The iubenda shortcode has been improved to be more flexible

= 1.10.2 =
* Fixed an encoding issue

= 1.10.1 =
* Fixed a bug that forced users to re-insert their cookie law code

= 1.10.0 =
* New: Multi-language support with WPML integration
* New: AdSense auto-matching/blocking has been redone and now works properly
* New: Addthis and Sharethis are now also automatically blocked
* Loads of small fixes and improvements

= 1.9.28 =
* Fixed some bugs about i18n, created .pot files for translations. Now is true i18n friendly. Tested.

= 1.9.27 =
* i18n friendly

= 1.9.26 =
* Associate cookie policy for installation before/after WPML

= 1.9.25 =
* Hiding E_NOTICE messages

= 1.9.24 =
* skip parsing if XML-RPC request
* skip parsing if is admin page
* added multilanguage

= 1.9.19 =
* new iframe src according to the new doc

= 1.9.18 =
* bug on all iframe, suppressedsrc is not null anymore

= 1.9.17 =
* added another url of google maps embed

= 1.9.16 =
* skip parsing page if bot/crawler + added checkbox to autoparse (or not) the page if the user have already given the consent

= 1.9.15 =
* include bug + google maps

= 1.9.14 =
* Autoconvert iframe vimeo + facebook likebox

= 1.9.13 =
* Now the plugin use iubenda.class.php + fix bug on it.

= 1.9.12 =
* Add iub__no_parse get parameter to skip parsing page

= 1.9.11 =
* Add iub__no_parse get parameter to skip parsing page

= 1.9.10 =
* Another adsense script blocked, another fix on simple html dom

= 1.9.9 =
* Bugs page 60000 chars

= 1.9.8 =
* Added Google Maps & Google Adsense + better shortcode handling

= 1.9.7 =
* minor bugfix

= 1.9.6 =
* bugfix: custom banner now allowed

= 1.9.5 =
* no refresh page needed to activate scripts inside IUB tags.

= 1.9.4 =
* wp-admin blank page bug fix

= 1.9.3 =
* G+ platform bug, typo: _iub_cs_activate_inline vs _iub_cs_activate-inline

= 1.9.2 =
* G+ platform bug

= 1.9.1 =
* Minor improvements

= 1.9 =
* Improved parsing without regex
* No parsing if the user have already given the consent

= 1.0 =
* First plugin version.

== Upgrade Notice ==

= 2.3.18 =
* Fix: Avoid overriding the purposes attr if it was set
