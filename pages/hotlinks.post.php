<?

global $wpdb;
$post = new tihh_db_mysql_sql_post($wpdb->prefix . 'vca_hotlinks');

if(!empty(@$_POST['ID']))
  $post->id = $_POST['ID'];

$post->AddFieldInteger('Page', $_POST['Page']);
$post->AddFieldString('Key', $_POST['Key']);

$sql = $post->GetSQL();
//die($sql);
$wpdb->query($sql);


//
include(VCA_PLUGIN_PATH . 'pages/hotlinks.grid.php');

?>