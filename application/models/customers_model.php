<?php 

class Customers_model extends CI_Model {

    function Customers_model()
    {
        parent::__construct();
    }

    
  
    function check_login($email, $password) {
        $md5_password = md5($password);
        $query_str = "SELECT * FROM customers WHERE email = ? AND password = ?";
        $result = $this->db->query($query_str, array($email, $md5_password));
        if ($result->num_rows() == 1) {
            return $result->row(0)->customer_id;
        } else {
            return FALSE;
        }
    }
	
// start forgetpass 
	
	 function check_email($email) {
        $query = $this->db->get_where("customers", array("email" => $email));
        $res = $query->result();
        if ($res) {
            return $res;
        }else
            return FALSE;
    }
	
	function update_customer_password($id,$newpassword){
		$this->db->where('customer_id',$id);
		if($this->db->update('customers',array("password" => $newpassword)))
		{
			return TRUE;
		}else{

			return FALSE;
		}
	}

//end forgetpass	
	
    function GetCustomerByID($id) {
        $check = $this->db->get_where('customers', array('customer_id' => $id));
        if ($check->result()) {
            $query = $this->db->get_where('customers', array('customer_id' => $id));
            $res = $query->result();
            return $res;
        }else
            return false;

    }
	
	function add_customer($fname,$lname, $password, $email) {
		if (!$this->check_email($email)) {
            $res =$this->db->insert("customers", array('fname' => $fname,'lname' => $lname, 'password' => $password, 'email' => $email,"date"=>date("Y-m-d h:i:s")));
			if ($res) {
				$data['this_customer'] = $this->check_email($email);
				$customer_id = $data['this_customer'][0]->customer_id;
					return $customer_id;
				
			} else {
				return FALSE;
			}
		} else {
            return FALSE;
        }
    }
	
	function edit_customer($id,$fname,$lname,$mobile,$gender,$dob) {
		$this->db->where('customer_id', $id);
		$res =$this->db->update("customers", array('fname' => $fname,'lname' => $lname, 'mobile' => $mobile, 'gender' => $gender, 'dob' => $dob,"date"=>date("Y-m-d h:i:s")));
		if ($res) {
			return TRUE;
		}else{
			return FALSE;
		}	
    }
	
	function edit_customer_pw($id,$password) {
		$this->db->where('customer_id', $id);
		$res =$this->db->update("customers", array('password' => $password));
		if ($res) {
			return TRUE;
		}else{
			return FALSE;
		}	
    }
//---  start address  ----
	function add_customer_address($customer_id,$governorate,$city,$region,$street,$building,$floor,$flat,$mobile,$telephone,$type,$notes){
        $res =$this->db->insert("customer_address", array('customer_id_fk' => $customer_id,'governorate' => $governorate, 'city' => $city, 'region' => $region, 'street' => $street, 'building' => $building, 'floor' => $floor, 'flat' => $flat, 'mobile' => $mobile, 'telephone' => $telephone, 'type' => $type,'notes' => $notes,"date"=>date("Y-m-d h:i:s")));
	}
	
	function edit_customer_address($id,$governorate,$city,$region,$street,$building,$floor,$flat,$mobile,$telephone,$type,$notes){
		$this->db->where('address_id', $id);
		$res =$this->db->update("customer_address", array('address_id' => $id,'governorate' => $governorate, 'city' => $city, 'region' => $region, 'street' => $street, 'building' => $building, 'floor' => $floor, 'flat' => $flat, 'mobile' => $mobile, 'telephone' => $telephone, 'type' => $type,'notes' => $notes,"date"=>date("Y-m-d h:i:s")));
		if ($res) {
			return TRUE;
		}else{
			return FALSE;
		}	
    }
	
	function delete_address($id) {
        $this->db->delete("customer_address", array("address_id" => $id));
    } 
	
	function GetaddressByID($id) {
        $query = $this->db->get_where("customer_address", array("address_id" => $id));
        $res = $query->result();
        return $res;
    }

	function GetaddressByCustomerID($id,$customer_id) {
        $query = $this->db->get_where("customer_address", array("address_id" => $id,"customer_id_fk" => $customer_id));
        $res = $query->result();
        return $res;
    }

	function GetAlladdresses($id,$limit=0,$offset=0){
		if($limit!=0){
                if(!$offset){
              $offset=0;  
            }
			$query=$this->db->query("select * from customer_address where  customer_id_fk = $id order by date DESC LIMIT $offset, $limit"); 
				
			$res = $query->result();
			return $res;
		
		}else{
			$query=$this->db->query("select * from customer_address where  customer_id_fk = $id order by date DESC"); 
				
			$res = $query->result();
			return $res;
			}
    }
    
    function count_addresses($id) { 
          
            $query=$this->db->query("select  * from customer_address where  customer_id_fk = $id  "); 
        
            $res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
          
    }
	
//---  end address  ----
	
	
	function GetAllbuyers($limit=0,$offset=0) {
	  if(!$offset){
              $offset=0;  
            }
	 $query = $this->db->query("select * from buyers where authority <> -1 ORDER BY buyer_id DESC LIMIT $offset, $limit"); 
       $res = $query->result();
			return $res;
    }
	
	
    
