<?php 

class user_model extends CI_Model {

    function user_model()
    {
        parent::__construct();
    }

    
     
	function check_email($email) {
        
        $query_str = "SELECT * FROM users WHERE email = ? ";
        $query = $this->db->query($query_str, array($email));
        $res = $query->result();
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }
	
	function check_login($email, $password) {
        $md5_password = md5($password);
        $query_str = "SELECT * FROM users WHERE email = ? AND password = ?";
        $result = $this->db->query($query_str, array($email, $md5_password));
        if ($result->num_rows() == 1) {
            return $result->row(0)->user_id;
        } else {
            return FALSE;
        }
    }
	
	
	
	
	 function check_forgotten_email($email) {
        $query = $this->db->get_where("users", array("email" => $email));
        $res = $query->result();
        if ($res) {
            return $res;
        }else
            return FALSE;
    }
    
	
	
	
	
	function GetAllusers($limit=0,$offset=0) {
		if($limit!=0){
		  if(!$offset){
				  $offset=0;  
					}
		 $query = $this->db->query("select * from users where authority <> -1 ORDER BY user_id DESC LIMIT $offset, $limit"); 
		   $res = $query->result();
				return $res;
		}else{
				$query = $this->db->query("select * from users where authority <> -1 ORDER BY user_id DESC "); 
				$res = $query->result();
				return $res;
			}
	}
	
	function count_user() { 
      $query = $this->db->query("select * from users where authority <> -1  ORDER BY user_id DESC "); 
     $res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
    }
	
	function GetAlluserstosite($limit=0,$offset=0) {
		if($limit!=0){
		  if(!$offset){
				  $offset=0;  
					}
		 $query = $this->db->query("select * from users where authority <> -1 && authority <> 0 ORDER BY user_id DESC LIMIT $offset, $limit"); 
		   $res = $query->result();
				return $res;
		}else{
				$query = $this->db->query("select * from users where authority <> -1 && authority <> 0 ORDER BY user_id DESC "); 
				$res = $query->result();
				return $res;
			}
	}
	
	function count_siteuser() { 
      $query = $this->db->query("select * from users where authority <> -1 && authority <> 0 ORDER BY user_id DESC"); 
     $res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
    }
	
	
	function GetAlluserstoindex($limit=0,$offset=0) {
		if($limit!=0){
		  if(!$offset){
				  $offset=0;  
					}
		 $query = $this->db->query("select * from users where authority <> -1 && authority <> 0 && statue = 'on' ORDER BY user_id DESC LIMIT $offset, $limit"); 
		   $res = $query->result();
				return $res;
		}else{
				$query = $this->db->query("select * from users where authority <> -1 && authority <> 0 && statue = 'on' ORDER BY user_id DESC "); 
				$res = $query->result();
				return $res;
			}
	}
	
	function GetAlluserstoindexbycity($city_id_fk,$limit=0,$offset=0) {
		if($limit!=0){
		  if(!$offset){
				  $offset=0;  
					}
		 $query = $this->db->query("select * from users where city_id_fk = $city_id_fk && authority <> -1 && authority <> 0 && statue = 'on' ORDER BY user_id DESC LIMIT $offset, $limit"); 
		   $res = $query->result();
				return $res;
		}else{
				$query = $this->db->query("select * from users where city_id_fk = $city_id_fk && authority <> -1 && authority <> 0 && statue = 'on' ORDER BY user_id DESC "); 
				$res = $query->result();
				return $res;
			}
	}
	
	
    

	
	function GetAllconfirm_user($limit=0,$offset=0) {
	   if(!$offset){
              $offset=0;  
            }
	 $query = $this->db->query("select * from users where authority = -1 ORDER BY user_id DESC LIMIT $offset, $limit"); 
       $res = $query->result();
			return $res;
	}
	
	
    
 function count_confirm_user() { 
     $query = $this->db->query("select * from users where authority = -1  ORDER BY user_id DESC "); 
     $res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
    }

