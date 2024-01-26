<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Payment extends CI_Model{ 
     
    function __construct() { 
        $this->transTable = 'payments'; 
    } 
     
    /* 
     * Fetch payment data from the database 
     * @param id returns a single record if specified, otherwise all records 
     */ 
    public function getPayment($conditions = array()){ 
        $this->db->select('*'); 
        $this->db->from($this->transTable); 
         
        if(!empty($conditions)){ 
            foreach($conditions as $key=>$val){ 
                $this->db->where($key, $val); 
            } 
        } 
         
        $result = $this->db->get(); 
        return ($result->num_rows() > 0)?$result->row_array():false; 
    }
	/*public function getPayment($txn_id){ 
    $query = $this->db->get_where('payments',array('txn_id' => $txn_id));
        $res = $query->result();
		if ($query->result() == null) {
            return null;
        } else {
            return $res;
        }
    } 
     */
    /* 
     * Insert payment data in the database 
     * @param data array 
     */ 
	/*public function insertTransaction($user_id,$product_id,$txn_id,$payment_gross,$currency_code,$payer_name,$payer_email,$status){ 
        $insert = $this->db->insert('payments', array("user_id" => $user_id,"product_id" => $product_id,"txn_id" => $txn_id,"payment_gross" => $payment_gross,"currency_code" => $currency_code,"payer_name" => $payer_name,"payer_email" => $payer_email, "status" => $status,"date"=>date("Y-m-d h:i:s"))); 
        return $insert?true:false; 
    } */
      
    public function insertTransaction($data){ 
        $insert = $this->db->insert($this->transTable,$data); 
        return $insert?true:false; 
    } 
     
}