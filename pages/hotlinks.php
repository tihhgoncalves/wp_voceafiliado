<?
function hotlinks_html_head(){
?>
<div class="wrap vca">
  <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

  <p>Veja abaixo todos os Hot Links já instalados no seu blog.</p>
  <?
  }

  if(empty(@$_GET['a']))
      include(VCA_PLUGIN_PATH . 'pages/hotlinks.grid.php');

  elseif(@$_GET['a'] == 'edit')
    include(VCA_PLUGIN_PATH . 'pages/hotlinks.form.php');

  elseif(@$_GET['a'] == 'post')
    include(VCA_PLUGIN_PATH . 'pages/hotlinks.post.php');

  ?>

</div>