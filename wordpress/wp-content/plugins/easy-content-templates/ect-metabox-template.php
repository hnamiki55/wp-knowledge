<?php
global $post;
$is_public = get_post_meta($post->ID, ec_templates::post_meta_key_public, true);
?>
<div>
    <input type="checkbox" id="chk_ect_make_public" name="ect_make_public" value="1"<?php echo $is_public ? ' checked="checked"' : ''; ?> />
    <label for="chk_ect_make_public">Share this Template with others.</label>
</div>
