<?
global $wpdb;

if(!empty(@$_GET['id'])){
  $sql = 'SELECT ID, Page, `Key` FROM ' . $wpdb->prefix . 'vca_hotlinks HL';
  $sql .= ' WHERE ID = ' . $_GET['id'];

  $data = $wpdb->get_results( $sql, 'ARRAY_A' );

  if(count($data) <=0)
    die('Aconteceu alguma coisa de errado!');

  $reg = $data[0];

}

//páginas...
$sql = "SELECT * FROM `" . $wpdb->prefix . "posts` WHERE post_type = 'page' ORDER BY post_title ASC";
$paginas = $wpdb->get_results( $sql, 'ARRAY_A' );

hotlinks_html_head();
?>
<form action="admin.php?page=vca_hotlinks&a=post" method="post">

  <?
  if(!empty(@$_GET['id'])){
    ?>
    <input type="hidden" name="ID" value="<?= $_GET['id']; ?>">
    <?
  }
  ?>
<table class="form-table">

  <tbody><tr>
    <th scope="row"><label for="blogname">Página</label></th>
    <td>

      <select name="Page" id="Page" required>
        <option value="" ></option>
        <?
        foreach($paginas as $pagina) {
          ?>
          <option value="<?= $pagina['ID']; ?>" <?= ($pagina['ID'] == @$reg['Page'])?'selected':null; ?> ><?= $pagina['post_title']; ?></option>
          <?
        }
        ?>


    </td>
  </tr>

  <tr>
    <th scope="row"><label for="key">Key</label></th>
    <td><input name="Key" type="text" id="Key" maxlength="32" aria-describedby="tagline-description" value="<?= @$reg['Key']; ?>" class="regular-text" required>
      <p class="description" id="tagline-description">Insira o key da sua Hot Link (você encontra esse key no <a href="https://app.voceafiliado.com" target="_blank">App da VocêAfiliado</a>.</p></td>
  </tr>

  </tbody>

  </table>

  <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Salvar alterações"></p>
</form>