    function add_user($username, $password, $email, $mobile) {
        $query = $this->db->insert("users", array('username' => $username, 'password' => $password, 'email' => $email, 'authority' => '-1', 'mobile' => $mobile));
        $query1 = $this->db->get("users");
        $user_id = end($query1->result());
		$this->db->query("update users set date = NOW() where user_id = $user_id->user_id");
        return $user_id->user_id;
	
	}

    function delete_user($id) {
	   
     $query = $this->db->get_where("products", array("user_id_fk" => $id));
	 // $query = $this->db->qurey("select product_id from products where user_id_fk = $id");
    
	foreach ($query->result() as $row ) {
	   $row->product_id;
                    $this->admin_model->delete_product($row->product_id);
                }
	
	
        $this->db->delete("users", array("user_id" => $id));
	

    }

    function GetuserByID($id) {
        $check = $this->db->get_where('users', array('user_id' => $id));
        if ($check->result()) {
            $query = $this->db->get_where('users', array('user_id' => $id));
            $res = $query->result();
            return $res;
        }else
            return false;
    }

    function edit_user($id,$password, $email, $mobile, $username, $address, $content, $country_id_fk, $city_id_fk,$path) {
        $this->db->where('user_id', $id);
        $this->db->update('users', array( 'password' => $password, 'email' => $email, 'mobile' => $mobile, 'username' => $username, 'address' => $address, 'content' => $content, 'path' => $path, 'country_id_fk' => $country_id_fk, 'city_id_fk' => $city_id_fk));
    }
	
	function edit_authority($id,$authority) {
        $this->db->where('user_id', $id);
        $this->db->update('users', array('authority' => $authority));
    }
	
	function edit_statue($id,$statue) {
        $this->db->where('user_id', $id);
        $this->db->update('users', array('statue' => $statue));
    }

// start hotline ------------------------------------------------
	
		 function GetAllphones() {
	    $this->db->order_by("phone_id", "desc");
        $query = $this->db->get("user_phones");
        $res = $query->result();
        return $res;
    }
	

    function GetphoneByID($id) {
        $query = $this->db->get_where("user_phones", array("phone_id" => $id));
        $res = $query->result();
        return $res;
    }
	
	function GetphoneByuser($id) {
	
       $query = $this->db->query("SELECT * FROM user_phones where user_id_fk = $id  ");
        $res = $query->result();
        return $res;
    }

    function edit_phone($id,$phone) {
        $this->db->where('phone_id', $id);
        $this->db->update("user_phones", array('phone' => $phone));
		$this->db->query("update user_phones set date = NOW() where phone_id = $id");
    }

    function delete_phone($id) {
        $this->db->delete("user_phones", array("phone_id" => $id));
    }

    function add_phone($user_id_fk, $phone) {
        $this->db->insert("user_phones", array("user_id_fk" => $user_id_fk, "phone" => $phone));
    }
	
	
// start branch ------------------------------------------------
	
		 function GetAllbranchs() {
	    $this->db->order_by("branch_id", "desc");
        $query = $this->db->get("user_branchs");
        $res = $query->result();
        return $res;
    }
	

    function GetbranchByID($id) {
        $query = $this->db->get_where("user_branchs", array("branch_id" => $id));
        $res = $query->result();
        return $res;
    }
	
	function GetbranchByuser($id) {
	
       $query = $this->db->query("SELECT * FROM user_branchs where user_id_fk = $id  ");
        $res = $query->result();
        return $res;
    }

    function edit_branch($id,$branch) {
        $this->db->where('branch_id', $id);
        $this->db->update("user_branchs", array('branch' => $branch,'date' => 'NOW()'));
		$this->db->query("update user_branchs set date = NOW() where branch_id = $id");
        
    }

    function delete_branch($id) {
        $this->db->delete("user_branchs", array("branch_id" => $id));
    }

