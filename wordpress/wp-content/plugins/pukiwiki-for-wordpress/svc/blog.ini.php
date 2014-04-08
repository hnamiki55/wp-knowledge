<?php
// PukiWiki - Yet another WikiWikiWeb clone
// $Id: pukiwiki.ini.php,v 1.140 2006/06/11 14:35:39 henoheno Exp $
// Copyright (C)
//   2002-2006 PukiWiki Developers Team
//   2001-2002 Originally written by yu-ji
// License: GPL v2 or (at your option) any later version
//
// PukiWiki main setting file

/////////////////////////////////////////////////
// Functionality settings

// PKWK_OPTIMISE - Ignore verbose but understandable checking and warning
//   If you end testing this PukiWiki, set '1'.
//   If you feel in trouble about this PukiWiki, set '0'.
if (! defined('PKWK_OPTIMISE'))
	define('PKWK_OPTIMISE', 0);

/////////////////////////////////////////////////
// Security settings

// PKWK_READONLY - Prohibits editing and maintain via WWW
//   NOTE: Counter-related functions will work now (counter, attach count, etc)
if (! defined('PKWK_READONLY'))
	define('PKWK_READONLY', 0); // 0 or 1

// PKWK_SAFE_MODE - Prohibits some unsafe(but compatible) functions 
if (! defined('PKWK_SAFE_MODE'))
	define('PKWK_SAFE_MODE', 0);

// PKWK_DISABLE_INLINE_IMAGE_FROM_URI - Disallow using inline-image-tag for URIs
//   Inline-image-tag for URIs may allow leakage of Wiki readers' information
//   (in short, 'Web bug') or external malicious CGI (looks like an image's URL)
//   attack to Wiki readers, but easy way to show images.
if (! defined('PKWK_DISABLE_INLINE_IMAGE_FROM_URI'))
	define('PKWK_DISABLE_INLINE_IMAGE_FROM_URI', 0);

// PKWK_QUERY_STRING_MAX
//   Max length of GET method, prohibits some worm attack ASAP
//   NOTE: Keep (page-name + attach-file-name) <= PKWK_QUERY_STRING_MAX
define('PKWK_QUERY_STRING_MAX', 640); // Bytes, 0 = OFF

/////////////////////////////////////////////////
// Experimental features

// Multiline plugin hack (See BugTrack2/84)
// EXAMPLE(with a known BUG):
//   #plugin(args1,args2,...,argsN){{
//   argsN+1
//   argsN+1
//   #memo(foo)
//   argsN+1
//   }}
//   #memo(This makes '#memo(foo)' to this)
define('PKWKEXP_DISABLE_MULTILINE_PLUGIN_HACK', 1); // 1 = Disabled

/////////////////////////////////////////////////
// Language / Encoding settings

// LANG - Internal content encoding ('en', 'ja', or ...)
define('LANG', 'ja');

// UI_LANG - Content encoding for buttons, menus,  etc
define('UI_LANG', LANG); // 'en' for Internationalized wikisite

/////////////////////////////////////////////////
// Directory settings I (ended with '/', permission '777')

// You may hide these directories (from web browsers)
// by setting DATA_HOME at index.php.

define('DATA_DIR',      DATA_HOME . 'wiki/'     ); // Latest wiki texts
define('DIFF_DIR',      DATA_HOME . 'diff/'     ); // Latest diffs
define('BACKUP_DIR',    DATA_HOME . 'backup/'   ); // Backups
define('CACHE_DIR',     DATA_HOME . 'cache/'    ); // Some sort of caches
define('UPLOAD_DIR',    DATA_HOME . 'attach/'   ); // Attached files and logs
define('COUNTER_DIR',   DATA_HOME . 'counter/'  ); // Counter plugin's counts
define('TRACKBACK_DIR', DATA_HOME . 'trackback/'); // TrackBack logs
define('PLUGIN_DIR',    DATA_HOME . 'plugin/'   ); // Plugin directory

/////////////////////////////////////////////////
// Directory settings II (ended with '/')

