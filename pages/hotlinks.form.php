<?
global $wpdb;

if(!empty(@$_GET['id'])){
  $sql = 'SELECT ID, Pages, `Key` FROM ' . $wpdb->prefix . 'vca_hotlinks HL';
  $sql .= ' WHERE ID = ' . $_GET['id'];

  $data = $wpdb->get_results( $sql, 'ARRAY_A' );

  if(count($data) <=0)
    die('Aconteceu alguma coisa de errado!');

  $reg = $data[0];

  $pages_ids = explode(',', $reg['Pages']);

}

//páginas...
$sql = "SELECT * FROM `" . $wpdb->prefix . "posts` ";
$sql .= " WHERE (post_type = 'page' OR post_type = 'post') && post_status = 'publish'";
$sql .= " ORDER BY post_type ASC, post_title ASC";

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

      <select name="Pages[]" id="Pages" required multiple>
        <?
        foreach($paginas as $pagina) {

          switch($pagina['post_type']) {
            case 'page':
              $tipo = 'Página';
              break;
            case 'post':
              $tipo = 'Artigo';
              break;
          }

          $selected = null;
          if(!empty(@$_GET['id'])){

            if((array_search($pagina['ID'],$pages_ids) !== false))
              $selected = 'selected';
          }
          ?>
          <option value="<?= $pagina['ID']; ?>" <?= $selected ?> ><?= '[' . $tipo . '] ' . $pagina['post_title'] . ($pagina['post_type'] == 'post'?' - ' . get_the_date('d/m/Y', $pagina['ID']):null); ?></option>
          <?
        }
        ?>
      </select>
      <p class="description" id="tagline-description">Para selecionar mais de um registro, utiliza as teclas Ctrl e Shift.</p></td>

    </td>
  </tr>

  <tr>
    <th scope="row"><label for="key">Key</label></th>
    <td><input name="Key" type="text" id="Key" maxlength="32" aria-describedby="tagline-description" value="<?= @$reg['Key']; ?>" class="regular-text" required>
      <p class="description" id="tagline-description">Insira o key da sua Hot Link (você encontra esse key no <a href="https://app.voceafiliado.com" target="_blank">App da VocêAfiliado</a>.</p></td>
  </tr>

  </tbody>

  </table>

  <p class="submit">
    <input type="submit" name="submit" id="submit" class="button button-primary" value="Salvar">
    <a href="admin.php?page=vca_hotlinks" class="button ">Voltar</a>
  </p>
</form>