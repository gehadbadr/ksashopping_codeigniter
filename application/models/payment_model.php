<?php

class payment_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

  	
	function GetAllpayment($limit=0,$offset=0) {
	    $this->db->order_by("sort", "desc");
		if($limit!=0){
			$query = $this->db->get('payment',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('payment');
			$res = $query->result();
			return $res;
        }
	
    }
    
    function count_payment() { 
    return $this->db->count_all_results('payment'); 
    }
	
    function GetpaymentByID($id) {
        $query = $this->db->get_where('payment',array('payment_id' => $id));
        $res = $query->result();
        return $res;
    }
    
	
	function Getprev($sort){
            
        $query=$this->db->query("select sort from payment where  sort < $sort ORDER BY sort DESC LIMIT 1"); 
            
        $res = $query->result();
        return $res;
    }
    
    function Getnext($sort){
            
        $query=$this->db->query("select sort from payment where sort > $sort ORDER BY sort ASC  LIMIT 1"); 
            
        $res = $query->result();
        return $res;
    }
	
	function update_sort($nextsort,$temp_sort,$sort){
            
        $query=$this->db->query("UPDATE payment SET sort = $temp_sort WHERE sort = $nextsort " ); 
		$query2=$this->db->query("UPDATE payment SET sort = $nextsort WHERE sort = $sort " ); 
        $query3=$this->db->query("UPDATE payment SET sort = $sort WHERE sort = $temp_sort " );        

	}	
        
    function Getsort($n){
            
        $query=$this->db->query("select sort from payment ORDER BY sort DESC LIMIT $n,1"); 
            
        $res = $query->result();
        return $res;
    }
	
	function insert_message_pay($name, $mobile, $email, $bank, $date, $named, $payment,$note) {
      
            $query = $this->db->insert("pay_confirm", array('name' => $name, 'mobile' => $mobile, 'email' => $email, 'bank' => $bank, 'date' => $date, 'named' => $named, 'payment' => $payment, 'note' => $note, 'date1' => 'NOW()'),1);
            $res = 'Your message sent';
            return $res;
        
    }
	
	// start admin_payment  
	
	function add_payment($name, $content, $path,$thumb) {
        
        $this->db->order_by("sort", "desc");
            $query = $this->db->get('payment',1);
			if($query->result()){
				foreach ($query->result() as $row ) {
				$sort_value = $row->sort +1; 
				}
			}else{
			    $sort_value = 1;
			}
            $this->db->insert('payment', array('name' => $name,'path' => $path,'thumb' =>$thumb,'content' => $content,'sort' => $sort_value,'date' =>date("Y-m-d h:i:s")), 1);
            
    }
    
 /*  
    function delete_payment($id) {
		 $query = $this->db->get_where('payment', array('payment_id' => $id), 1);
           
				foreach ($query->result() as $row ) {
					$path = $row->path;
					$thumb = $row->thumb;
				
						if($path!='images/images/no_image.jpg'){
							unlink($path);
							unlink($thumb);
							
							
						}
				}
        $this->db->query("delete from payment where payment_id = '$id'");

    }
*/
    function delete_payment($id) {
		$path_to_images = $this->db->get_where("payment", array("payment_id" => $id));
        foreach ($path_to_images->result() as $row) {
					$image = $row->path;
					$thumb = $row->thumb;

					unlink($image);
					unlink($thumb);
		}			
        $this->db->delete("payment", array("payment_id" => $id), 1);
    }
	
    function edit_payment($id, $name, $content, $path,$thumb) {
		 $query = $this->db->get_where('payment', array('payment_id' => $id), 1);
           
				foreach ($query->result() as $row ) {
					$old_path = $row->path;
					$old_thumb = $row->thumb;
				
						if($path!= $old_path ){
							unlink($old_path);
							unlink($old_thumb);
							
							
						}
				}
        $this->db->where('payment_id', $id);
        $this->db->update("payment", array('name' => $name,'path' => $path,'thumb' =>$thumb,'content' => $content,'date' =>date("Y-m-d h:i:s")));
    }
    
//end payment	
	
    
    
  
}
?>
