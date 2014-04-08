<?php
/*
	PukiWiki for Movable Type/PukiWiki for WordPress
	Copyright (C) 2009-2011 makoto_kw (http://www.makotokw.com)

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
// ------------------------------------------------------------
error_reporting(E_ERROR | E_PARSE); // Avoid E_WARNING, E_NOTICE, etc
@ini_set("display_errors","No");

//error_reporting(E_ALL); // Debug purpose
//@ini_set("display_errors","Yes");

define('DATA_HOME',	'pukiwiki/');
define('LIB_DIR',	'pukiwiki/lib/');

$script = svc_get_request_uri();

require(LIB_DIR . 'func.php');
require(LIB_DIR . 'file.php');
require(LIB_DIR . 'plugin.php');
require(LIB_DIR . 'html.php');
//require(LIB_DIR . 'backup.php');

require(LIB_DIR . 'convert_html.php');
require(LIB_DIR . 'make_link.php');
//require(LIB_DIR . 'diff.php');
require(LIB_DIR . 'config.php');
require(LIB_DIR . 'link.php');
require(LIB_DIR . 'auth.php');
require(LIB_DIR . 'proxy.php');
if (! extension_loaded('mbstring')) {
	require(LIB_DIR . 'mbstring.php');
}

// Defaults
$notify = $trackback = $referer = 0;
$page = '';
require('init.php');

// Check
if (UA_NAME != 'PukiWiki for Movable Type' && UA_NAME != 'PukiWiki for WordPress') {
	error_log('Unknown UserAgent:'. UA_NAME);
	exit;
}

$ie = @$vars['ie'];
$oe = @$vars['oe'];
$content = @$vars['content'];
$page = @$vars['page'];
$navigator = @$vars['navigator'];

if (!empty($page)) {
	$file = get_filename($page);
	$content = svc_get_source($file);
} else {
	if (!empty($ie)) {
		$content = mb_convert_encoding($content, CONTENT_CHARSET, $ie);
	}
}

$html = svc_convert_html($content, $navigator);
// List of footnotes
ksort($foot_explain, SORT_NUMERIC);
$notes = ! empty($foot_explain) ? $note_hr . join("\n", $foot_explain) : '';

if (!empty($oe)) {
	$html = mb_convert_encoding($html, $oe, CONTENT_CHARSET);
	$notes = mb_convert_encoding($notes, $oe, CONTENT_CHARSET);
}
echo $html;
echo $notes;
exit;

function svc_get_request_uri() {
	$protocol = (@$_SERVER['HTTPS'] && @$_SERVER['HTTPS'] !== 'off')? 'https': 'http';
	$port = (@$_SERVER['SERVER_PORT'] && @$_SERVER['SERVER_PORT'] != 80) ? ':'.@$_SERVER['SERVER_PORT']: '';
	return $protocol.'://'.$_SERVER['SERVER_NAME'].$port.$_SERVER["REQUEST_URI"];
}

function svc_convert_html($content, $navigator = null) {
	global $script;
	if (!$navigator) $navigator = 'pukiwiki_navigator';
	$html = convert_html($content);
	//$html = str_replace('<div class="jumpmenu"><a href="#navigator">&uarr;</a></div>','',$html);
	$html = str_replace('"#navigator"','"#'.$navigator.'"',$html);
	//$html = preg_replace('/<a\s[^>]*>&dagger;<\/a>/','',$html);
	// Remove Internal links without #anchor
	$url = str_replace('/','\/',$script);
	$html = preg_replace('/'.$url.'\?(#[a-z][a-f0-9]{7})/','$1',$html);
	$html = preg_replace('/<a\s[^>]*href="'.str_replace('/','\/',$script).'[^>]*>(.*)<\/a>/','$1',$html);
	return $html;
}
function svc_get_source($file, $lock = TRUE) {
	$result = array();
	$path  = DATA_DIR.'/'.$file;
	if ($lock) {
		$fp = @fopen($path, 'r');
		if ($fp == FALSE) return $result;
		flock($fp, LOCK_SH);
	}
	$result = str_replace("\r", '', file($path));
	if ($lock) {
		flock($fp, LOCK_UN);
		@fclose($fp);
	}
	return $result;
}


function svc_catbody()
{
	global $script, $vars, $arg, $defaultpage, $whatsnew, $help_page, $hr;
	global $attach_link, $related_link, $cantedit, $function_freeze;
	global $search_word_color, $_msg_word, $foot_explain, $note_hr, $head_tags;
	global $trackback, $trackback_javascript, $referer, $javascript;
	global $nofollow;
	global $_LANG, $_LINK, $_IMAGE;

	global $pkwk_dtd;     // XHTML 1.1, XHTML1.0, HTML 4.01 Transitional...
	global $page_title;   // Title of this site
	global $do_backup;    // Do backup or not
	global $modifier;     // Site administrator's  web page
	global $modifierlink; // Site administrator's name

	// List of attached files to the page
	$attaches = ($attach_link && $is_read && exist_plugin_action('attach')) ?
		attach_filelist() : '';

	// List of related pages
	//$related  = ($related_link && $is_read) ? make_related($_page) : '';

	// List of footnotes
	ksort($foot_explain, SORT_NUMERIC);
	$notes = ! empty($foot_explain) ? $note_hr . join("\n", $foot_explain) : '';
}
?>