    function add_branch($user_id_fk, $branch) {
        $this->db->insert("user_branchs", array("user_id_fk" => $user_id_fk, "branch" => $branch));
    }
	
	

// start product ------------------------------------------------


    function add_product($name,$user_id_fk, $cat_id, $details, $price, $ship, $photo_path, $discount, $thumb) {
        $this->db->order_by("sort", "desc");
            $query = $this->db->get('products',1);
			if($query->result()){
				foreach ($query->result() as $row ) {
				$sort_value = $row->sort +1; 
				}
			}else{
			    $sort_value = 5;
			}
		$this->db->insert("products", array('name' => $name, 'cat_id_fk' => $cat_id, 'price' => $price, 'discount' => $discount, 'details' => $details, 'image' => $photo_path, 'shipping' => $ship, 'sort' => $sort_value, 'user_id_fk' => $user_id_fk));
        $query = $this->db->get("products");
        $product_id = end($query->result());
        $this->db->insert("images", array('product_id_fk' => $product_id->product_id, 'image' => $photo_path, 'image_thumb' => $thumb));
        $this->db->query("update products set date = NOW() where product_id = $product_id->product_id");
        $this->db->query("update images set date = NOW() where product_id_fk = $product_id->product_id");
        return $product_id->product_id;
    }

    function delete_product($id) {
        $this->db->delete("products", array("product_id" => $id));
        $this->db->delete("views", array("product_id_fk" => $id));
		$this->db->delete("p_videos", array("product_id_fk" => $id));
		$this->db->delete("comment", array("product_id_fk" => $id));
        $path_to_images = $this->db->get_where("images", array("product_id_fk" => $id));

        $this->db->delete("images", array("product_id_fk" => $id));
    }

    function edit_product($id, $product_name, $cat_id, $details, $price, $ship, $path, $discount, $thumb ) {
        $this->db->update("products", array('name' => $product_name, 'cat_id_fk' => $cat_id, 'details' => $details, 'price' => $price, 'shipping' => $ship, 'image' => $path, 'discount' => $discount), array('product_id' => $id));
        $this->db->query("update products set date = NOW() where product_id = $id");
        $this->db->update('images', array('image' => $path, 'image_thumb' => $thumb), array('product_id_fk' => $id, 'flag' => 0),1);
    }
	
	
	
	function add_product_image($product_id, $path, $flag, $thumb) {
        $this->db->query("insert into images (product_id_fk,image,image_thumb,flag,date) values('$product_id','$path','$thumb','$flag',NOW())");
    }
	
	function delete_image($id) {
        $this->db->query("delete from images where image_id = '$id'");    
    }
	
	function add_product_comment($product_id, $name, $comment) {
        $this->db->query("insert into comment (product_id_fk,name,comment,date) values('$product_id','$name','$comment',NOW())");
    }
	
	function edit_comment($id, $statue) {
        $this->db->update("comment", array('statue' => $statue), array('comment_id' => $id));
    }
	
	function delete_comment($id) {
        $this->db->query("delete from comment where comment_id = '$id'");    
    }
	
	function GetpvideoByproduct($id) {
	
       $query = $this->db->query("SELECT * FROM p_videos where product_id_fk = $id  ");
        $res = $query->result();
        return $res;
    }
	
	   function add_pvideo($product_id_fk, $url) {
        $this->db->insert("p_videos", array("product_id_fk" => $product_id_fk, "url" => $url));
    }
//end product	

// start price

function GetLastPrice($product_id_fk) {
	   $query = $this->db->query("SELECT * FROM price where product_id_fk = $product_id_fk order by price_id  desc limit 1");
        $res = $query->result();
        return $res;
    }
	
	
function GetpriceByID($id){
        $query = $this->db->get_where("price", array("price_id" => $id));
        $res = $query->result();
        return $res;
    }

   
	function update_price_byexpireddate($d1) {
        $this->db->query("update price set statue = 0 WHERE  home_to_time <= $d1  ");
	}
	function update_price_bystartdate($d1) {
        $this->db->query("update price set statue = 1 WHERE  home_from_time <= $d1  ");
	}

    
	
