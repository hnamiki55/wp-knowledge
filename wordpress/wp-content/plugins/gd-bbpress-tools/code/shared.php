<?php

if (!defined('ABSPATH')) exit;

if (!class_exists('gdbbp_Error')) {
    class gdbbp_Error {
        var $errors = array();

        function __construct() { }

        function add($code, $message, $data) {
            $this->errors[$code][] = array($message, $data);
        }
    }
}

if (!function_exists('d4p_bbpress_get_user_roles')) {
    /**
     * Get valid roles for forums based on bbPress version
     *
     * @return array list of roles
    */
    function d4p_bbpress_get_user_roles() {
        $roles = array();

        if (d4p_bbpress_version() < 22) {
            global $wp_roles;

            foreach ($wp_roles->role_names as $role => $title) {
                $roles[$role] = $title;
            }
        } else {
            $dynamic_roles = bbp_get_dynamic_roles();

            foreach ($dynamic_roles as $role => $obj) {
                $roles[$role] = $obj['name'];
            }
        }

        return $roles;
    }
}

if (!function_exists('d4p_bbpress_version')) {
    /**
     * Get version of the bbPress.
     *
     * @param string $ret what version format to return: code or version
     * @return mixed version value
    */
    function d4p_bbpress_version($ret = 'code') {
        if (function_exists('bbpress')) {
            $bbp = bbpress();
        } else {
            global $bbp;
        }

        if (isset($bbp->version)) {
            if ($ret == 'code') {
                return substr(str_replace('.', '', $bbp->version), 0, 2);
            } else {
                return $bbp->version;
            }
        }

        return null;
    }
}

if (!function_exists('d4p_is_bbpress')) {
    /**
    * Check if the current page is forum, topic or other bbPress page.
    *
    * @return bool true if the current page is the forum related
    */
    function d4p_is_bbpress() {
        $is = false;

        if (function_exists('bbp_get_forum_id')) {
            $is = bbp_get_forum_id() > 0 || bbp_get_reply_id() > 0 || bbp_get_topic_id() > 0;

            if (!$is) {
                global $template;

                $templates = array('single-reply-edit.php', 'single-topic-edit.php');
                $file = pathinfo($template, PATHINFO_BASENAME);
                $is = in_array($file, $templates);
            }
        }

        return apply_filters('d4p_is_bbpress', $is);
    }
}

if (!function_exists('d4p_is_user_moderator')) {
    /**
    * Checks to see if the currently logged user is moderator.
    *
    * @return bool is user moderator or not
    */
    function d4p_is_user_moderator() {
        global $current_user;

        if (is_array($current_user->roles)) {
            return in_array('bbp_moderator', $current_user->roles);
        } else {
            return false;
        }
    }
}

if (!function_exists('d4p_is_user_admin')) {
    /**
    * Checks to see if the currently logged user is administrator.
    *
    * @return bool is user administrator or not
    */
    function d4p_is_user_admin() {
        global $current_user;

        if (is_array($current_user->roles)) {
            return in_array('administrator', $current_user->roles);
        } else {
            return false;
        }
    }
}

if (!function_exists('d4p_bbp_is_role')) {
    function d4p_bbp_is_role($setting_name) {
        global $gdbbpress_tools;
        $allowed = false;

        if (current_user_can('d4p_bbpt_'.$setting_name)) {
            $allowed = true;
        } else if (is_super_admin()) {
            $allowed = $gdbbpress_tools->o[$setting_name.'_super_admin'] == 1;
        } else if (is_user_logged_in()) {
            $roles = isset($gdbbpress_tools->o[$setting_name.'_roles']) ? $gdbbpress_tools->o[$setting_name.'_roles'] : null;

            if (is_null($roles)) {
                $allowed = true;
            } else if (is_array($roles)) {
                global $current_user;

                if (is_array($current_user->roles)) {
                    $matched = array_intersect($current_user->roles, $roles);
                    $allowed = !empty($matched);
                }
            }
        }

        return $allowed;
    }
}

function d4p_bbt_o($name) {
    global $gdbbpress_tools;
    return $gdbbpress_tools->o[$name];
}

?>