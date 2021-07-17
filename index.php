<?php

/*
  Plugin Name:Reacts
  Version: 1.0
  Author: SAlman
  Author URI: https://www.ghf.com
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once plugin_dir_path(__FILE__) . 'inc/generateHTML.php';

class NewReactBlock {
  function __construct() {
    add_action('init', [$this, 'onInit']);

  }

 

  function onInit() {
    wp_register_script('reactScript', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-i18n', 'wp-editor'));
    wp_register_style('reactStyle', plugin_dir_url(__FILE__) . 'build/index.css');

    register_block_type('newplugin/reacts', array(
      'render_callback' => [$this, 'renderCallback'],
      'editor_script' => 'reactScript',
      'editor_style' => 'reactStyle'
    ));
  }

  function renderCallback($attributes) {
   if($attributes['postId']){
    return generateHTML($attributes['postId']);
   }
   else{
     return NULL;
   }
  }

}


$featuredProfessor = new NewReactBlock();