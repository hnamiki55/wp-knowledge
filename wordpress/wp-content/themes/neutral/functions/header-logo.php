<?php
/**
 * ロゴ画像を取り扱うファイル 
 */


/**
 * フロントページにロゴを表示する
 */
function the_dp_logo(){
$logo = dp_logo_to_display();
$option = get_neutral_option(); //オプションの値を取得
if($logo){
$title = get_bloginfo('name');
$url = home_url();
echo <<<EOS
<h1 id="logo_image" style="top:{$option['logotop']}px ; left:{$option['logoleft']}px;">
<a href="{$url}/">
<img src="{$logo['url']}" alt="{$title}" width="{$logo['width']}" height="{$logo['height']}" />
</a>
</h1>
EOS;
}else{
if ($option['show_site_desc']):
echo '<h1 class="logo_text"><a href="'.home_url().'/">'.get_bloginfo('name')."</a></h1>\n" . "<h2 id='site_description'>" . get_bloginfo('description') . "</h2>\n";
else:
echo '<h1 class="logo_text no_desc"><a href="'.home_url().'/">'.get_bloginfo('name')."</a></h1>\n";
endif;
}
}

function has_dp_logo() {
$logo = dp_logo_to_display();
 if($logo) {
  echo ' has_logo';
 };
};

/**
 * ロゴが存在するか否かを返す
 * @param boolean $only_resized 初期値はfalse。trueにした場合はリサイズされたロゴが存在する場合だけtrueを返す。
 * @return string|false 存在する場合はファイル名を返す
 */
function dp_logo_exists($only_resized = false){
	$dir = dp_logo_basedir();
	//ディレクトリが存在しない
	if(!file_exists($dir) || !is_dir($dir)){
		return false;
	}
	//リサイズが指定されている場合はリサイズされたものがあるか検索
	if($only_resized){
		foreach(scandir($dir) as $file){
			if(preg_match("/logo-resized\.(jpe?g|png|gif)$/i", $file)){
				return $dir.DIRECTORY_SEPARATOR.$file;
			}	
		}
		return false;
	}
	//オリジナルのファイルが存在するか否かを返す
	foreach(scandir($dir) as $file){
		if(preg_match("/logo\.(jpe?g|png|gif)$/i", $file)){
			return $dir.DIRECTORY_SEPARATOR.$file;
		}
	}
	//ここまで来たということはロゴはない
	return false;
}

/**
 * ロゴのパスや縦横サイズを返す
 * @param boolean $only_resized 
 * @uses dp_logo_exits
 * @return array name(string), url(string), path(string), width(int)およびheight(int)からなる配列
 */
function dp_logo_info($only_resized = false){
	$file = dp_logo_exists($only_resized);
	if($file){
		$size = @getimagesize($file);
		if($size){
			return array(
				'name' => basename($file),
				'url' => dp_logo_baseurl().'/'.basename($file),
				'path' => $file,
				'width' => $size[0],
				'height' => $size[1],
				'mime' => $size[2]
			);
		}else{
			return false;
		}
		return $size;
	}else{
		false;
	}
}

/**
 * ロゴ画像のimageタグを返す
 * @param boolean $resized 初期値はfalse。trueにするとリサイズされた画像を出力
 * @param string $alt
 * @param string $aditional_class
 * @param int $max_width 指定した場合はそのサイズに縮小して表示
 */
function dp_logo_img_tag($resized = false, $alt = '', $aditional_class = '', $max_width = 0){
	$class = 'neutral-logo ';
	$class .= $resized ? 'neutral-logo-resized' : 'neutral-logo-original';
	if(!empty($aditional_class)){
		$class .= ' '.$aditional_class;
	}
	$info = dp_logo_info($resized);
	if($info){
		if($max_width > 0 && $info['width'] > $max_width){
			$height = round($info['height'] / $info['width'] * $max_width);
			$width = $max_width;
		}else{
			$width = $info['width'];
			$height = $info['height'];
		}
		echo '<img src="'.$info['url'].'" alt="'.esc_attr($alt).'" class="'.esc_attr($class).'" width="'.intval($width).'" height="'.intval($height).'" />';
	}
}

