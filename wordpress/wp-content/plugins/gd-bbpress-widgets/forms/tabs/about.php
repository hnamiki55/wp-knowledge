<div class="d4p-information">
    <div class="d4p-plugin">
        <h3>GD bbPress Widgets <?php echo $options["version"]; ?></h3>
        <?php

        $status = ucfirst($options["status"]);
        if ($options["revision"] > 0) {
            $status.= " #".$options["revision"];
        }

        _e("Release Date: ", "gd-bbpress-widgets");
        echo '<strong>'.$options["date"].'</strong><br/>';
        _e("Status: ", "gd-bbpress-widgets");
        echo '<strong>'.$status.'</strong><br/>';
        _e("Build: ", "gd-bbpress-widgets");
        echo '<strong>'.$options["build"].'</strong>';

        ?>
    </div>
    <h3><?php _e("System Requirements", "gd-bbpress-widgets"); ?></h3>
    <?php

        _e("WordPress: ", "gd-bbpress-widgets");
        echo '<strong>3.2 or newer</strong><br/>';
        _e("bbPress: ", "gd-bbpress-widgets");
        echo '<strong>2.0 or newer</strong>';

    ?><br/><br/><br/><br/>
</div>
<div class="d4p-information-second">
    <h3><?php _e("Important Plugin Links", "gd-bbpress-widgets"); ?></h3>
    <a target="_blank" href="http://www.dev4press.com/plugins/gd-bbpress-widgets/">GD bbPress Widgets <?php _e("Home Page", "gd-bbpress-widgets"); ?></a><br/>
    <a target="_blank" href="http://wordpress.org/extend/plugins/gd-bbpress-widgets/">GD bbPress Widgets <?php _e("on", "gd-bbpress-widgets"); ?> WordPress.org</a>
    <h3><?php _e("Plugin Support", "gd-bbpress-widgets"); ?></h3>
    <a target="_blank" href="http://www.dev4press.com/forums/forum/free-plugins/gd-bbpress-widgets/"><?php _e("Plugin Support Forum on Dev4Press", "gd-bbpress-widgets"); ?></a><br/>
    <h3><?php _e("Dev4Press Important Links", "gd-bbpress-widgets"); ?></h3>
    <a target="_blank" href="http://twitter.com/milangd">Dev4Press <?php _e("on", "gd-bbpress-widgets"); ?> Twitter</a><br/>
    <a target="_blank" href="http://www.facebook.com/dev4press">Dev4Press Facebook <?php _e("Page", "gd-bbpress-widgets"); ?></a><br/>
    <a target="_blank" href="http://d4p.me/d4plus">Dev4Press Google+ <?php _e("Page", "gd-bbpress-widgets"); ?></a>
</div>
<div class="d4p-clear"></div>
<div class="d4p-copyright">
    Dev4Press &copy; 2008 - 2012 <a target="_blank" href="http://www.dev4press.com">www.dev4press.com</a> | Golden Dragon WebStudio <a target="_blank" href="http://www.gdragon.info">www.gdragon.info</a>
</div>