// Skins / Stylesheets
define('SKIN_DIR', 'skin/');
// Skin files (SKIN_DIR/*.skin.php) are needed at
// ./DATAHOME/SKIN_DIR from index.php, but
// CSSs(*.css) and JavaScripts(*.js) are needed at
// ./SKIN_DIR from index.php.

// Static image files
define('IMAGE_DIR', 'image/');
// Keep this directory shown via web browsers like
// ./IMAGE_DIR from index.php.

/////////////////////////////////////////////////
// Local time setting

switch (LANG) { // or specifiy one
case 'ja':
	define('ZONE', 'JST');
	define('ZONETIME', 9 * 3600); // JST = GMT + 9
	break;
default  :
	define('ZONE', 'GMT');
	define('ZONETIME', 0);
	break;
}

/////////////////////////////////////////////////
// Title of your Wikisite (Name this)
// Also used as RSS feed's channel name etc
$page_title = 'PukiWiki';

// Specify PukiWiki URL (default: auto)
//$script = 'http://example.com/pukiwiki/';

// Shorten $script: Cut its file name (default: not cut)
//$script_directory_index = 'index.php';

// Site admin's name (CHANGE THIS)
$modifier = 'anonymous';

// Site admin's Web page (CHANGE THIS)
$modifierlink = 'http://pukiwiki.example.com/';

// Default page name
$defaultpage  = 'FrontPage';     // Top / Default page
$whatsnew     = 'RecentChanges'; // Modified page list
$whatsdeleted = 'RecentDeleted'; // Removeed page list
$interwiki    = 'InterWikiName'; // Set InterWiki definition here
$menubar      = 'MenuBar';       // Menu

/////////////////////////////////////////////////
// Change default Document Type Definition

// Some web browser's bug, and / or Java apprets may needs not-Strict DTD.
// Some plugin (e.g. paint) set this PKWK_DTD_XHTML_1_0_TRANSITIONAL.

//$pkwk_dtd = PKWK_DTD_XHTML_1_1; // Default
//$pkwk_dtd = PKWK_DTD_XHTML_1_0_STRICT;
//$pkwk_dtd = PKWK_DTD_XHTML_1_0_TRANSITIONAL;
//$pkwk_dtd = PKWK_DTD_HTML_4_01_STRICT;
//$pkwk_dtd = PKWK_DTD_HTML_4_01_TRANSITIONAL;

/////////////////////////////////////////////////
// Always output "nofollow,noindex" attribute

$nofollow = 0; // 1 = Try hiding from search engines

/////////////////////////////////////////////////

// PKWK_ALLOW_JAVASCRIPT - Allow / Prohibit using JavaScript
define('PKWK_ALLOW_JAVASCRIPT', 0);

/////////////////////////////////////////////////
// TrackBack feature

// Enable Trackback
$trackback = 0;

// Show trackbacks with an another window (using JavaScript)
$trackback_javascript = 0;

/////////////////////////////////////////////////
// Referer list feature
$referer = 0;

/////////////////////////////////////////////////
// _Disable_ WikiName auto-linking
$nowikiname = 1;

/////////////////////////////////////////////////
// AutoLink feature

// AutoLink minimum length of page name
$autolink = 0; // Bytes, 0 = OFF (try 8)

/////////////////////////////////////////////////
// Enable Freeze / Unfreeze feature
$function_freeze = 1;

/////////////////////////////////////////////////
// Allow to use 'Do not change timestamp' checkbox
// (0:Disable, 1:For everyone,  2:Only for the administrator)
$notimeupdate = 1;

/////////////////////////////////////////////////
// Admin password for this Wikisite

// Default: always fail
$adminpass = '{x-php-md5}!';

// Sample:
//$adminpass = 'pass'; // Cleartext
//$adminpass = '{x-php-md5}1a1dc91c907325c69271ddf0c944bc72'; // PHP md5()  'pass'
//$adminpass = '{CRYPT}$1$AR.Gk94x$uCe8fUUGMfxAPH83psCZG/';   // LDAP CRYPT 'pass'
//$adminpass = '{MD5}Gh3JHJBzJcaScd3wyUS8cg==';               // LDAP MD5   'pass'
//$adminpass = '{SMD5}o7lTdtHFJDqxFOVX09C8QnlmYmZnd2Qx';      // LDAP SMD5  'pass'

