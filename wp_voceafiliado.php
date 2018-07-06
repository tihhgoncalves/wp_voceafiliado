<?php
/*
Plugin Name: VocêAfiliado
Description: Plugin oficial do VocêAfiliado.
Author: voceafiliado.com
Version: 1.0
Author URI: http://www.voceafiliado.com
*/

define('VCA_PLUGIN_URL', plugins_url('/',   __FILE__ ));
define('VCA_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

include(VCA_PLUGIN_PATH . 'db.php');
include(VCA_PLUGIN_PATH . 'incs/tihh.php.obj.db.mysql.sql.post.php');
include(VCA_PLUGIN_PATH . 'print_script.php');

add_action('admin_enqueue_scripts', 'add_estilos');
register_activation_hook( __FILE__, 'vca_verificacoes_de_db' );

function my_function() { ?>
  <script>
    alert('111');
  </script>
  <?php
}


class vca_pg_hotlinks{

  function __construct(){


    add_action( 'admin_menu', array( $this, 'admin_menu' ) );

  }

  function admin_menu(){

    add_menu_page('VocêAfiliado', 'VocêAfiliado', 'manage_options', 'vca', array($this, 'page_master'), VCA_PLUGIN_URL . 'images/menu-ico.png', 50);

    add_submenu_page('vca', 'Hot Links', 'Hot Links', 'manage_options', 'vca_hotlinks', array($this, 'page_hotlinks'));
  }

  function  page_master() {
    echo '>> aqui virá uma página divulgando o produto <<';
  }


  function  page_hotlinks() {
    include(VCA_PLUGIN_PATH . 'pages/hotlinks.php');
  }

}
new vca_pg_hotlinks;


/* Adiciona CSS */
function add_estilos() {
  wp_enqueue_style( 'vca_base', VCA_PLUGIN_URL . 'css/base.css');
}
?>
