=== PukiWiki for WordPress ===
Contributors: makoto_kw
Donate link: http://www.makotokw.com/
Tags: wiki, japanese
Requires at least: 2.8
Tested up to: 3.5.1
Stable tag: trunk

'PukiWiki for WordPress' converts a html from pukiwiki text on an entry.

== Description ==

'PukiWiki for WordPress' is convert html from pukiwiki text on an entry.
It includes original PukiWiki 1.4.7 (utf-8), 

== Installation ==

1. Upload `pukiwiki-for-wordpress` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Create new entry or page
1. Add pukiwiki text into [pukiwiki][/pukiwiki] tag

== Frequently Asked Questions ==

= What about pukiwiki? =

PukiWiki is most popular wiki system in Japan.
Please read: http://pukiwiki.sourceforge.jp/?About%20PukiWiki

= How do I add a pukiwiki plugin? =

This plugin includes original pukiwiki 1.4.7.
You can add a pukiwiki plugin to `/wp-content/plugins/pukiwiki-for-wordpress/svn/pukiwiki/plugin`.

= I would like to modify stylesheet =

This plugin convert html into <div class="pukiwiki_content"/> element.
Please add style (ex. .pukiwiki_content h1 {...}) to your css file in theme. 
And you should override style on `/wp-content/plugins/pukiwiki-for-wordpress/pukiwiki.css'.

== Screenshots ==

1. Edit an entry by pukiwiki text.
2. Display an entry

== Upgrade Notice ==

Nothing.

== Changelog ==

= 0.2.3 =
* Support PHP 5.4

= 0.2.2 =

* Released at 2010/11/25 (JST)
* Use wp_remote_request instaed of file_get_contents
* Added to call error_log
 
= 0.2.1 =

* Released at 2010/12/20 (JST)
* Fixed to use site_url instead of home_url

= 0.2 =

* released at 2009/12/27 (JST)
* Added to wordpress.org
* Added an edit button for the HTML Editor
* Supported a text filter by [pukiwiki][/pukiwiki]
* Fixed a pukiwiki_navigator via pukiwiki tag

= 0.1 =

* released at 2009/09/22 (JST)
* initial release