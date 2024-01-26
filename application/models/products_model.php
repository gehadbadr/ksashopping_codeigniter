<?php

class Products_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

 	
	function GetAllProducts($limit=0,$offset=0) {
	    $this->db->order_by("sort", "desc");
		if($limit!=0){
			$query = $this->db->get('products',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('products');
			$res = $query->result();
			return $res;
        }
	
    } 

   function count_products() { 
    return $this->db->count_all_results('products'); 
    }
	
	
	function GetAllProductscat($id,$limit=0,$offset=0){
		if($limit!=0){
                if(!$offset){
              $offset=0;  
            }
			$query=$this->db->query("select cats.name as na ,products.* from cats,products where  products.cat_id_fk  = cats.cat_id &&  products.cat_id_fk = $id order by sort DESC LIMIT $offset, $limit"); 
				
			$res = $query->result();
			return $res;
		
		}else{
			$query=$this->db->query("select cats.name as na ,products.* from cats,products where  products.cat_id_fk  = cats.cat_id &&  products.cat_id_fk = $id order by sort DESC "); 
				
			$res = $query->result();
			return $res;
			}
    }
    
    function count_GetAllProductscat($id) { 
          
            $query=$this->db->query("select cats.name as na ,products.* from cats,products where  products.cat_id_fk  = cats.cat_id &&  products.cat_id_fk = $id "); 
        
            $res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
          
    }

	function GetAllProductsOffers($id,$limit=0,$offset=0){
		if($limit!=0){
                if(!$offset){
              $offset=0;  
            }
			$query=$this->db->query("select cats.name as na ,products.* from cats,products where  products.cat_id_fk  = cats.cat_id &&  products.statue = '1'&&  products.cat_id_fk = $id order by sort DESC LIMIT $offset, $limit"); 
				
			$res = $query->result();
			return $res;
		
		}else{
			$query=$this->db->query("select cats.name as na ,products.* from cats,products where  products.cat_id_fk  = cats.cat_id &&  products.statue = '1'&&  products.cat_id_fk = $id order by sort DESC "); 
				
			$res = $query->result();
			return $res;
			}
    }
    
    function count_GetAllProductsOffers($id) { 
          
            $query=$this->db->query("select cats.name as na ,products.* from cats,products where  products.cat_id_fk  = cats.cat_id &&  products.statue = '1'&&  products.cat_id_fk = $id "); 
        
            $res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
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
	
	function GetProductByName($str) {
      $query=$this->db->query("select * from products where   name like '$str%'  "); 
       
        $res = $query->result();
        return $res;
    }
	
	function GetProductByNameAndCat($str,$cat_id_fk) {
      $query=$this->db->query("select * from products where cat_id_fk = $cat_id_fk && name like '$str%'  "); 
       
        $res = $query->result();
        return $res;
    }
	
    function GetProductViews($id) {
        $query = $this->db->get_where('views', array('product_id_fk' => $id));
        $res = count($query->result());
        return $res;
    }
	
	
	

	
	function GetProductMainImage($id) {
        $query = $this->db->get_where('images', array('product_id_fk' => $id, 'flag' => '0'));
        $res = $query->result();
        return $res;
    }
	
	function GetProductImageFlag($id) {
	    $this->db->order_by("flag", "desc");
            $query = $this->db->get_where('images', array('product_id_fk' => $id));
			$res = $query->result();
			return $res;
	}
	
	function GetProductImages($id) {
        $query = $this->db->get_where('images', array('product_id_fk' => $id));
		$query=$this->db->query("select * from images where   product_id_fk = $id  LIMIT 0,20"); 
       
        $res = $query->result();
        return $res;
    }
	//----------for admin--------
	function GetProductAllImages($id) {
        $query = $this->db->get_where('images', array('product_id_fk' => $id));
		$query=$this->db->query("select * from images where   product_id_fk = $id  LIMIT 1,20"); 
       
        $res = $query->result();
        return $res;
    }

	//start comment
    function GetProductcomment($id,$limit=0,$offset=0) {
	
		if($limit!=0){
                if(!$offset){
              $offset=0;  
            }
			$query=$this->db->query("select * from comment where   product_id_fk = $id  ORDER BY comment_id DESC LIMIT $offset, $limit"); 
			$res = $query->result();
			return $res;
		
		}else{
			$query = $this->db->query("select * from comment where   product_id_fk = $id  ORDER BY comment_id DESC"); 
			$res = $query->result();
			return $res;
			}
		
    }
	
    function GetcommentByID($id) {
        $query = $this->db->get_where('comment', array('comment_id' => $id));
        $res = $query->result();
        return $res;
    }
	
		function GetAllcomment($limit=0,$offset=0) {
	    $this->db->order_by("comment_id", "desc");
		if($limit!=0){
			$query = $this->db->get('comment',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('comment');
			$res = $query->result();
			return $res;
        }
	
    } 

	function count_comment() { 
		return $this->db->count_all_results('comment'); 
    }
	
	function count_Productcomment($id) { 
          
        $query = $this->db->query("select * from comment where   product_id_fk = $id  ORDER BY comment_id DESC"); 
		$res = $query->num_rows();
        if ($res == null) {
			return null;
		} else {
			return $res;
		} 	
          
    }
	
//end comment

function updateRating($p_id,$nov,$sum)
    {                    
        $query = $this->db->query("UPDATE products SET number_of_voting = $nov, sum_of_votes = $sum  WHERE '".$p_id."'=product_id;");

        return $query;
    } 
/*
    function GetProductCat($id) {
        $query = $this->db->get_where('cats', array('cat_id' => $id));
        $res = $query->result();
        return $res;
    }
	
*/	
	
/*	function GetCat_id($id) {
        $query = $this->db->get_where('products', array('cat_id_fk' => $id));
        $res = $query->result();
        return $res;
    }
*/	
	function Getprev($sort,$cat_id_fk){
            
        $query=$this->db->query("select * from products where products.cat_id_fk = $cat_id_fk && sort < $sort ORDER BY sort DESC LIMIT 1"); 
            
        $res = $query->result();
        return $res;
    }
    
    function Getnext($sort,$cat_id_fk){
            
        $query=$this->db->query("select * from products where products.cat_id_fk = $cat_id_fk && sort > $sort  ORDER BY sort ASC  LIMIT 1"); 
            
        $res = $query->result();
        return $res;
    }
	
	    
  
	/*
	  	function Getprevadmin($sort,$cat_id_fk){
            
        $query=$this->db->query("select sort from products where products.cat_id_fk = $cat_id_fk && sort < $sort ORDER BY sort DESC LIMIT 1"); 
            
        $res = $query->result();
        return $res;
    }
    
    function Getnextadmin($sort,$cat_id_fk){
            
        $query=$this->db->query("select sort from products where products.cat_id_fk = $cat_id_fk && sort > $sort  ORDER BY sort ASC  LIMIT 1"); 
            
        $res = $query->result();
        return $res;
    }
	*/
	function update_sort($nextsort,$temp_id,$sort){
            
        $query=$this->db->query("UPDATE products SET sort = $temp_id WHERE sort = $nextsort " ); 
		$query2=$this->db->query("UPDATE products SET sort = $nextsort WHERE sort = $sort " ); 
        $query3=$this->db->query("UPDATE products SET sort = $sort WHERE sort = $temp_id " );        

	}	
        
    function Getsort($n,$cat_id_fk){
            
        $query=$this->db->query("select sort from products where products.cat_id_fk = $cat_id_fk ORDER BY sort DESC LIMIT $n,1"); 
            
        $res = $query->result();
        return $res;
    }

// start product admin
    function add_product($name,$cat_id,$details,$price,$offer_price,$offer_start ,$offer_expire ,$statue,$shipping,$photo_path,$thumb) {
        
		$this->db->order_by("sort", "desc");
            $query = $this->db->get('products',1);
			if($query->result()){
				foreach ($query->result() as $row ) {
				$sort_value = $row->sort +1; 
				}
			}else{
			    $sort_value = 1;
			}
		$this->db->insert("products", array('name' => $name, 'cat_id_fk' => $cat_id, 'price' => $price, 'offer_price' => $offer_price, 'offer_start' => $offer_start, 'offer_expire' => $offer_expire, 'statue' => $statue, 'shipping' => $shipping, 'details' =>$details, 'sort' => $sort_value,'creation_date' =>date("Y-m-d h:i:s")));
        $query = $this->db->get("products");
        $product_id = end($query->result());
        $this->db->insert("images", array('product_id_fk' => $product_id->product_id, 'image' => $photo_path, 'image_thumb' => $thumb, 'flag' => '0','date' =>date("Y-m-d h:i:s")));
      /*$this->db->query("update products set date = NOW() where product_id = $product_id->product_id");
        $this->db->query("update images set date = NOW() where product_id_fk = $product_id->product_id");*/
        return $product_id->product_id;
    }
	
    function delete_product($id) {
        $this->db->delete("products", array("product_id" => $id));
        $this->db->delete("views", array("product_id_fk" => $id));
		$this->db->delete("p_videos", array("product_id_fk" => $id));
		$this->db->delete("colors", array("product_id_fk" => $id));		
		$this->db->delete("sizes", array("product_id_fk" => $id));		
		$this->db->delete("comment", array("product_id_fk" => $id));
        $path_to_images = $this->db->get_where("images", array("product_id_fk" => $id));
		foreach ($path_to_images->result() as $row ) {
			$path = $row->image_id;
			$this->delete_image($path);
		}
    }

    function edit_product($id, $product_name, $cat_id, $details, $price,$offer_price,$offer_start ,$offer_expire ,$statue,$shipping,$path,$thumb) {
        $this->db->update("products", array('name' => $product_name, 'cat_id_fk' => $cat_id, 'details' => $details, 'price' => $price, 'offer_price' => $offer_price, 'offer_start' => $offer_start, 'offer_expire' => $offer_expire, 'statue' => $statue , 'shipping' => $shipping, 'date' =>date("Y-m-d h:i:s")), array('product_id' => $id));
      //  $this->db->query("update products set date = NOW() where product_id = $id");
	    $query=$this->db->query("select * from images where   product_id_fk = $id  && flag = '0'"); 
		foreach ($query->result() as $row ) {
					$old_path = $row->image;
					$old_thumb = $row->image_thumb;
					if($path!= $old_path && $old_path != 'images/images/no_image.jpg' ){
						unlink($old_path);
						unlink($old_thumb);
				    }
		} 
        $this->db->update('images', array('image' => $path, 'image_thumb' => $thumb,'date' =>date("Y-m-d h:i:s")), array('product_id_fk' => $id, 'flag' => 0),1);
        //$query = $this->db->get_where('images', array('product_id_fk' => $id), 1);

				  
    }
	
	function add_product_image($product_id, $path, $thumb, $flag) {
        $this->db->query("insert into images (product_id_fk,image,image_thumb,flag,date) values('$product_id','$path','$thumb','$flag',NOW())");
    }
	
	function delete_image($id) {
		$query=$this->db->get_where('images', array('image_id' => $id), 1);
		foreach ($query->result() as $row ) {
					$path = $row->image;
					$thumb = $row->image_thumb;
					if($path!= 'images/images/no_image.jpg'){
						unlink($path);
						unlink($thumb);
				    }
		}
        $this->db->query("delete from images where image_id = '$id'");  		
    }
	
	function update_statue_offer_start($id) {
        $this->db->query("update products set statue = 1 WHERE  product_id = $id  ");
	}
	
	function update_statue_offer_expire($id) {
        $this->db->query("update products set statue = 0 WHERE  product_id = $id  ");
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
//end product	
/*
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
*/
 // start p_videos 

/*	 function GetAllpvideos() {
	    $this->db->order_by("video_id", "desc");
        $query = $this->db->get("p_videos");
        $res = $query->result();
        return $res;
    }
/*	 function GetAllpvideos1() {
	     $query = $this->db->query("SELECT * FROM p_videos ORDER BY RAND() LIMIT 1  ");
        $res = $query->result();
        return $res;
    }
*/
    function GetpvideoByID($id) {
        $query = $this->db->get_where("p_videos", array("video_id" => $id));
        $res = $query->result();
        return $res;
    }
	
	function GetpvideoByproduct($id) {
	
       $query = $this->db->query("SELECT * FROM p_videos where product_id_fk = $id  ");
        $res = $query->result();
        return $res;
    }
	
	function join_pvideo($id) { 
		if ($id &&is_numeric($id)) {
          
            $query=$this->db->query("select p_videos.* from p_videos,products where p_videos.product_id_fk = products.product_id && p_videos.video_id = $id "); 
        
            $res = $query->result();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
		} else {
			return null;
		}	
          
    }
	

    function edit_pvideo($id,$url) {
        $this->db->where('video_id', $id);
        $this->db->update("p_videos", array('url' => $url,'date' =>date("Y-m-d h:i:s")));
    }

    function delete_pvideo($id) {
        $this->db->delete("p_videos", array("video_id" => $id));
    }

    function add_pvideo($product_id_fk, $url) {
        $this->db->insert("p_videos", array("product_id_fk" => $product_id_fk, "url" => $url,'date' =>date("Y-m-d h:i:s")));
    }
	
// end p_pvideo 

// ------------------------------------  start p_colors  ----------------------------------

/*	 function GetAllpcolors() {
	    $this->db->order_by("color_id", "desc");
        $query = $this->db->get("colors");
        $res = $query->result();
        return $res;
    }
/*	 function GetAllpcolors1() {
	     $query = $this->db->query("SELECT * FROM colors ORDER BY RAND() LIMIT 1  ");
        $res = $query->result();
        return $res;
    }
*/
    function GetpcolorByID($id) {
        $query = $this->db->get_where("colors", array("color_id" => $id));
        $res = $query->result();
        return $res;
    }
	
	function GetpcolorByproduct($id) {
	
       $query = $this->db->query("SELECT * FROM colors where product_id_fk = $id  ");
        $res = $query->result();
        return $res;
    }
	
	function join_pcolor($id) { 
		if ($id &&is_numeric($id)) {
          
            $query=$this->db->query("select colors.* from colors,products where colors.product_id_fk = products.product_id && colors.color_id = $id "); 
        
            $res = $query->result();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
		} else {
			return null;
		}	
          
    }
	

    function edit_pcolor($id,$color) {
        $this->db->where('color_id', $id);
        $this->db->update("colors", array('color' => $color,'date' =>date("Y-m-d h:i:s")));
    }

    function delete_pcolor($id) {
        $this->db->delete("colors", array("color_id" => $id));
    }

    function add_pcolor($product_id_fk, $color) {
        $this->db->insert("colors", array("product_id_fk" => $product_id_fk, "color" => $color,'date' =>date("Y-m-d h:i:s")));
    }
	
	
//end p_colors 

//-------------------------------- start p_sizes ---------------------------------------------

/*	 function GetAllpsizes() {
	    $this->db->order_by("size_id", "desc");
        $query = $this->db->get("sizes");
        $res = $query->result();
        return $res;
    }
/*	 function GetAllpsizes1() {
	     $query = $this->db->query("SELECT * FROM sizes ORDER BY RAND() LIMIT 1  ");
        $res = $query->result();
        return $res;
    }
*/
    function GetpsizeByID($id) {
        $query = $this->db->get_where("sizes", array("size_id" => $id));
        $res = $query->result();
        return $res;
    }
	
	function GetpsizeByproduct($id) {
	
       $query = $this->db->query("SELECT * FROM sizes where product_id_fk = $id  ");
        $res = $query->result();
        return $res;
    }
	
	function join_psize($id) { 
		if ($id &&is_numeric($id)) {
          
            $query=$this->db->query("select sizes.* from sizes,products where sizes.product_id_fk = products.product_id && sizes.size_id = $id "); 
        
            $res = $query->result();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
		} else {
			return null;
		}	
          
    }
	

    function edit_psize($id,$size) {
        $this->db->where('size_id', $id);
        $this->db->update("sizes", array('size' => $size,'date' =>date("Y-m-d h:i:s")));
    }

    function delete_psize($id) {
        $this->db->delete("sizes", array("size_id" => $id));
    }
    
	function add_psize($product_id_fk, $size) {
        $this->db->insert("sizes", array("product_id_fk" => $product_id_fk, "size" => $size,'date' =>date("Y-m-d h:i:s")));
    }
   
   
	
	
//end p_sizes 

// start pay_confirm 	
	
	
	function GetALLMessagespay($limit=0,$offset=0) {
	    $this->db->order_by("pay_confirm_id", "desc");
		if($limit!=0){
			$query = $this->db->get('pay_confirm',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('pay_confirm');
			$res = $query->result();
			return $res;
        }
	
    }
    
    function count_pay() { 
    return $this->db->count_all_results('pay_confirm'); 
    }

    function GetMessagepayByID($id) {
        $query = $this->db->get_where("pay_confirm", array("pay_confirm_id" => $id));
        $res = $query->result();
        return $res;
    }

    function delete_messagepay($id) {
        $this->db->delete("pay_confirm", array("pay_confirm_id" => $id));
    }
   
	

// end pay_confirm 		


}

?>