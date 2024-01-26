<?php

class contact_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
	
	//admin start contact 
    function add_contact($contact_details) {
        $query = $this->db->get('contact');
        $res = $query->result();
        if ($res) {
            $id = $res[0]->contact_id;
            $this->db->update('contact', array('contact_details' => $contact_details,"date"=>date("Y-m-d h:i:s")), array('contact_id' => $id));
        } else {
            if ($this->db->insert('contact', array('contact_details' => $contact_details,"date"=>date("Y-m-d h:i:s")))) {
                
            }
        }
    }
	
	

    function GetcontactData() {
        $query = $this->db->get('contact');
        $res = $query->result();
        return $res;
    }	
//end contact

//site messages	

    function insert_message($name, $mobile, $email, $title, $message) {
     
            $query = $this->db->insert("messages", array('name' => $name, 'mobile' => $mobile, 'email' => $email, 'title' => $title, 'message' => $message, "date"=>date("Y-m-d h:i:s")),1);
            $res = 'Your message sent';
            return $res;
        
    }
	
// start admin inbox 	
   	function GetALLMessages($limit=0,$offset=0) {
	    $this->db->order_by("message_id", "desc");
		if($limit!=0){
			$query = $this->db->get('messages',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('messages');
			$res = $query->result();
			return $res;
        }
	
    } 
    
    function count_inbox() { 
    return $this->db->count_all_results('messages'); 
    }

    function GetMessageByID($id) {
        $query = $this->db->get_where("messages", array("message_id" => $id));
        $res = $query->result();
        return $res;
    }

    function delete_message($id) {
        $this->db->delete("messages", array("message_id" => $id));
    }
  //end inbox	
  
// start  newsletter 	
	
	function insert_email_newsletter($name,$email) {
       
            $check = $this->db->get_where('newsletter', array('email' => $email), 1);
            if ($check->num_rows() > 0) {
				$res = 'FALSE';
				return $res;
            } else {
                $query = $this->db->insert("newsletter", array('email' => $email,'name' => $name));
                $this->db->query("update newsletter set date = NOW() where email = '$email'");
                $res = 'TURE';
                return $res;
            }
        
    }
// start admin newsletter 	
	
	function GetALLNewsletter($limit=0,$offset=0) {
	    $this->db->order_by("newsletter_id", "desc");
		if($limit!=0){
			$query = $this->db->get('newsletter',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('newsletter');
			$res = $query->result();
			return $res;
        }
	}	
	    
	function count_Newsletter() { 
		return $this->db->count_all_results('newsletter'); 
    }

   	function delete_newsletter($id) {
        $this->db->delete("newsletter", array("newsletter_id" => $id));
    }
	
}

?>
