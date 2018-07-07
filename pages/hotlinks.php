<?
function hotlinks_html_head(){
?>
<div class="wrap vca">
  <h1 class="wp-heading-inline"><?php echo esc_html(get_admin_page_title()); ?></h1>
    <a href="admin.php?page=vca_hotlinks&a=edit" class="page-title-action">Adicionar novo</a>

  <p>Veja abaixo todos os Hot Links já instalados no seu blog.</p>
  <?
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
<?
$current_user = wp_get_current_user();
$user_info = get_userdata($current_user->ID);
$first_name = $user_info->display_name;
$user_email = $user_info->user_email;


?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5b40c17f4af8e57442dc6b83/1chqg68fp';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
  })();

  Tawk_API.visitor = {
    name: '<?= $first_name; ?>',
    email: '<?= $user_email; ?>'
  };

</script>
<!--End of Tawk.to Script-->