/**
 * 表示すべきロゴの情報を返す
 * @return array
 */
function dp_logo_to_display(){
	$file = dp_logo_info(true);
	if($file){
		return $file;
	}else{
		return dp_logo_info();
	}
}

/**
 * ロゴの位置調整用のタグを書き出す
 * @param int $wrapper_original_size
 * @param int $wrapper_display_size 
 * @return boolean
 */
function dp_logo_resize_tag($wrapper_original_size, $wrapper_display_size, $top = 0, $left = 0){
	$ratio = $wrapper_display_size / $wrapper_original_size;
	$info = dp_logo_to_display();
	$width = round($info['width'] * $ratio);
	$height = round($info['height'] * $ratio);
	if($width > $wrapper_display_size){
		return false;
	}
	$top = round(intval($top) * $ratio);
	$left = round(intval($left) * $ratio);
	echo '<img src="'.$info['url'].'" alt="" width="'.intval($width).'" height="'.intval($height).'" style="top: '.$top.'px; left: '.$left.'px;" />';
	return true;
}

/**
 * リサイズ用ロゴのタグを書き出す
 * @param int $max 
 */
function dp_logo_resize_base($max = 600){
	$info = dp_logo_info();
	if(!$info){
		return;
	}
	$ratio = $max < $info['width'] ? $max / $info['width'] : 1;
	$width = round($info['width'] * $ratio);
	$height = round($info['height'] * $ratio);
	echo <<<EOS
<img id="dp_logo_to_resize" src="{$info['url']}" width="{$width}" height="{$height}" alt="" />
<input type="hidden" name="dp_logo_to_resize_ratio" value="{$ratio}" />
<input type="hidden" name="dp_logo_resize_height" value="{$info['height']}" />
<input type="hidden" name="dp_logo_resize_width" value="{$info['width']}" />
<input type="hidden" name="dp_logo_resize_left" value="" />
<input type="hidden" name="dp_logo_resize_top" value="" />
EOS;
}

/**
 * ロゴ画像を保存しているディレクトリ名を返す
 * @return string
 */
function dp_logo_basedir(){
	$dir = wp_upload_dir();
	return $dir['basedir'].DIRECTORY_SEPARATOR.'neutral';
}

/**
 * ロゴ画像を保存しているディレクトリのURLを返す
 * @return type 
 */
function dp_logo_baseurl(){
	$dir = wp_upload_dir();
	return $dir['baseurl'].'/neutral';
}

/**
 * アップロードされたロゴか否か
 * @param string $url
 * @return boolean 
 */
function dp_is_uploaded_img($url){
	return false !== strpos($url, dp_logo_baseurl());
}

/**
 * ロゴ画像をアップロードする
 * @global array $dp_upload_error
 * @return array error(boolean)とmessage(string)からなる配列
 */
