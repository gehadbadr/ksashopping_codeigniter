<?php

class ads_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function GetAllAds() {
        $query = $this->db->get('ads');
        $res = $query->result();
        return $res;
    }
	
	

}

?>
