<?php
/*
Plugin Name: VocêAfiliado
Description: Plugin oficial do VocêAfiliado.
Author: voceafiliado.com
Version: 1.0
Author URI: http://www.voceafiliado.com
*/


//Itens do Menu
include(plugin_dir_path( __FILE__ ) . 'pages/hotlinks.php');


class vca_pg_hotlinks{

  function __construct(){

    add_action( 'admin_menu', array( $this, 'admin_menu' ) );

  }

  function admin_menu(){

    add_menu_page('VocêAfiliado', 'VocêAfiliado', 'manage_options', 'vca', array($this, 'page_master'), plugins_url( 'images/menu-ico.png',  plugin_dir_path( __FILE__ ) ), 50);

    add_submenu_page('vca', '[VCA] Hot Links', '[VCA] Hot Links', 'manage_options', 'vca_hotlinks', array($this, 'page_hotlinks'));
  }

  function  page_master() {
    echo '>> aqui virá uma página divulgando o produto <<';
  }


  function  page_hotlinks() {
    include(plugin_dir_path( __FILE__ ) . 'pages/hotlinks.php');
  }

}
new vca_pg_hotlinks;


/* Adicionará o codigo */
/*
add_action( 'wp_loaded', function () {
  if ( !is_admin() ) {
    echo('<!-- XXX -->');
  }
});
*/
?>
