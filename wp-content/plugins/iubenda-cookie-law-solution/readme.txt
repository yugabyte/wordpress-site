=== iubenda Cookie Solution for GDPR ===
Contributors: iubenda
Donate link:
Tags: cookies, cookie law, cookie policy, cookie banner, cookie block, privacy policy, cookie consent, privacy
Requires at least: 4.0
Requires PHP: 5.2.4
Tested up to: 4.9.8
Stable tag: 1.15.3
License: MIT License
License URI: http://opensource.org/licenses/MIT

iubenda Cookie Solution allows you to make your website GDPR compliant and manage all aspects of cookie law on WP, particularly fit for Italy.

== Description ==

This plugin is an All-in-One approach developed by iubenda that helps to make your website GDPR compliant by generating the privacy policy text, the cookie banner and the blocking management of cookies.

This plugin works with the iubenda Cookie Law Solution and allows to block the most common widgets and third party cookies to comply with Cookie Laws, particularly with the Italian cookie law implementation in mind.

* The plugin automatically inserts the iubenda code in the head of every page of the site
* It allows to manually block all the remaining resources, without the need of direct intervention on the code
* It handles the display of cookie banners and cookie policy, saving user preferences about the use of cookies
* It displays a clean page (without banner) to users who have already provided their consent
* It detects bots/spiders and serves them a clean page

**The plugin is currently capable of automatically detecting and blocking the following scripts:**

* Facebook widgets
* Twitter widgets
* Google+ widgets
* Google AdSense
* YouTube widgets
* AddThis widgets
* ShareThis widgets
* Google Maps widgets

**Some background information**

If you have European users you will know the problem: you need to obtain consent for the usage of many types of cookies and you need to manage that consent somehow. Now even Google forces cookie consent onto users of Google AdSense, DoubleClick for Publishers, and DoubleClick Ad Exchange (and even Google Analytics in some cases). Time to get started with a cookie banner.

iubenda and the Cookie Law Solution extension for WordPress help remove these complex tasks with a couple of clicks. This extension works with the iubenda Cookie Law Solution, displays a cookie banner in 8 languages and saves consent for returning users.

**Which languages does iubenda work in currently?**

* English
* Italian
* French
* Spanish
* Portuguese (Brazilian)
* German
* Dutch
* Russian

**Manual Usage**

How to make the plugin manually work for a Facebook button?

    <!--IUB-COOKIE-BLOCK-START-->
    <script>
    (function(d, s, id) {
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) return;
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=808061959224601";
     fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
    <!--IUB-COOKIE-BLOCK-END-->

If there are HTML / IMG / IFRAME elements, you need to proceed in this way:

    <!--IUB-COOKIE-BLOCK-START-->
          <iframe src="...
          <img src="...
    <!--IUB-COOKIE-BLOCK-END-->

Inside a post/page content there's a shortcode available:

    [iub-cookie-policy]
    [/iub-cookie-policy]

In case of continued browsing, the preferences of your users for the use of cookies will be set on "OK" to clear the banner and unlock the cookies. Moreover, banners and the blocking codes will not be delivered to subsequent visits by users who have already given their consent (and such preference will be updated at each subsequent visit for the future).

== Installation ==

- Search in your WordPress plugins admin panel for "iubenda Cookie Solution", install it;
- Once the plugin is installed and activated, go to the Admin Panel -> iubenda menu where you will be asked to paste the code into tht field that gets generated from your Iubenda account dashboard when you activate the cookie law kit for your privacy policy. For more information on how to activate the cookie law kit, see this article: https://www.iubenda.com/it/help/posts/680;
- At this point the plugin will begin to show the banner on which displays your cookie policy (link) to users who visit the site for the first time. No need for other configurations;
- Furthermore, the plugin automatically recognizes and blocks cookies that get installed via the YouTube video player and social widgets - such as the Facebook Like Box - on your site. **Important note** the scripts for Facebook, Twitter, G+, and YouTube iframe only get blocked automatically when generated from the server side (therefore processed by PHP via WordPress). Scripts that are added to the page via Javascript after page load cannot be blocked automatically;
- If you'd like to manually block a specific script "wrap" it eith the following HTML comments:

      `<!--IUB-COOKIE-BLOCK-START-->
      <!--IUB-COOKIE-BLOCK-END-->`
- In case you're querying WordPress via API, you can disable our plugin by using the iub_no_parse=true URL parameter, like this: www.example.com/api/get_recent_posts?iub_no_parse=true.

== Frequently Asked Questions ==

**Where can I find help?**
You can find a dedicated support forum thread here [Uservoice forum](http://support.iubenda.com/forums/314835-general/suggestions/9670701-discussion-regarding-the-iubenda-cookie-law-soluti) or we're happy to answer at info@iubenda.com.

**Do you have more guidance, or a demo?**
Yes, right here: https://www.iubenda.com/en/help/posts/1177

**Bug reports**
The best way you can help us is by providing as much information as possible, including the use of wp_debug https://codex.wordpress.org/Debugging_in_WordPress.
We will be very happy to receive feedback here: [Uservoice forum](http://support.iubenda.com/forums/314835-general/suggestions/9670701-discussion-regarding-the-iubenda-cookie-law-soluti)

== Screenshots ==

1. This screen shot shows the default banner on top of our test site testkada4.altervista.org/cookie-test/example2.html
2. When clicking on the cookie policy link, the user gets a view of the entire cookie policy, where they ultimately can give their consent
3. It's as simple as copy-pasting the code from iubenda into the plugin form.

== Changelog ==

= 1.15.3 =
* Tweak: Update and extend the list of blocked scripts

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

= 1.15.3 =
* Tweak: Update and extend the list of blocked scripts