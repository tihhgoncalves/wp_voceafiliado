<?
if( ! class_exists( 'WP_List_Table' ) ) {
  require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class vca_grid_hotlink extends WP_List_Table
{
  /**
   * Prepare the items for the table to process
   *
   * @return Void
   */
  public function prepare_items()  {

    $columns = $this->get_columns();
    $hidden = $this->get_hidden_columns();
    $sortable = $this->get_sortable_columns();
    $data = $this->table_data();
    usort( $data, array( &$this, 'sort_data' ) );
    $perPage = 2;
    $currentPage = $this->get_pagenum();
    $totalItems = count($data);
    $this->set_pagination_args( array(
      'total_items' => $totalItems,
      'per_page'    => $perPage
    ) );
    $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);
    $this->_column_headers = array($columns, $hidden, $sortable);
    $this->items = $data;
  }


  public function get_columns()
  {
    $columns = array(
      'ID'          => 'ID',
      'Page'        => 'Página',
      'Key'         => 'Key',
      'Actions'     => 'Ações'
    );
    return $columns;
  }

  /**
   * Define which columns are hidden
   *
   * @return Array
   */
  public function get_hidden_columns()
  {
    return array();
  }


  public function get_sortable_columns()
  {
    return array('title' => array('title', false));
  }


  private function table_data() {

    global $wpdb;

    $sql = 'SELECT HL.ID, PST.post_title Page, PST.ID post_id, HL.Key, PST.post_title FROM ' . $wpdb->prefix . 'vca_hotlinks HL';
    $sql .= ' JOIN ' . $wpdb->prefix . 'posts PST ON(PST.ID = HL.Page)';

    $data = $wpdb->get_results( $sql, 'ARRAY_A' );



    return $data;
  }


  public function column_default( $item, $column_name )
  {
    switch( $column_name ) {
      case 'ID':
      case 'Key':
        return $item[ $column_name ];

      case 'Page':
        $link = get_permalink($item['post_id']);
        return '<a href="' . $link . '" target="_blank">' . $item[ $column_name ] . '</a>';
      case'Actions':
        $link_editar = 'admin.php?page=vca_hotlinks&a=edit&id=' . $item['ID'];
        return '<a href="' . $link_editar . '">Editar</a> | <a href="#">Excluir</a>';
      default:
        return $column_name . '>>' . print_r( $item, true ) ;
    }
  }


  private function sort_data( $a, $b )
  {
    // Set defaults
    $orderby = 'title';
    $order = 'asc';
    // If orderby is set, use this as the sort column
    if(!empty($_GET['orderby']))
    {
      $orderby = $_GET['orderby'];
    }
    // If order is set use this as the order
    if(!empty($_GET['order']))
    {
      $order = $_GET['order'];
    }
    $result = strcmp( $a[$orderby], $b[$orderby] );
    if($order === 'asc')
    {
      return $result;
    }
    return -$result;
  }
}
hotlinks_html_head();
$vca_grid_hotlink = new vca_grid_hotlink();
$vca_grid_hotlink->prepare_items();
$vca_grid_hotlink->display();

?>