/////////////////////////////////////////////////
// Page-reading feature settings
// (Automatically creating pronounce datas, for Kanji-included page names,
//  to show sorted page-list correctly)

// Enable page-reading feature by calling ChaSen or KAKASHI command
// (1:Enable, 0:Disable)
$pagereading_enable = 0;

// Specify converter as ChaSen('chasen') or KAKASI('kakasi') or None('none')
$pagereading_kanji2kana_converter = 'none';

// Specify Kanji encoding to pass data between PukiWiki and the converter
$pagereading_kanji2kana_encoding = 'EUC'; // Default for Unix
//$pagereading_kanji2kana_encoding = 'SJIS'; // Default for Windows

// Absolute path of the converter (ChaSen)
$pagereading_chasen_path = '/usr/local/bin/chasen';
//$pagereading_chasen_path = 'c:\progra~1\chasen21\chasen.exe';

// Absolute path of the converter (KAKASI)
$pagereading_kakasi_path = '/usr/local/bin/kakasi';
//$pagereading_kakasi_path = 'c:\kakasi\bin\kakasi.exe';

// Page name contains pronounce data (written by the converter)
$pagereading_config_page = ':config/PageReading';

// Page name of default pronouncing dictionary, used when converter = 'none'
$pagereading_config_dict = ':config/PageReading/dict';

/////////////////////////////////////////////////
// User definition
$auth_users = array(
	// Username => password
	'foo'	=> 'foo_passwd', // Cleartext
	'bar'	=> '{x-php-md5}f53ae779077e987718cc285b14dfbe86', // PHP md5() 'bar_passwd'
	'hoge'	=> '{SMD5}OzJo/boHwM4q5R+g7LCOx2xGMkFKRVEx',      // LDAP SMD5 'hoge_passwd'
);

/////////////////////////////////////////////////
// Authentication method

$auth_method_type	= 'pagename';	// By Page name
//$auth_method_type	= 'contents';	// By Page contents

/////////////////////////////////////////////////
// Read auth (0:Disable, 1:Enable)
$read_auth = 0;

$read_auth_pages = array(
	// Regex		   Username
	'#HogeHoge#'		=> 'hoge',
	'#(NETABARE|NetaBare)#'	=> 'foo,bar,hoge',
);

/////////////////////////////////////////////////
// Edit auth (0:Disable, 1:Enable)
$edit_auth = 0;

$edit_auth_pages = array(
	// Regex		   Username
	'#BarDiary#'		=> 'bar',
	'#HogeHoge#'		=> 'hoge',
	'#(NETABARE|NetaBare)#'	=> 'foo,bar,hoge',
);

/////////////////////////////////////////////////
// Search auth
// 0: Disabled (Search read-prohibited page contents)
// 1: Enabled  (Search only permitted pages for the user)
$search_auth = 0;

/////////////////////////////////////////////////
// $whatsnew: Max number of RecentChanges
$maxshow = 60;

// $whatsdeleted: Max number of RecentDeleted
// (0 = Disabled)
$maxshow_deleted = 60;

/////////////////////////////////////////////////
// Page names can't be edit via PukiWiki
$cantedit = array( $whatsnew, $whatsdeleted );

/////////////////////////////////////////////////
// HTTP: Output Last-Modified header
$lastmod = 0;

/////////////////////////////////////////////////
// Date format
$date_format = 'Y-m-d';

// Time format
$time_format = 'H:i:s';

/////////////////////////////////////////////////
// Max number of RSS feed
$rss_max = 15;

/////////////////////////////////////////////////
// Backup related settings

// Enable backup
$do_backup = 0;

// When a page had been removed, remove its backup too?
$del_backup = 0;

