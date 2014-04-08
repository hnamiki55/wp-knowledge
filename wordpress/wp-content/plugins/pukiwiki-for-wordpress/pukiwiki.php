<?php
/*
 Plugin Name: Pukiwiki for WordPress
 Plugin URI: http://wordpress.org/extend/plugins/pukiwiki-for-wordpress/
 Version: 0.2.3
 Description: shortcode [pukiwiki] を使うことでエントリ内で PukiWiki 記法が使えるようになります。
 Author: makoto_kw
 Author URI: http://www.makotokw.com/
 */
class PukiWiki_for_WordPress
{
	const NAME = 'PukiWiki for WordPress';
	const VERSION = '0.2.3';
	
	var $agent = '';
	var $url = '';
	var $convertCount = 0; // for pukiwiki_navigateor_id
	
	function getInstance() {
		static $plugin = null;
		if (!$plugin) {
			$plugin = new PukiWiki_for_WordPress();
		}
		return $plugin;
	}
	
	function init() {
		$this->agent = self::NAME.'/'.self::VERSION;
		$wpurl = (function_exists('site_url')) ? site_url() : get_bloginfo('wpurl');
		$this->url = $wpurl.'/wp-content/plugins/'.end(explode(DIRECTORY_SEPARATOR, dirname(__FILE__)));
		add_action('wp_head', array($this,'head'));
		add_action('the_content', array($this,'the_content'), 7);
		add_filter('edit_page_form', array($this,'edit_form_advanced')); // for page
		add_filter('edit_form_advanced', array($this,'edit_form_advanced')); // for post
	}
	
	function head() {
?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->url?>/pukiwiki.css"/>
<?php
	}
	
	function the_content($str) {
		$replace = 'return wp_pukiwiki($matches[1]);';
		return preg_replace_callback('/\[pukiwiki\](.*?)\[\/pukiwiki\]/s',create_function('$matches',$replace),$str);
	}
	
	function edit_form_advanced() {
?>
<script type="text/javascript" src="<?php echo $this->url?>/admin.js"></script>
<?php
	}
	
	function convert($text) {
		$navigator = 'pukiwiki_content'.$this->convertCount++;
		return '<div id="'.$navigator.'" class="pukiwiki_content">'.$this->convert_html($text, $navigator).'</div>';
	}
	
	function convert_html($text, $navigator) {
		$path = $this->url.'/svc/';
		$content = http_build_query(array('content'=>$text, 'navigator' => $navigator));
		$response = wp_remote_request($path,
			array(
				'method'=>'POST',
				'user-agent'=>$this->agent,
				'headers'=>array('Content-Type'=>'application/x-www-form-urlencoded; charset=UTF-8'),
				'body'=>$content,
			)
		);
		if ($response && isset($response['response']['code']) && $response['response']['code'] != 200) {
			error_log(sprintf('PukiWiki_for_WordPress HttpError: %s %s on %s', $response['response']['code'], $response['response']['message'], $path));
			return sprintf('PukiWiki_for_WordPress HttpError: %s %s', $response['response']['code'], $response['response']['message']);
		}
		return wp_remote_retrieve_body($response);
		/*
		$headers = array(
			'User-Agent: '.$this->agent,
			'Content-Type: application/x-www-form-urlencoded',
			'Content-Length: '.strlen($content),
		);
		$opt = array(
			'http' => array(
				'method'	=> 'POST',
				'header'	=> implode("\r\n", $headers),
				'content'   => $content
			)
		);
		return @file_get_contents($path, false, stream_context_create($opt));*/
	}
}

add_action('init', 'pukiwiki_init');
function pukiwiki_init() {
	$p = PukiWiki_for_WordPress::getInstance();
	$p->init();
}

function wp_pukiwiki($text) {
	$p = PukiWiki_for_WordPress::getInstance();
	return $p->convert($text);
}