<?php
function hotlinks_html_head(){
?>
<div class="wrap vca">
  <h1 class="wp-heading-inline"><?php echo esc_html(get_admin_page_title()); ?></h1>
    <a href="admin.php?page=vca_hotlinks&a=edit" class="page-title-action">Adicionar novo</a>

  <p>Veja abaixo todos os Hot Links já instalados no seu blog.</p>
  <?php
  }

  if(empty(@$_GET['a']))
      include(VCA_PLUGIN_PATH . 'pages/hotlinks.grid.php');

  elseif(@$_GET['a'] == 'edit')
    include(VCA_PLUGIN_PATH . 'pages/hotlinks.form.php');

  elseif(@$_GET['a'] == 'post')
    include(VCA_PLUGIN_PATH . 'pages/hotlinks.post.php');

  elseif(@$_GET['a'] == 'del')
    include(VCA_PLUGIN_PATH . 'pages/hotlinks.del.php');

  ?>

</div>
<?php
get_suporte();
?>