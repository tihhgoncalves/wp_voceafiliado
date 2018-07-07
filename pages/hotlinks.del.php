<?php

global $wpdb;

$sql = "DELETE FROM `" . $wpdb->prefix . "vca_hotlinks` ";
$sql .= " WHERE ID = " . $_GET['id'];

$wpdb->query($sql);

include(VCA_PLUGIN_PATH . 'pages/hotlinks.grid.php');
?>