function _dp_upload_logo(){
	$dp_upload_error = array(
		'error' => false,
		'message' => ''
	);
	$dir = dp_logo_basedir();
	//ファイルのアップロードができるか判定
	if($_FILES['dp_image']['error'] !== 0){
		$dp_upload_error = array(
			'error' => true,
			'message' => _dp_get_upload_err_msg($_FILES['dp_image']['error'])
		);
		return $dp_upload_error;
	}
	//ディレクトリの存在を調べる
	if(!file_exists($dir) || !is_dir($dir)){
		//ディレクトリを作成してみる
		if(!@mkdir($dir)){
			$dp_upload_error = array(
				'error' => true,
				'message' => sprintf(
					__('Cannot create upload directory. Please make sure <code>%s</code> is writable.'),
					dirname($dir)
				)
			);
			return $dp_upload_error;
		}
	}
	//ディレクトリが書き込み可能か調べる
	if(!is_writable($dir)){
		$dp_upload_error = array(
			'error' => true,
			'message' => sprintf(
				__('Cannot save uploaded file. Please make sure <code>%s</code> is writable.'),
				$dir
			)
		);
		return $dp_upload_error;
	}
	//拡張子を調べる
	$ext = array();
	if(!preg_match("/(png|gif|jpe?g)$/i", $_FILES['dp_image']['name'], $ext)){
		$dp_upload_error = array(
			'error' => true,
			'message' => __('Uploaded file type is not allowed. Allowed file types are PNG, JPG and GIF.')
		);
		return $dp_upload_error;
	}
	//既存のファイルを削除する
	$existing_files = scandir($dir);
	foreach($existing_files as $file){
		if(preg_match("/logo(-resized)?\.(png|gif|jpe?g)$/i", $file)){
			//ファイルが存在した場合は削除する
			if(!@unlink($dir.DIRECTORY_SEPARATOR.$file)){
				$dp_upload_error = array(
					'error' => true,
					'message' => sprintf(__('Cannot delete existing file <code>%s</code>', 'neutral'), $file)
				);
				return $dp_upload_error;
			}
		}
	}
	//ファイルを保存する
	if(!@move_uploaded_file($_FILES['dp_image']['tmp_name'], $dir.DIRECTORY_SEPARATOR.'logo.'.$ext[1])){
		$dp_upload_error = array(
			'error' => true,
			'message' => __('Sorry, but cannot save uploaded file.')
		);
		return $dp_upload_error;
	}
	//ここまで来たということは保存に成功しているので、
	//メッセージを更新する
	$dp_upload_error['message'] = __('Logo file was successfully uploaded.', 'neutral');
	return  $dp_upload_error;
}

/**
 * ロゴ画像を削除する
 * @return void
 */
function _dp_delete_image(){
	if(isset($_REQUEST['page'], $_REQUEST['_wpnonce']) && !isset($_REQUEST['settings-updated']) && $_REQUEST['page'] == 'theme_options'){
		if(wp_verify_nonce($_REQUEST['_wpnonce'], 'dp_delete_image_'.get_current_user_id())){
			$dir = dp_logo_basedir();
			foreach(scandir($dir) as $file){
				if(preg_match("/logo(-resized)?\.(png|gif|jpe?g)/i", $file)){
					if(!@unlink($dir.DIRECTORY_SEPARATOR.$file)){
						add_action('admin_notices', '_dp_delete_message_error');
						return;
					}
				}
			}
			add_action('admin_notices', '_dp_delete_message_sucess');
		}
		$options = get_neutral_option();
		for($i = 1; $i <= 3; $i++){
			if(wp_verify_nonce($_REQUEST['_wpnonce'], 'dp_delete_ad_'.$i)){
				$file = basename($options['ad_image'.$i]);
				if(file_exists(dp_logo_basedir().DIRECTORY_SEPARATOR.$file) && @unlink(dp_logo_basedir().DIRECTORY_SEPARATOR.$file)){
					$options['ad_image'.$i] = '';
					update_option('dp_options', $options);
					add_action('admin_notices', '_dp_delete_message_sucess');
				}else{
					add_action('admin_notices', '_dp_delete_message_error');
				}
			}
		}
	}
	
}
add_action('admin_init', '_dp_delete_image');

/**
 * ロゴ画像の削除失敗メッセージ 
 */
function _dp_delete_message_error(){
	echo '<div id="message" class="error"><p>'.sprintf(__('Failed to delete image. Please check permisson of %s. All files must be writable.', 'neutral'), dp_logo_basedir()).'</p></div>';
}

/**
 * ロゴ画像の削除成功メッセージ 
 */
function _dp_delete_message_sucess(){
	echo '<div id="message" class="updated fade"><p>'.__('Images are successfully deleted.', 'neutral').'</p></div>';
}

