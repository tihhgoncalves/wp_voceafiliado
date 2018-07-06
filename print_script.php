<?php



//print_r($data);exit;


  add_action( 'template_redirect', function () {

    if (!is_admin()) {

      global $wpdb;

      $sql = 'SELECT ID, Page, `Key` FROM ' . $wpdb->prefix . 'vca_hotlinks';
      $sql .= ' WHERE Page = ' . get_the_ID();



      $data = $wpdb->get_results($sql, 'ARRAY_A');

      if (count($data) > 0) {

        $page_id = $data[0]['Page'];
        $key = $data[0]['Key'];


        /* SCRIPT - INÍCIO */
        $hl_url = 'http://hotlink.voceafiliado.com/';
        $hl_curl = curl_init($hl_url);
        curl_setopt($hl_curl, CURLOPT_RETURNTRANSFER, true);
        $hl_vars = array_merge($_SERVER, array('key' => $key));
        curl_setopt($hl_curl, CURLOPT_POSTFIELDS, http_build_query($hl_vars, '', '&'));
        $html = curl_exec($hl_curl);
        curl_close($hl_curl);
        if (!empty($html)) {
          die($html);
        }
        /* SCRIPT - FIM */


      };
    }
  })
?>