	function edit_price($id, $price,$home_from ,$home_from_time,$home_to,$home_to_time,$statue){
        $this->db->where('price_id', $id);
        $this->db->update("price", array('price' => $price, 'home_from' => $home_from, 'home_from_time' => $home_from_time, 'home_to' => $home_to, 'home_to_time' => $home_to_time, 'statue' => $statue));
        $this->db->query("update price set date = NOW() where price_id = $id");
	}

    function add_price($product_id_fk, $price,$home_from ,$home_from_time,$home_to,$home_to_time,$statue) {
        $this->db->insert("price", array("product_id_fk" => $product_id_fk, "price" => $price,'home_from' => $home_from, 'home_from_time' => $home_from_time, 'home_to' => $home_to, 'home_to_time' => $home_to_time,'statue' => $statue));
         $query = $this->db->get("price");
        $price_id = end($query->result());
        $this->db->query("update price set date = NOW() where price_id = $price_id->price_id");
        $this->db->query("update products set offerprice = $price_id->price_id where product_id = $product_id_fk");
        
	}

//end price


//start report

    function Getuserreport($id) {
	
        $query = $this->db->query("select * from report where user_id_fk = $id  ORDER BY report_id DESC"); 
        $res = $query->result();
        return $res;
    }
	
	    function GetreportByID($id) {
        $query = $this->db->get_where('report', array('report_id' => $id));
        $res = $query->result();
        return $res;
    }
	
	function GetAllreport($num, $offset) {
    $this->db->order_by("report_id", "desc");
        $query = $this->db->get('report', $num, $offset);
        $res = $query->result();
        return $res;
    }
    
   function count_report() { 
    return $this->db->count_all_results('report'); 
    }
	
	function add_user_report($user_id_fk, $buyer_id_fk,$report) {
        $this->db->query("insert into report (user_id_fk,buyer_id_fk,comment,date) values('$user_id_fk','$buyer_id_fk','$report',NOW())");
    }
	
	
	
	function delete_report($id) {
        $this->db->query("delete from report where report_id = '$id'");    
    }
	
	
//end report


//start order --------------------------------------------------------
	function delete_order($user_id,$id) {
        $this->db->query("update order_details set statue = '1' where user_id_fk= $user_id && order_id_fk  = '$id'");    
    }
	
	
//end order -----------------------------------------------------------
 
//start payment -------------------------------------------------------
function GetUserPayment($user_id,$num, $offset) {
  if(!$offset){
              $offset=0;  
            }
$query = $this->db->query("SELECT * FROM  payment WHERE payment.user_id_fk  = $user_id ORDER BY cat_id desc LIMIT $offset,$num  ");
        $res = $query->result();
        return $res;
    } 
	
	function count_UserPayment($user_id) { 
$query = $this->db->query("SELECT * FROM  payment WHERE payment.user_id_fk  = $user_id ORDER BY cat_id desc ");

	$res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
          
    }
	
	function add_payment($user_id,$name, $content, $path) {
        if (!$name) {
            
        } else {
		
		    $this->db->order_by("sort", "desc");
            $query = $this->db->get('payment',1);
			foreach ($query->result() as $row ) {
			$sort_value = $row->sort +1; 
			}
            $this->db->insert('payment', array('name' => $name,'path' => $path,'content' => $content, 'sort' => $sort_value,'user_id_fk' => $user_id), 1);
            
			
		}
    }
//end payment ----------------------
  
 // start offer ------------------------------------------------------	
	
  
	 function GetAllAds($user_id,$limit=0,$offset=0) {
	    if(!$offset){
              $offset=0;  
            }
			$query = $this->db->query("SELECT * FROM  ads_user WHERE ads_user.user_id_fk  = $user_id ORDER BY ad_id desc LIMIT $offset ,$limit ");
			$res = $query->result();
			return $res;
        
	
    }
	