// Bacukp interval and generation
$cycle  =   3; // Wait N hours between backup (0 = no wait)
$maxage = 120; // Stock latest N backups

// NOTE: $cycle x $maxage / 24 = Minimum days to lost your data
//          3   x   120   / 24 = 15

// Splitter of backup data (NOTE: Too dangerous to change)
define('PKWK_SPLITTER', '>>>>>>>>>>');

/////////////////////////////////////////////////
// Command execution per update

define('PKWK_UPDATE_EXEC', '');

// Sample: Namazu (Search engine)
//$target     = '/var/www/wiki/';
//$mknmz      = '/usr/bin/mknmz';
//$output_dir = '/var/lib/namazu/index/';
//define('PKWK_UPDATE_EXEC',
//	$mknmz . ' --media-type=text/pukiwiki' .
//	' -O ' . $output_dir . ' -L ja -c -K ' . $target);

/////////////////////////////////////////////////
// HTTP proxy setting (for TrackBack etc)

// Use HTTP proxy server to get remote data
$use_proxy = 0;

$proxy_host = 'proxy.example.com';
$proxy_port = 8080;

// Do Basic authentication
$need_proxy_auth = 0;
$proxy_auth_user = 'username';
$proxy_auth_pass = 'password';

// Hosts that proxy server will not be needed
$no_proxy = array(
	'localhost',	// localhost
	'127.0.0.0/8',	// loopback
//	'10.0.0.0/8'	// private class A
//	'172.16.0.0/12'	// private class B
//	'192.168.0.0/16'	// private class C
//	'no-proxy.com',
);

////////////////////////////////////////////////
// Mail related settings

// Send mail per update of pages
$notify = 0;

// Send diff only
$notify_diff_only = 1;

// SMTP server (Windows only. Usually specified at php.ini)
$smtp_server = 'localhost';

// Mail recipient (To:) and sender (From:)
$notify_to   = 'to@example.com';	// To:
$notify_from = 'from@example.com';	// From:

// Subject: ($page = Page name wll be replaced)
$notify_subject = '[PukiWiki] $page';

// Mail header
// NOTE: Multiple items must be divided by "\r\n", not "\n".
$notify_header = '';

/////////////////////////////////////////////////
// Mail: POP / APOP Before SMTP

// Do POP/APOP authentication before send mail
$smtp_auth = 0;

$pop_server = 'localhost';
$pop_port   = 110;
$pop_userid = '';
$pop_passwd = '';

// Use APOP instead of POP (If server uses)
//   Default = Auto (Use APOP if possible)
//   1       = Always use APOP
//   0       = Always use POP
// $pop_auth_use_apop = 1;

/////////////////////////////////////////////////
// Ignore list

// Regex of ignore pages
$non_list = '^\:';

// Search ignored pages
$search_non_list = 1;

/////////////////////////////////////////////////
// Template setting

$auto_template_func = 1;
$auto_template_rules = array(
	'((.+)\/([^\/]+))' => '\2/template'
);

/////////////////////////////////////////////////
// Automatically add fixed heading anchor
$fixed_heading_anchor = 1;

/////////////////////////////////////////////////
// Remove the first spaces from Preformatted text
$preformat_ltrim = 1;

/////////////////////////////////////////////////
// Convert linebreaks into <br />
$line_break = 0;

/////////////////////////////////////////////////
// Use date-time rules (See rules.ini.php)
$usedatetime = 1;

/////////////////////////////////////////////////
// Blog settings

$nowikiname = 1;

/////////////////////////////////////////////////
// User-Agent settings
//
// If you want to ignore embedded browsers for rich-content-wikisite,
// remove (or comment-out) all 'keitai' settings.
//
// If you want to to ignore desktop-PC browsers for simple wikisite,
// copy keitai.ini.php to default.ini.php and customize it.

$agents = array(
	array('pattern'=>'#^(PukiWiki for Movable Type)/([0-9\.]+)#',	'profile'=>'default'),
	array('pattern'=>'#^(PukiWiki for WordPress)/([0-9\.]+)#',	'profile'=>'default'),
);
?>