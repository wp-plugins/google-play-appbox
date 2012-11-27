<?php
/*
Plugin Name: Google Play Appbox
Plugin URI: http://www.blogtogo.de/eine-eigenentwicklung-google-play-appbox-als-wordpress-plugin/
Description: "Google Play Appbox" ermöglicht es, via Shortcode schnell und einfach Android-App-Details in Artikeln oder auf Seiten anzuzeigen.
Author: Marcel Schmilgeit
Version: 1.1.2
Author URI: http://www.blogtogo.de
*/
	
function app_store_url() {
	global $itemInfo;
	foreach($itemInfo['General'] as $appdata) echo($appdata->app_store_url);
}
	
function app_store_url_enc() {
	global $itemInfo;
	foreach($itemInfo['General'] as $appdata) echo(urlencode($appdata->app_store_url));
}
	
function banner_image() {
	global $itemInfo;
	foreach($itemInfo['General'] as $appdata) echo($appdata->banner_image);
}
	
function banner_icon() {
	global $itemInfo;
	foreach($itemInfo['General'] as $appdata) echo($appdata->banner_icon);
}
	
function app_author() {
	global $itemInfo;
	foreach($itemInfo['General'] as $appdata) echo($appdata->app_author);
}
	
function author_store_url() {
	global $itemInfo;
	foreach($itemInfo['General'] as $appdata) echo($appdata->author_store_url);
}
	
function app_price() {
	global $itemInfo;
	foreach($itemInfo['General'] as $appdata) echo($appdata->app_price);
}
	
function os_required() {
	global $itemInfo;
	foreach($itemInfo['General'] as $appdata) echo($appdata->os_required);
}
	
function app_title() {
	global $itemInfo;
	foreach($itemInfo['General'] as $appdata) echo($appdata->app_title);
}

function app_screenshots() {
	global $itemInfo;
	foreach($itemInfo['ScreenShots'] as $appshots) echo('<li><img src="'.$appshots->screen_shot.'" alt="" /></li>');
}

function output_simplebox($itemInfo) {
	global $itemInfo;
    ob_start();
    include 'tpl/simple.php';
    $tpl = ob_get_contents();
    ob_end_clean();
	if($itemInfo !== 0) return($tpl);
}

function output_banner($itemInfo) {
	global $itemInfo;
    ob_start();
    include 'tpl/banner.php';
    $tpl = ob_get_contents();
    ob_end_clean();
	if($itemInfo !== 0) return($tpl);
}

function output_screenshots($itemInfo) {
	global $itemInfo;
    ob_start();
    include 'tpl/screenshots.php';
    $tpl = ob_get_contents();
    ob_end_clean();
	if($itemInfo !== 0) return($tpl);
}

function diewaendesindweissweissundmassiv($atts, $content = null) {
	global $itemInfo;
	@$a = shortcode_atts('', $atts);
	extract($a);
	include_once('inc/playStoreApi.php');
	$class_init = new PlayStoreApi;
	if(($atts[0] == 'banner') || ($atts[0] == 'screenshots') || ($atts[0] == 'simple'))	$item_id = $atts[1];
	else $item_id = $atts[0];
	$itemInfo = $class_init->itemInfo($item_id);
	if($itemInfo !== 0) {
		if($atts[0] == 'banner') return output_banner($itemInfo);
		elseif($atts[0] == 'screenshots') return output_screenshots($itemInfo);
		else return output_simplebox($itemInfo);
	}
	else return('<div class="appcontainer"><span class="error">Die App konnte bei Google Play <b>nicht</b> gefunden werden. :-(</span></div>');
}

function googleplay_add_button($buttons) {
	array_push($buttons, "separator", "GooglePlayButton");
	return $buttons;
}

function googleplay_register($plugin_array) {
	$plugin_array["googleplay"] = plugins_url('button/editor_plugin.js', __FILE__);
	return $plugin_array;
}
 
add_filter('mce_external_plugins', "googleplay_register");
add_filter('mce_buttons', 'googleplay_add_button', 0);

wp_register_style('googleplayappbox', plugins_url('css/styles.min.css', __FILE__), array(), '1.0.0', 'screen');
wp_enqueue_style('googleplayappbox');
  
add_shortcode('googleplay', 'diewaendesindweissweissundmassiv');

add_filter('the_content_feed', 'do_shortcode');

?>