<?php

/*
Plugin Name: WP-ImgCode
Plugin URI: http://www.dualface.com/
Description: 图形验证码
Version: 1.0.0
Author: dualface
Author URI: http://www.dualface.com/
*/

if(!class_exists('wp_imgcode')):

class wp_imgcode
{
    var $version = '1.0.0';
    var $plugin_dir = 'wp-content/plugins/wp-imgcode';

    function wp_imgcode() {
        @session_start();
        add_action('comment_form', array(& $this, 'edit_comment_blog'));
        add_filter('preprocess_comment', array(& $this, 'preprocess_comment'));
    }

    function edit_comment_blog() {
        echo <<<END
<p>
<img src="{$this->plugin_dir}/imgcode.php" border="0" /><br />
<input type="text" name="imgcode" id="imgcode" size="6" tabindex="6" />
<label for="url"><small>ImgCode</small></label>
</p>
END;
    }
    function preprocess_comment($commentdata) {

        if ($_POST['imgcode'] != $_SESSION['IMGCODE'] || time() >= $_SESSION['IMGCODE_EXPIRED']) {
            die( __('Error: please enter a valid imgcode.') );
        }
        unset($_SESSION['IMGCODE']);
        unset($_SESSION['IMGCODE_EXPIRED']);
        return $commentdata;
    }
}


endif;

/**
 * Instatiate the global object.
 */
if( !isset($wp_imgcode) )
{
	$wp_imgcode =& new wp_imgcode();
}


?>