function _dp_resize_logo(){
	$dp_resize_message = array(
		'error' => true,
		'message' => ''
	);
	//値をチェック
	$ratio = intval($_REQUEST['dp_resize_ratio']);
	if(!($ratio > 0 && $ratio <= 100)){
		$ratio = 100;
	}
	$orignal_to_display_ratio = (float)$_REQUEST['dp_logo_to_resize_ratio'];
	$width = round($_REQUEST['dp_logo_resize_width'] / $orignal_to_display_ratio);
	$height = round($_REQUEST['dp_logo_resize_height'] / $orignal_to_display_ratio);
	$top = round($_REQUEST['dp_logo_resize_top'] / $orignal_to_display_ratio);
	$left = round($_REQUEST['dp_logo_resize_left'] / $orignal_to_display_ratio);
	//画像を読み込んでみる
	$info = dp_logo_info();
	if(!$info){
		$dp_resize_message['message'] = __('Logo file not exists.', 'neutral');
		return $dp_resize_message;
	}
	$orig_image = wp_load_image($info['path']);
	if(!is_resource($orig_image)){
		$dp_resize_message['message'] = __('Logo file not exists.', 'neutral');
		return $dp_resize_message;
	}
	$new_width = round($width * $ratio / 100);
	$new_height = round($height * $ratio / 100);
	$newimage = wp_imagecreatetruecolor($new_width, $new_height);
	imagecopyresampled(
		$newimage, $orig_image,
		0, 0,
		$left, $top,
		$new_width, $new_height,
		$width, $height
	);
	if(IMAGETYPE_PNG == $info['mime'] && function_exists('imageistruecolor')){
		@imagetruecolortopalette($newimage, false, imagecolorstotal($orig_image));
	}
	imagedestroy($orig_image);
	//ファイルを保存する前に削除
	$dest_path = dp_logo_exists(true);
	if($dest_path && !@unlink($dest_path)){
		$dp_resize_message['message'] = __('Cannot delete existing resized logo.', 'neutral');
		return $dp_resize_message;
	}
	//名前を決めて保存
	$path = preg_replace("/logo\.(png|gif|jpe?g)$/i", "logo-resized.$1", $info['path']);
	$result = null;
	if ( IMAGETYPE_GIF == $info['mime'] ) {
		$result = imagegif( $newimage, $path );
	} elseif ( IMAGETYPE_PNG == $info['mime'] ) {
		$result = imagepng( $newimage, $path );
	} else {
		$result = imagejpeg( $newimage, $path, 100);
	}
	imagedestroy( $newimage );
	if($result){
		$dp_resize_message['error'] = false;
		$dp_resize_message['message'] = __('Logo image is successfully resized.', 'neutral');
	}else{
		$dp_resize_message['message'] = sprintf(__('Failed to save resized logo. Please check permission of <code>%s</code>', 'neutral'), dp_logo_basedir());
	}
	return $dp_resize_message;
}

/**
 * アップロードエラーのメッセージを表示する
 * @param int $error_code
 * @return string 
 */
function _dp_get_upload_err_msg($error_code){
	switch ($error_code) {
	case UPLOAD_ERR_INI_SIZE:
		return __('Uploaded file size is larger than limit set in php.ini.', 'neutral');
		break;
	case UPLOAD_ERR_FORM_SIZE:
		return __('Uploaded file size is larger than post file size.', 'neutral');
		break;
	case UPLOAD_ERR_PARTIAL:
		return  __('The file has been uploaded only partially. Connection error may have occured', 'neutral');
		break;
	case UPLOAD_ERR_NO_FILE:
		return  __('Uploaded file size is too large.', 'neutral');
		break;
	case UPLOAD_ERR_NO_TMP_DIR:
		return  __('No temporary directory exists. Please check PHP Setting is valid.', 'neutral');
		break;
	case UPLOAD_ERR_CANT_WRITE:
		return  __('Failed to write to disk. OS file setting or something is wrong.', 'neutral');
		break;
	case UPLOAD_ERR_EXTENSION:
		return  __('PHP extension module stops uploading. Check PHP setting.', 'neutral');
		break;
	default:
		return  __('Upload failed. Sorry, but reasons cannot be detected.', 'neutral');
		break;
	}
}