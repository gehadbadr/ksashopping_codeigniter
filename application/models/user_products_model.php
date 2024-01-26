<?php

class user_products_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

   
	
	 function GetAllProducts($user_id_fk,$limit=0,$offset=0) {
	    $this->db->order_by("product_id", "desc");
        if($limit!=0){
		   if(!$offset){
              $offset=0;  
            }
			$query = $this->db->query("select * from products where user_id_fk  = $user_id_fk order by product_id DESC LIMIT $offset, $limit");
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get_where('products', array('user_id_fk' => $user_id_fk));
			$res = $query->result();
			return $res;
        }
    }
	
	
    
   function count_products($id) { 
          $query = $this->db->get_where('products', array('user_id_fk' => $id));
           $res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
    
    }
	
	
	
	
	function GetAllProductstosite($limit=0,$offset=0) {
	   
        if($limit!=0){
		   if(!$offset){
              $offset=0;  
            }
			$query = $this->db->query("SELECT products . * 
FROM products, price
WHERE price.price_id = products.offerprice && price.statue =1 && offerprice <>0
ORDER BY products.sort DESC LIMIT $offset, $limit");
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->query("SELECT products . * 
FROM products, price
WHERE price.price_id = products.offerprice && price.statue =1 && offerprice <>0
ORDER BY products.sort DESC ");
			$res = $query->result();
			return $res;
        }
    }
	
	function GetAllProductstositebycity($city_id_fk,$limit=0,$offset=0) {
	   
        if($limit!=0){
		   if(!$offset){
              $offset=0;  
            }
			$query = $this->db->query("SELECT DISTINCT products. * 
FROM products, price, users
WHERE price.price_id = products.offerprice && users.city_id_fk =$city_id_fk && products.user_id_fk = users.user_id && price.statue =1 && offerprice <>0
ORDER BY products.sort DESC  LIMIT $offset, $limit");
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->query("SELECT DISTINCT products . * 
FROM products, price, users
WHERE price.price_id = products.offerprice && users.city_id_fk =$city_id_fk && products.user_id_fk = users.user_id && price.statue =1 && offerprice <>0
ORDER BY products.sort DESC ");
			$res = $query->result();
			return $res;
        }
    }
	
	function GetAllProductstositebycat($cat_id_fk,$limit=0,$offset=0) {
	   
        if($limit!=0){
		   if(!$offset){
              $offset=0;  
            }
			$query = $this->db->query("SELECT products . * 
FROM products, price
WHERE price.price_id = products.offerprice && products.cat_id_fk =$cat_id_fk && price.statue =1 && offerprice <>0
ORDER BY products.product_id DESC LIMIT $offset, $limit");
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->query("SELECT products . * 
FROM products, price
WHERE price.price_id = products.offerprice && products.cat_id_fk =$cat_id_fk && price.statue =1 && offerprice <>0
ORDER BY products.product_id DESC ");
			$res = $query->result();
			return $res;
        }
    }
	
	function GetAllProductstositebycatandcity($city_id_fk,$cat_id_fk,$limit=0,$offset=0) {
	   
        if($limit!=0){
		   if(!$offset){
              $offset=0;  
            }
			$query = $this->db->query("SELECT products . * 
FROM products, price , users
WHERE price.price_id = products.offerprice && users.city_id_fk =$city_id_fk && products.user_id_fk = users.user_id && products.cat_id_fk =$cat_id_fk && price.statue =1 && offerprice <>0
ORDER BY products.product_id DESC LIMIT $offset, $limit");
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->query("SELECT products . * 
FROM products, price , users
WHERE price.price_id = products.offerprice &&users.city_id_fk =$city_id_fk && products.user_id_fk = users.user_id && products.cat_id_fk =$cat_id_fk && price.statue =1 && offerprice <>0
ORDER BY products.product_id DESC ");
			$res = $query->result();
			return $res;
        }
    }
	
    function GetProductByID($id) {
        if (!$id) {
            return null;
        } else {
            $query = $this->db->get_where('products', array('product_id' => $id), 1);
            $res = $query->result();
            if (!$query->result()) {
                return null;
            } else {
                $ip = $this->input->ip_address();
                $data = array('view_id' => '', 'product_id_fk' => $id, 'ip' => $ip);
                $this->db->insert('views', $data);
                return $res;
            }
        }
    }
    function GetProductViews($id) {
        $query = $this->db->get_where('views', array('product_id_fk' => $id));
        $res = count($query->result());
        return $res;
    }
	
	
	

	
	function GetProductImages($id) {
        $query = $this->db->get_where('images', array('product_id_fk' => $id));
        $res = $query->result();
        return $res;
    }
	
	function GetProductImages1($id) {
        $query = $this->db->get_where('images', array('product_id_fk' => $id));
		$query=$this->db->query("select * from images where   product_id_fk = $id  LIMIT 1,20"); 
       
        $res = $query->result();
        return $res;
    }
	
	//start comment
    function GetProductcomment($id) {
	
        $query = $this->db->query("select * from comment where   product_id_fk = $id  ORDER BY comment_id DESC"); 
        $res = $query->result();
        return $res;
    }
	
	    function GetcommentByID($id) {
        $query = $this->db->get_where('comment', array('comment_id' => $id));
        $res = $query->result();
        return $res;
    }
	
	function GetAllcomment1($num, $offset) {
    $this->db->order_by("comment_id", "desc");
        $query = $this->db->get('comment', $num, $offset);
        $res = $query->result();
        return $res;
    }
    
   function count_comment() { 
    return $this->db->count_all_results('comment'); 
    }
	
	
//end comment

function updateRating($p_id, $p_rating,$nov,$sum)
    {                    
        $query = $this->db->query("UPDATE products SET number_of_voting = $nov, sum_of_votes = $sum ,rating= $p_rating WHERE '".$p_id."'=product_id;");

        return $query;
    } 

    function GetProductCat($id) {
        $query = $this->db->get_where('cats', array('cat_id' => $id));
        $res = $query->result();
        return $res;
    }
	
	
	
	function GetCat_id($id) {
        $query = $this->db->get_where('products', array('cat_id_fk' => $id));
        $res = $query->result();
        return $res;
    }
	
	function Getprev($id,$cat_id_fk){
            
        $query=$this->db->query("select * from products where   products.cat_id_fk = $cat_id_fk && product_id < $id ORDER BY product_id DESC LIMIT 1"); 
            
        $res = $query->result();
        return $res;
    }
    
    function Getnext($id,$cat_id_fk){
            
        $query=$this->db->query("select * from products where   products.cat_id_fk = $cat_id_fk && product_id > $id  LIMIT 1"); 
            
        $res = $query->result();
        return $res;
    }
	
	    
    	function Getprevadmin($id,$cat_id_fk){
            
        $query=$this->db->query("select product_id from products where products.cat_id_fk = $cat_id_fk && product_id < $id ORDER BY product_id DESC LIMIT 1"); 
            
        $res = $query->result();
        return $res;
    }
    
    function Getnextadmin($id,$cat_id_fk){
            
        $query=$this->db->query("select product_id from products where products.cat_id_fk = $cat_id_fk && product_id > $id  LIMIT 1"); 
            
        $res = $query->result();
        return $res;
    }
	
	    function update_id($old,$temp_id,$id){
            
         $query=$this->db->query("UPDATE products SET product_id = $temp_id WHERE product_id = $old " ); 
		        $query1=$this->db->query("UPDATE images SET product_id_fk = $temp_id WHERE product_id_fk = $old " );
				$query15=$this->db->query("UPDATE views SET product_id_fk = $temp_id WHERE product_id_fk = $old " );
		$query2=$this->db->query("UPDATE products SET product_id = $old WHERE product_id = $id " ); 
        		$query21=$this->db->query("UPDATE images SET product_id_fk = $old WHERE product_id_fk = $id " );
				$query221=$this->db->query("UPDATE views SET product_id_fk = $old WHERE product_id_fk = $id " );
		$query3=$this->db->query("UPDATE products SET product_id = $id WHERE product_id = $temp_id " );        
                $query31=$this->db->query("UPDATE images SET product_id_fk = $id WHERE product_id_fk = $temp_id " );
				$query321=$this->db->query("UPDATE views SET product_id_fk = $id WHERE product_id_fk = $temp_id " );
		
        
		
        
    }
	
	 function Getsort($n,$cat_id_fk){
            
        $query=$this->db->query("select product_id from products where products.cat_id_fk = $cat_id_fk  ORDER BY product_id DESC LIMIT $n,1"); 
            
        $res = $query->result();
        return $res;
    }
	
	function update_id1($old,$temp_id,$id){
            
        $query=$this->db->query("UPDATE products SET product_id = $temp_id WHERE product_id = $old " ); 
		        $query1=$this->db->query("UPDATE images SET product_id_fk = $temp_id WHERE product_id_fk = $old " );
				$query15=$this->db->query("UPDATE views SET product_id_fk = $temp_id WHERE product_id_fk = $old " );
		$query2=$this->db->query("UPDATE products SET product_id = $old WHERE product_id = $id " ); 
        		$query21=$this->db->query("UPDATE images SET product_id_fk = $old WHERE product_id_fk = $id " );
				$query231=$this->db->query("UPDATE views SET product_id_fk = $old WHERE product_id_fk = $id " );
		$query3=$this->db->query("UPDATE products SET product_id = $id WHERE product_id = $temp_id " );        
                $query31=$this->db->query("UPDATE images SET product_id_fk = $id WHERE product_id_fk = $temp_id " );
				$query321=$this->db->query("UPDATE views SET product_id_fk = $id WHERE product_id_fk = $temp_id " );
		
        
    }


}

?>