 function count_buyer() { 
      $query = $this->db->query("select * from buyers where authority <> -1  ORDER BY buyer_id DESC "); 
     $res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
    }
	
	function GetAllconfirm_buyer($limit=0,$offset=0) {
	   if(!$offset){
              $offset=0;  
            }
	 $query = $this->db->query("select * from buyers where authority = -1 ORDER BY buyer_id DESC LIMIT $offset, $limit"); 
       $res = $query->result();
			return $res;
	}
	
	
    
 function count_confirm_buyer() { 
     $query = $this->db->query("select * from buyers where authority = -1  ORDER BY buyer_id DESC "); 
     $res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
    }
/*
    function add_buyer($fname,$lname, $password, $email, $mobile,$confirm) {
        $query = $this->db->insert("buyers", array('fname' => $fname,'lname' => $lname, 'password' => $password, 'email' => $email, 'mobile' => $mobile, 'authority' => '-1','confirm' => $confirm));
        $query1 = $this->db->get("buyers");
        $buyer_id = end($query1->result());
		$this->db->query("update buyers set date = NOW() where buyer_id = $buyer_id->buyer_id");
        return $buyer_id->buyer_id;
	
	}
*/
    function delete_buyer($id) {
	   
    // $query = $this->db->get_where("products", array("buyer_id_fk" => $id));
	
	//foreach ($query->result() as $row ) {
	  // $row->product_id;
        //            $this->admin_model->delete_product($row->product_id);
          //      }
	
	
        $this->db->delete("buyers", array("buyer_id" => $id));
	

    }

    function GetbuyerByID($id) {
        $check = $this->db->get_where('buyers', array('buyer_id' => $id));
        if ($check->result()) {
            $query = $this->db->get_where('buyers', array('buyer_id' => $id));
            $res = $query->result();
            return $res;
        }else
            return false;
    }

    function edit_buyer($id,$fname, $lname, $password, $email, $mobile, $address, $country_id_fk, $city_id_fk) {
        $this->db->where('buyer_id', $id);
        $this->db->update('buyers', array('fname' => $fname,'lname' => $lname, 'password' => $password, 'email' => $email, 'mobile' => $mobile, 'address' => $address,'country_id_fk' => $country_id_fk, 'city_id_fk' => $city_id_fk));
    }
	
	function edit_authority($id,$authority) {
        $this->db->where('buyer_id', $id);
        $this->db->update('buyers', array('authority' => $authority));
    }
	
	function edit_confirm($id,$confirm) {
        $this->db->where('buyer_id', $id);
        $this->db->update('buyers', array('confirm' => $confirm));
    }

// start hotline ------------------------------------------------
	
		 function GetAllphones() {
	    $this->db->order_by("phone_id", "desc");
        $query = $this->db->get("buyer_phones");
        $res = $query->result();
        return $res;
    }
	

    function GetphoneByID($id) {
        $query = $this->db->get_where("buyer_phones", array("phone_id" => $id));
        $res = $query->result();
        return $res;
    }
	
	function GetphoneBybuyer($id) {
	
       $query = $this->db->query("SELECT * FROM buyer_phones where buyer_id_fk = $id  ");
        $res = $query->result();
        return $res;
    }

    function edit_phone($id,$phone) {
        $this->db->where('phone_id', $id);
        $this->db->update("buyer_phones", array('phone' => $phone));
		$this->db->query("update buyer_phones set date = NOW() where phone_id = $id");
    }

    function delete_phone($id) {
        $this->db->delete("buyer_phones", array("phone_id" => $id));
    }

    function add_phone($buyer_id_fk, $phone) {
        $this->db->insert("buyer_phones", array("buyer_id_fk" => $buyer_id_fk, "phone" => $phone));
    }
	
	
// start address ------------------------------------------------
	
/*
	function count_report() { 
    return $this->db->count_all_results('buyer_report'); 
    }
	
	function GetAlladdresss() {
	    $this->db->order_by("address_id", "desc");
        $query = $this->db->get("buyer_addresss");
        $res = $query->result();
        return $res;
    }
	
	function GetLastaddresss() {
	    $this->db->order_by("address_id", "desc");
        $query = $this->db->get("buyer_addresss",1);
        $res = $query->result();
        return $res;
    }
	

    function GetaddressBybuyer($id) {
	
       $query = $this->db->query("SELECT * FROM buyer_addresss where buyer_id_fk = $id  ");
        $res = $query->result();
        return $res;
    }
	
	function GetaddressBybuyerAdmin($id,$num, $offset) {
	if(!$offset){
              $offset=0;  
            }
       $query = $this->db->query("SELECT * FROM buyer_addresss where buyer_id_fk = $id  LIMIT $offset,$num ");
        $res = $query->result();
        return $res;
    }
	
	function count_addressBybuyer($buyer_id) { 
    $query = $this->db->query("SELECT * FROM buyer_addresss where buyer_id_fk = $buyer_id ");

	$res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
          
    }
/*	
	 function GetaddressByID($id) {
        $query = $this->db->get_where("buyer_addresss", array("address_id" => $id));
        $res = $query->result();
        return $res;
    }

    function edit_address($id,$name,$address) {
        $this->db->where('address_id', $id);
        $this->db->update("buyer_addresss", array("name" => $name, 'address' => $address,'date' => 'NOW()'));
		$this->db->query("update buyer_addresss set date = NOW() where address_id = $id");
        
    }

    function delete_address($id) {
        $this->db->delete("buyer_addresss", array("address_id" => $id));
    }
/*
    function add_address($buyer_id_fk,$name, $address) {
        $this->db->insert("buyer_addresss", array("buyer_id_fk" => $buyer_id_fk,"name" => $name, "address" => $address));
    }
*/
//start report