 function count_ads($user_id) { 
 $query = $this->db->query("SELECT * FROM  ads_user WHERE ads_user.user_id_fk  = $user_id ORDER BY ad_id desc");
	$res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
    }

     function GetAlloffer_admin($limit=0,$offset=0) {
	    if(!$offset){
              $offset=0;  
            }
			$query = $this->db->query("SELECT * FROM  ads_user   ORDER BY ad_id desc LIMIT $offset ,$limit ");
			$res = $query->result();
			return $res;
        
	
    }
	
 function count_offer_admin() { 
 $query = $this->db->query("SELECT * FROM  ads_user  ORDER BY ad_id desc");
	$res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
    }		
	
	
	function GetAlloffer_site($limit=0,$offset=0) {
        if($limit!=0){
			if(!$offset){
				  $offset=0;  
				}
				$query = $this->db->query("SELECT * FROM  ads_user   where  statue = 1 ORDER BY ad_id desc LIMIT $offset ,$limit ");
				$res = $query->result();
				return $res;
        }else{
		    $query = $this->db->query("SELECT * FROM  ads_user   where  statue = 1 ORDER BY ad_id desc  ");
				$res = $query->result();
				return $res;
		}
	
    }
	
	 function count_offer_site() { 
	 $query = $this->db->query("SELECT * FROM  ads_user  where  statue = 1 ORDER BY ad_id desc");
		$res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
    }	
	
	 function GetAllAdstoBuyer($user_id) {
	    
			$query = $this->db->query("SELECT * FROM  ads_user WHERE ads_user.user_id_fk  = $user_id ORDER BY ad_id desc");
			$res = $query->result();
			return $res;
        
	
    }
	
	
    

	
	function GetAllAds1($user_id) {
	   $query = $this->db->query("SELECT * FROM  ads_user WHERE ads_user.user_id_fk  = $user_id ORDER BY ad_id desc");
        $res = $query->result();
        return $res;
    }

    function GetAdByID($id){
        $query = $this->db->get_where("ads_user", array("ad_id" => $id));
        $res = $query->result();
        return $res;
    }

    function edit_ad($id, $ad_name, $ad_url,$content, $path,$home_from ,$home_from_time,$home_to,$home_to_time,$statue){
        $this->db->where('ad_id', $id);
        $this->db->update("ads_user", array('ad_name' => $ad_name, 'ad_url' => $ad_url, "content" => $content, 'ad_image' => $path, 'home_from' => $home_from, 'home_from_time' => $home_from_time, 'home_to' => $home_to, 'home_to_time' => $home_to_time, 'statue' => $statue));
        $this->db->query("update ads_user set date = NOW() where ad_id = $id");
	}
	function update_ad_byexpireddate($d1) {
        $this->db->query("update ads_user set statue = 0 WHERE  home_to_time <= $d1  ");
	}
	function update_ad_bystartdate($d1) {
        $this->db->query("update ads_user set statue = 1 WHERE  home_from_time <= $d1  ");
	}

    function delete_ad($id) {
        $this->db->delete("ads_user", array("ad_id" => $id));
    }

    function add_ad($ad_name,$user_id, $ad_url,$content, $path,$home_from ,$home_from_time,$home_to,$home_to_time,$statue) {
        $this->db->insert("ads_user", array("ad_name" => $ad_name,"user_id_fk" => $user_id, "ad_url" => $ad_url, "content" => $content, "ad_image" => $path,'home_from' => $home_from, 'home_from_time' => $home_from_time, 'home_to' => $home_to, 'home_to_time' => $home_to_time,'statue' => $statue));
         $query = $this->db->get("ads_user");
        $ad_id = end($query->result());
        $this->db->query("update ads_user set date = NOW() where ad_id = $ad_id->ad_id");
       
	}

//end offer--------------------------------------   
    
    
    
}
