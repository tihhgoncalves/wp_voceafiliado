<?

/* Instalaчуo */
function vca_verificacoes_de_db() {

    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'vca_hotlinks';

    $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
		ID mediumint(9) NOT NULL AUTO_INCREMENT,
		Page varchar(100) NOT NULL,
		`Key` varchar(32) NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

?>