    function Getbuyerreport($id) {
	
        $query = $this->db->query("select * from buyer_report where buyer_id_fk = $id  ORDER BY report_id DESC"); 
        $res = $query->result();
        return $res;
    }
	
	    function GetreportByID($id) {
        $query = $this->db->get_where('buyer_report', array('report_id' => $id));
        $res = $query->result();
        return $res;
    }
	
	function GetAllreport($num, $offset) {
    $this->db->order_by("report_id", "desc");
        $query = $this->db->get('buyer_report', $num, $offset);
        $res = $query->result();
        return $res;
    }
    
   function count_report() { 
    return $this->db->count_all_results('buyer_report'); 
    }
	
	function add_buyer_report($buyer_id_fk,$user_id_fk ,$report) {
        $this->db->query("insert into buyer_report (buyer_id_fk,user_id_fk,comment,date) values('$buyer_id_fk','$user_id_fk','$report',NOW())");
    }
	
	
	
	function delete_report($id) {
        $this->db->query("delete from buyer_report where report_id = '$id'");    
    }
	
	
//end report
	
// start favorite ------------------------------------------------
	
   function GetallFavoriteByBuyer($id) {
	
       $query = $this->db->query("SELECT * FROM buyer_favorites where buyer_id_fk = $id  ");
        $res = $query->result();
        return $res;
    }
	
	function GetFavoriteByBuyer($id,$num, $offset) {
	if(!$offset){
              $offset=0;  
            }
       $query = $this->db->query("SELECT * FROM buyer_favorites where buyer_id_fk = $id  LIMIT $offset,$num ");
        $res = $query->result();
        return $res;
    }
	
	function count_favoriteBybuyer($buyer_id) { 
$query = $this->db->query("SELECT * FROM buyer_favorites where buyer_id_fk = $buyer_id ");

	$res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
          
    }
	
	 function GetfavoriteByID($id) {
        $query = $this->db->get_where("buyer_favorites", array("favorite_id" => $id));
        $res = $query->result();
        return $res;
    }



    function delete_favorite($id) {
        $this->db->delete("buyer_favorites", array("favorite_id" => $id));
    }

    function add_favorite($buyer_id_fk,$product_id_fk) {
        $this->db->insert("buyer_favorites", array("buyer_id_fk" => $buyer_id_fk,"product_id_fk" => $product_id_fk));
    }
	
	// start follow_market ------------------------------------------------
	
    function Getallfollow_marketByBuyer($id) {
	
       $query = $this->db->query("SELECT * FROM buyer_follow_markets where buyer_id_fk = $id  ");
        $res = $query->result();
        return $res;
    }
	
	function Getfollow_marketByBuyer($id,$num, $offset) {
	if(!$offset){
              $offset=0;  
            }
       $query = $this->db->query("SELECT * FROM buyer_follow_markets where buyer_id_fk = $id  LIMIT $offset,$num ");
        $res = $query->result();
        return $res;
    }
	
	function count_follow_marketBybuyer($buyer_id) { 
$query = $this->db->query("SELECT * FROM buyer_follow_markets where buyer_id_fk = $buyer_id ");

	$res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
          
    }
	
	 function Getfollow_marketByID($id) {
        $query = $this->db->get_where("buyer_follow_markets", array("follow_market_id" => $id));
        $res = $query->result();
        return $res;
    }



    function delete_follow_market($id) {
        $this->db->delete("buyer_follow_markets", array("follow_market_id" => $id));
    }

    function add_follow_market($buyer_id_fk,$user_id_fk) {
        $this->db->insert("buyer_follow_markets", array("buyer_id_fk" => $buyer_id_fk,"user_id_fk" => $user_id_fk));
    }
	







//start order --------------------------------------------------------
	function delete_order($buyer_id,$id) {
        $this->db->query("update orders set buyer_statue = '1' where buyer_id_fk= $buyer_id && order_id = '$id'");    
    }
	
	
//end order -----------------------------------------------------------
 


  
 // start ad ------------------------------------------------------	
	
  

	

   
	function update_ad_byexpireddate($d1) {
        $this->db->query("update ads_buyer set statue = 0 WHERE  home_to_time <= $d1  ");
	}
	function update_ad_bystartdate($d1) {
        $this->db->query("update ads_buyer set statue = 1 WHERE  home_from_time <= $d1  ");
	}

  

//end ad--------------------------------------   
    
	
    
    
}
