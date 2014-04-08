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

define('S_VERSION', '');
define('S_COPYRIGHT','');

/////////////////////////////////////////////////
// Init server variables

foreach (array('SCRIPT_NAME', 'SERVER_ADMIN', 'SERVER_NAME',
	'SERVER_PORT', 'SERVER_SOFTWARE') as $key) {
	define($key, isset($_SERVER[$key]) ? $_SERVER[$key] : '');
	unset(${$key}, $_SERVER[$key], $HTTP_SERVER_VARS[$key]);
}

/////////////////////////////////////////////////
// Init grobal variables

$foot_explain = array();	// Footnotes
$related      = array();	// Related pages
$head_tags    = array();	// XHTML tags in <head></head>

/////////////////////////////////////////////////
// Time settings

define('LOCALZONE', date('Z'));
define('UTIME', time() - LOCALZONE);
define('MUTIME', getmicrotime());

/////////////////////////////////////////////////
// Require INI_FILE

define('INI_FILE', 'blog.ini.php');
require(INI_FILE);

switch (LANG){
case 'en': define('MB_LANGUAGE', 'English' ); break;
case 'ja': define('MB_LANGUAGE', 'Japanese'); break;
case 'ko': define('MB_LANGUAGE', 'Korean'  ); break;
}

define('PKWK_UTF8_ENABLE', 1);
if (defined('PKWK_UTF8_ENABLE')) {
	define('SOURCE_ENCODING', 'UTF-8');
	define('CONTENT_CHARSET', 'UTF-8');
} else {
	switch (LANG){
	case 'en':
		define('SOURCE_ENCODING', 'ASCII');
		define('CONTENT_CHARSET', 'iso-8859-1');
		break;
	case 'ja':
		define('SOURCE_ENCODING', 'EUC-JP');
		define('CONTENT_CHARSET', 'EUC-JP');
		break;
	}
}

mb_language(MB_LANGUAGE);
mb_internal_encoding(SOURCE_ENCODING);
ini_set('mbstring.http_input', 'pass');
mb_http_output('pass');
mb_detect_order('auto');

/////////////////////////////////////////////////
// INI_FILE: Require LANG_FILE

define('LANG_FILE_HINT', DATA_HOME . LANG . '.lng.php');	// For encoding hint
define('LANG_FILE',      DATA_HOME . UI_LANG . '.lng.php');	// For UI resource
$die = '';
foreach (array('LANG_FILE_HINT', 'LANG_FILE') as $langfile) {
	require_once(constant($langfile));
}

/////////////////////////////////////////////////
// LANG_FILE: Init encoding hint

define('PKWK_ENCODING_HINT', isset($_LANG['encode_hint'][LANG]) ? $_LANG['encode_hint'][LANG] : '');
unset($_LANG['encode_hint']);

/////////////////////////////////////////////////
// LANG_FILE: Init severn days of the week

$weeklabels = $_msg_week;

/////////////////////////////////////////////////
// INI_FILE: Init $script

if (isset($script)) {
	get_script_uri($script); // Init manually
} else {
	$script = get_script_uri(); // Init automatically
}

/////////////////////////////////////////////////
// INI_FILE: $agents:  UserAgentの識別

$ua = 'HTTP_USER_AGENT';
$user_agent = $matches = array();

$user_agent['agent'] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
unset(${$ua}, $_SERVER[$ua], $HTTP_SERVER_VARS[$ua], $ua);	// safety

foreach ($agents as $agent) {
	if (preg_match($agent['pattern'], $user_agent['agent'], $matches)) {
		$user_agent['profile'] = isset($agent['profile']) ? $agent['profile'] : '';
		$user_agent['name']    = isset($matches[1]) ? $matches[1] : '';	// device or browser name
		$user_agent['vers']    = isset($matches[2]) ? $matches[2] : ''; // 's version
		break;
	}
}
unset($agents, $matches);

// Profile-related init and setting
define('UA_PROFILE', isset($user_agent['profile']) ? $user_agent['profile'] : '');

define('UA_INI_FILE', DATA_HOME . UA_PROFILE . '.ini.php');
if (! file_exists(UA_INI_FILE) || ! is_readable(UA_INI_FILE)) {
	die_message('UA_INI_FILE for "' . UA_PROFILE . '" not found.');
} else {
	require(UA_INI_FILE); // Also manually
}

define('UA_NAME', isset($user_agent['name']) ? $user_agent['name'] : '');
define('UA_VERS', isset($user_agent['vers']) ? $user_agent['vers'] : '');
unset($user_agent);	// Unset after reading UA_INI_FILE

// Remove null character etc.
$_GET    = input_filter($_GET);
$_POST   = input_filter($_POST);
$_COOKIE = input_filter($_COOKIE);

/////////////////////////////////////////////////
// GET, POST, COOKIE

$get    = & $_GET;
$post   = & $_POST;
$cookie = & $_COOKIE;

// GET + POST = $vars
if (empty($_POST)) {
	$vars = & $_GET;  // Major pattern: Read-only access via GET
} else if (empty($_GET)) {
	$vars = & $_POST; // Minor pattern: Write access via POST etc.
} else {
	$vars = array_merge($_GET, $_POST); // Considered reliable than $_REQUEST
}

$vars['page'] = '';

/////////////////////////////////////////////////
// 初期設定($WikiName,$BracketNameなど)
// $WikiName = '[A-Z][a-z]+(?:[A-Z][a-z]+)+';
// $WikiName = '\b[A-Z][a-z]+(?:[A-Z][a-z]+)+\b';
// $WikiName = '(?<![[:alnum:]])(?:[[:upper:]][[:lower:]]+){2,}(?![[:alnum:]])';
// $WikiName = '(?<!\w)(?:[A-Z][a-z]+){2,}(?!\w)';

// BugTrack/304暫定対処
$WikiName = '(?:[A-Z][a-z]+){2,}(?!\w)';

// $BracketName = ':?[^\s\]#&<>":]+:?';
$BracketName = '(?!\s):?[^\r\n\t\f\[\]<>#&":]+:?(?<!\s)';

// InterWiki
$InterWikiName = '(\[\[)?((?:(?!\s|:|\]\]).)+):(.+)(?(1)\]\])';

// 注釈
$NotePattern = '/\(\(((?:(?>(?:(?!\(\()(?!\)\)(?:[^\)]|$)).)+)|(?R))*)\)\)/ex';

/////////////////////////////////////////////////
// 初期設定(ユーザ定義ルール読み込み)
require(DATA_HOME . 'rules.ini.php');

/////////////////////////////////////////////////
// 初期設定(その他のグローバル変数)

// 現在時刻
$now = format_date(UTIME);

// 日時置換ルールを$line_rulesに加える
if ($usedatetime) $line_rules += $datetime_rules;
unset($datetime_rules);

// 実体参照パターンおよびシステムで使用するパターンを$line_rulesに加える
//$entity_pattern = '[a-zA-Z0-9]{2,8}';
$entity_pattern = trim(join('', file(CACHE_DIR . 'entities.dat')));

$line_rules = array_merge(array(
	'&amp;(#[0-9]+|#x[0-9a-f]+|' . $entity_pattern . ');' => '&$1;',
	"\r"          => '<br />' . "\n",	/* 行末にチルダは改行 */
), $line_rules);

?>